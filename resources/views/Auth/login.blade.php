<!DOCTYPE html>
<html lang="en">
    @include('Layout.header')

<body class="animsition">

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
            </div>
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>User Name</label>
                                <input class="au-input au-input--full" type="username" name="username" placeholder="Enter User Name">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Enter Password">
                            </div>
                            <!-- <div class="col-sm-12 mb-2 p-0">
                                <div class="g-recaptcha" id="feedback-recaptcha" 
                                     data-sitekey="6LcmYJwkAAAAAJLp-uGl90uV15xZrcLbjyN2K2FR">
                                </div>
                            </div> -->
                            <button name="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Layout.footer')
</body>
</html>
