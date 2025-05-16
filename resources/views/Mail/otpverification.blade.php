{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h2>Hello {{$name}}</h2>
    <br>
    <p>Your Email is <strong> {{$email}} </strong> </p>
    <p>Here is your Verification OTP code {{$otpcode}}</p>

</body>
</html> --}}


<!-- resources/views/emails/otpVerificationEmail.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        /* Your global email styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
        }

        .header {
            background-color: lightblue;
            color: #113771;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header img{
            padding-top: 10px;
        }
        .footer {
            background-color: lightblue;
            color: #113771;
            text-align: center;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            font-size: 12px;
        }

        h2 {
            color: #113771;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ url('images/icon/logo-of-daydispatch-rates.png') }}" style="width: 20%;" alt="Logo">
            <h1>OTP Verification</h1>
        </div>

        <!-- Body content -->
        <p style="text-align: center;">Hello {{ $name }},</p>

        <p style="text-align: center;">Your OTP code for login is:</p>

        <h2 style="text-align: center;">{{ $otpcode }}</h2>

        <p style="text-align: center;">This OTP is valid for only 1 minute. Please enter it on the login page.
            </p>

        <p style="text-align: center;">Thank you.</p>

        <!-- Footer -->
        <div class="footer">
            If you have any questions, just reply to this <a href="mailto:support@daydispatch.com">support@daydispatch.com</a>
            <br>
            We're always happy to help out.
            <br> 
            <br> 
            Price Insight Team
          </div>
    </div>
    
</body>

</html>
