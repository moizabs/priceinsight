<!DOCTYPE html>
<html lang="en">
    @include('Layout.header')

<body>

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
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('images/icon/logo-of-dispatch-rates.png') }}" width="45%" alt="CoolAdmin">
                        </a>
                    </div>

                    @if(session('Error!'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('Error!') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h2>Log in</h2><br/>

                    <div class="login-form">
                        <form action="{{ route('login.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <!-- <div class="col-sm-12 mb-2 p-0">
                                <div class="g-recaptcha" id="feedback-recaptcha" 
                                     data-sitekey="6LcmYJwkAAAAAJLp-uGl90uV15xZrcLbjyN2K2FR">
                                </div>
                            </div> -->
                            <button name="submit" class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Sign In</button>
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
