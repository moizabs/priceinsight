<!DOCTYPE html>
<html lang="en">
@include('Layout.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<body>
    <style>
        /* From Uiverse.io by vinodjangid07 */
        .otp-Form {
            width: 330px;
            height: 450px;
            background-color: rgb(255, 255, 255);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 30px;
            gap: 20px;
            position: relative;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.082);
            border-radius: 15px;
        }

        .mainHeading {
            font-size: 1.7em;
            color: #0d2a5a;
            font-weight: 700;
        }

        .otpSubheading {
            font-size: 0.8em;
            color: black;
            line-height: 17px;
            text-align: center;
        }

        .inputContainer {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .otp-input {
            background-color: rgb(228, 228, 228);
            width: 30px;
            height: 30px;
            text-align: center;
            border: none;
            border-radius: 7px;
            caret-color: #0d2a5a8f;
            color: white;
            outline: none;
            font-weight: 600;
        }

        .otp-input:focus,
        .otp-input:valid {
            background-color: #0d2a5a;
            transition-duration: .3s;
        }

        .verifyButton {
            background-color: #800000;
            color: white;
            width: 100%;
            height: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            transition-duration: .2s;
        }

        .verifyButton:hover {
            background-color: #0d2a5a;
            transform: translateY(-1px);
        }

        .resendNote {
            font-size: 0.7em;
            color: black;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .resendBtn {
            background-color: transparent;
            border: none;
            color: #0d2a5a;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 700;
        }

        .resendBtn:hover {
            color: #800000;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content--bge5"
            style="background-image: url('{{ asset('images/red-truck.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

            <div class=" d-flex justify-content-center align-items-center h-100"
                style="background-color: rgba(7, 7, 7, 0.507) ; ">
                <div class="col-md-5">
                   
                    <form class="otp-Form mx-auto" action="{{ route('otp.submit') }}" method="POST">
                        @csrf
                        <span class="mainHeading">Enter OTP</span>

                        <p class="otpSubheading">We have sent a verification code to your Email</p>
                        
                        <div class="inputContainer">
                            <input required name="otp1" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*" class="otp-input" id="otp-input1">
                            <input required name="otp2" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*" class="otp-input" id="otp-input2">
                            <input required name="otp3" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*" class="otp-input" id="otp-input3">
                            <input required name="otp4" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*" class="otp-input" id="otp-input4">
                        </div>

                        <input type="hidden" name="email" value="{{ $email }}" >
                        <input type="hidden" name="password" value="{{ $password }}" >

                        <button class="verifyButton" type="submit">Verify</button>

                        {{-- <p class="resendNote">Didn't receive the code?
                            <button type="button" class="resendBtn" onclick="document.getElementById('resend-form').submit()">Resend Code</button>
                        </p> --}}

                        <p class="resendNote">
                            Didn’t receive an OTP? <a
                                href="{{ route('otp.resend', ['email' => $email, 'password' => $password]) }}" class="resendBtn">Resend</a>
                        </p>

                    </form>

                    <!-- Hidden form for resend -->
                    {{-- <form id="resend-form" action="{{ route('otp.resend') }}" method="POST" style="display: none;">
                        @csrf
                            <input type="hidden" name="email-resend" value="{{ $email }}" >
                            <input type="hidden" name="password-resend" value="{{ $password }}" >
                    </form> --}}

                    <!-- Display success/error messages -->
                    

                </div>

            </div>
        </div>
    </div>


    <script>
       

        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll(".otp-input");

            inputs.forEach((input, index) => {
                input.addEventListener("input", function() {
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && this.value === "" && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });

        document.querySelectorAll('.otp-input').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif
</body>

</html>
