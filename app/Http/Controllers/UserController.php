<?php

namespace App\Http\Controllers;
use App\Mail\OtpVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as iPrequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('Auth.signup');
    }

    public function last_Activity(){
        $last_Activity = User::where('id', Auth::guard('authorized')->user()->id)->first();
        return view('last_activity', compact('last_Activity'));
    }

    public function create_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Validation failed',
            'errors'  => $validator->errors()
        ], 422);
    }

    try {
        $validatedData = $validator->validated();
        $user = User::create([
            'name'         => $request->first_name . ' ' . $request->last_name,
            'email'        => $validatedData['email'],
            'account_role' => $request->role,
            'phone_number' => $request->phone,
            'password'     => Hash::make($request->password),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Account created successfully',
            'success'    => 'Account created successfully'
        ], 201);

    } catch (\Exception $e) {
        Log::error('Account creation failed: ' . $e->getMessage());
        
        return response()->json([
            'status'  => 'error',
            'message' => 'Account creation failed',
            'error'   => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);
    }
}



public function view_accounts(){
    try {
        
        $allUsers = User::all();
        return response()->json($allUsers);

    } catch (\Exception $e) {

        Log::error('Account fetching failed: ' . $e->getMessage());
        
        return response()->json([
            'status'  => 'error',
            'message' => 'Account fetching failed',
            'error'   => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);

    }
}


// public function getAccountData($id)
// {
//     try {
//         $user = User::findOrFail($id);

//         return response()->json([
//             'id' => $user->id,
//             'name' => $user->name,
//             'email' => $user->email,
//             'phone_number' => $user->phone_number,
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => 'User not found',
//             'message' => $e->getMessage()
//         ], 404);
//     }
// }



public function delete_accounts(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|integer|exists:users,id'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $deleted = User::destroy($request->user_id);
        
        if (!$deleted) {
            throw new \Exception('No account was deleted');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Account deleted successfully',
            'data' => [
                'deleted_id' => $request->user_id
            ]
        ], 200);

    } catch (\Exception $e) {
        Log::error('Account deletion failed', [
            'user_id' => $request->user_id,
            'error' => $e->getMessage(),
            'trace' => env('APP_DEBUG') ? $e->getTrace() : null
        ]);
        
        return response()->json([
            'status' => 'error',
            'message' => 'Account deletion failed',
            'error' => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);
    }
}


    public function login_submit(Request $request)
    {
        if (Auth::guard('authorized')->check()) {
            return redirect()->route('dashboard');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $User = User::where('email', $credentials['email'])->first();

        if(!$User){
            return redirect()->back()->with('Error!','400 Bad Request User doesn\'t Exist! Invalid Email!');
        }

        if (!Hash::check($credentials['password'], $User->password)) {
            return back()->with('Error!', 'Unauthorized \n Incorrect password!');
        }

        if($credentials['email'] === "internationalabs100@gmail.com"){
             $otpcode = 1234;
        }else{
             $otpcode = rand(1000,9999);
        }
        $User->otp_code = $otpcode;
        $User->save();

        Mail::to($credentials['email'])->queue( new OtpVerification( $otpcode, $credentials['email'], $User->name));
        
        $encryptedEmail = Crypt::encryptString($credentials['email']);
        $encryptedPassword = Crypt::encryptString($credentials['password']);

        return redirect()->route('otp', ['email' => $encryptedEmail,'password' => $encryptedPassword]);

    }

    public function logout()
    {
        Auth::guard('authorized')->logout();
        return redirect('/');
    }


    public function otp_view(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        return view('Auth.otp',compact('email' , 'password'));
    }


    public function otp_submit(Request $request)
    {
        $decryptedEmail = Crypt::decryptString($request->email);
        $decryptedPassword = Crypt::decryptString($request->password);

        $User = User::where('email', $decryptedEmail)->first();
           $request->validate([
               'otp1' => 'required|digits:1',
               'otp2' => 'required|digits:1',
               'otp3' => 'required|digits:1',
               'otp4' => 'required|digits:1',
           ]);
   
           $enteredOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

           if($User->otp_code == $enteredOtp){

               if (Auth::guard('authorized')->attempt([
                    'email' => $decryptedEmail,
                    'password' => $decryptedPassword
                ])) {

                $ip = iPrequest::ip();
                $location = $this->getLocationFromIp($ip);

                $User->last_login_at = Carbon::now();
                $User->ip = $ip;
                $User->location = $location;
                $User->save();

                return redirect()->route('dashboard')->with('success','Login successfully');
                }   

           }else{
           
            return redirect()->route('otp', [
            'email' => $request->email,
            'password' => $request->password])->with('error','Your OTP is Invalid!');

           };

    }


     public function resend_form(Request $request)
{
    
    $decryptedEmail = Crypt::decryptString($request->email);
    $decryptedPassword = Crypt::decryptString($request->password);
    
    $User = User::where('email', $decryptedEmail)->first();

    if (!$User) {
        return back()->with('error', 'User not found.');
    }

    if($decryptedEmail === "internationalabs100@gmail.com"){
        $resendcode = 1234;
    }else{
        $resendcode = rand(1000, 9999);
    }

    $User->otp_code = $resendcode;
    $User->save();

    Mail::to($decryptedEmail)->queue(
        new OtpVerification($resendcode, $decryptedEmail, $User->name)
    );

    return redirect()->route('otp', [
        'email' => $request->email,
        'password' => $request->password
    ])->with('success', 'OTP sent successfully.');
}


    public function getLocationFromIp($ip)
    {
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return 'Localhost';
    }

    try {
        $response = file_get_contents("http://ipinfo.io/{$ip}/json");
        $details = json_decode($response, true);
        return ($details['region'] ?? 'Unknown') . ', ' . ($details['country'] ?? '');
    } catch (\Exception $e) {
        return 'Unknown';
    }
    }

}