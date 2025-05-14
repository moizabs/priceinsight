<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as iPrequest;
use App\Mail\OtpVerification;

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
        $validateCheck = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('Success!', 'Account created successfully.');

        } catch (\Exception $e) {

            Log::error('Account creation failed: ' . $e->getMessage());
            return redirect()->back()->with('Error!', 'Something went wrong while creating the account.');
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

        // if (Auth::guard('authorized')->attempt($credentials)) {
            $otpcode = rand(1000,9999);
            $ip = iPrequest::ip();
            $location = $this->getLocationFromIp($ip);
    
            $User->last_login_at = Carbon::now();
            $User->ip = $ip;
            $User->location = $location;
            $User->otp_code = $otpcode;
            $User->save();

            $checkMail = Mail::to($credentials['email'])->queue( new OtpVerification( $otpcode, $credentials['email'], $User->name));
            return redirect()->route('otp', [
            'email' => $credentials['email'],
            'password' => $credentials['password']]);
        // }

        return back()->with([
            'Error!' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
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
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $User = User::where('email', $credentials['email'])->first();
           $request->validate([
               'otp1' => 'required|digits:1',
               'otp2' => 'required|digits:1',
               'otp3' => 'required|digits:1',
               'otp4' => 'required|digits:1',
           ]);
   
           $enteredOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

           if($User->otp_code == $enteredOtp){

               if (Auth::guard('authorized')->attempt($credentials)) {
                   return redirect()->route('dashboard')->with('success','Login successfully');;
                  }   

           }else{
           
            return redirect()->route('otp', [
            'email' => $credentials['email'],
            'password' => $credentials['password']])->with('error','Your OTP is Invalid!');;

           };

    }


     public function resend_form(Request $request)
    {

          $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
          ]);

         $User = User::where('email', $credentials['email'])->first();

         $resendcode = rand(1000,9999);
         $User->otp_code = $resendcode;
         $User->save();
         
         return redirect()->route('otp', [
        'email' => $credentials['email'],
        'password' => $credentials['password']])->with('success','otp send successfully');
    }

}