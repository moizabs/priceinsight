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
                    @if(session('Success!'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('Success!') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                
                    @if(session('Error!'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('Error!') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2>Create Account</h2><br/>

                    <div class="login-form">
                        <form action="{{ route('create.account') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="au-input au-input--full" type="text" name="name" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Enter Email" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Create Account</button>
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
