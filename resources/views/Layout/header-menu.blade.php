<style>
    .nav-menu {
        display: flex;
        justify-content: space-around;
        /* background-color: blueviolet; */
        width: 400px;
    }
    .account-dropdown {
        display: none;
        position: absolute;
        right: 0;
        background: #fff;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }
    .account-dropdown.show {
        display: block;
    }
</style>
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header"></div>
                <div class="nav-menu">
                    <span><a href="">Vehicle</a></span>
                    <span><a href="">Heavy</a></span>
                    <span><a href="">Freight</a></span>
                </div>

                {{-- <div class="account-dropdown__footer">
                    <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
                </div> --}}
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ asset('images/icon/avatar-01.jpg') }}"
                                    alt="{{ Auth::guard('authorized')->user()->name }}" />
                            </div>
                            <div class="content"><a class="js-acc-btn"
                                    href="javascript:void(0)">{{ Auth::guard('authorized')->user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                {{-- <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('images/icon/avatar-01.jpg') }}"
                                                alt="{{ Auth::guard('authorized')->user()->name }}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a
                                                href="javascript:void(0)">{{ Auth::guard('authorized')->user()->name }}</a>
                                        </h5>
                                    </div>
                                </div> --}}
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Toggle dropdown when clicking the account button
        $('.js-acc-btn').on('click', function() {
            $(this).closest('.js-item-menu').find('.js-dropdown').toggleClass('show');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.js-item-menu').length) {
                $('.js-dropdown').removeClass('show');
            }
        });
    });
</script>