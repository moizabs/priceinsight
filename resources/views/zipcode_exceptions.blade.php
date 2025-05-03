<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<body class="animsition">
    <div class="page-wrapper">
        @include('Layout.sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('Layout.header-menu')

            <div class="container" style="padding-top: 120px">

                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1 mb-2">Zip Code Exceptions</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Zip Code Search</strong>
                    </div>
                    <div class="card-body card-block">

                        <small>Search zip codes and add pricing rules.</small>

                        <form method="post" action="javascript:void(0)" name="form1" id="form1">

                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-2">
                                    <select name="orig_dest" id="orig_dest" class="form-control" style="width: auto;">
                                        <option selected disabled>Please select</option>
                                        <option value="any">Any</option>
                                        <option value="origin">Origin</option>
                                        <option value="destination">Destination</option>
                                        <option value="route">Route</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select name="add_sub" id="add_sub" class="form-control" style="width: auto;">
                                        <option selected disabled>Please select</option>
                                        <option value="add">Add</option>
                                        <option value="sub">Subtract</option>
                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>

                            <div class="row mt-4" id="routeWithOutDzip">
                            </div>

                            <div class="row mt-4" id="routeWithDzip">
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card-header text-black">
                    <strong>Matches</strong>
                </div>
                <div class="card-body card-block">

                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th class="text-center font-weight-bold">Zip Code</th>
                                    <th class="text-center font-weight-bold">City</th>
                                    <th class="text-center font-weight-bold">State</th>
                                    <th class="text-center font-weight-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">
                                    <td>564654</td>
                                    <td>Nebraska</td>
                                    <td>California</td>
                                    <td>Map Icon</td>
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
    <script src="{{ asset('js/ajax/getziprules.js') }}"></script>

</body>

</html>
