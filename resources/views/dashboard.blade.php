<!DOCTYPE html>
<html lang="en">

@include('Layout.header')

<body>
<div class="page-wrapper">
    @include('Layout.sidebar')
    
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        @include('Layout.header-menu')
        
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid" id="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Dashboard</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 60vh;">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright ©  2025 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>

</div>

@include('Layout.footer')

</body>

</html>