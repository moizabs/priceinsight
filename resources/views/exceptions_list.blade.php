<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<body>
    <div class="page-wrapper">
        @include('Layout.sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('Layout.header-menu')

            <div class="container" style="padding-top: 120px">

                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1 mb-2">View / Delete Exceptions</h2>
                        </div>
                    </div>
                </div>

                <div class="card" id="results">
                    <div class="card-header text-black">
                        <strong>Current Rules</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Origin / Destination</th>
                                        <th class="text-center font-weight-bold">Type</th>
                                        <th class="text-center font-weight-bold">Amount</th>
                                        <th class="text-center font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Route MD -> CL
                                        </td>
                                        <td class="text-center">
                                            Route
                                        </td>
                                        <td class="text-center">
                                            $45
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);"><img
                                                    src="{{ asset('images/delete.png') }}" /></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="row">
            <div class="col-lg-12">
                <?php echo $pagination->createLinks(); ?>
            </div>
        </div> --}}

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2019 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Layout.footer')
    <script src="{{ asset('js/ajax/view_exception.js') }}"></script>

</body>
</html>
