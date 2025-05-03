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
                            <h2 class="title-1 mb-2">Vehicle Size Database</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Search a Vehicle</strong>
                    </div>
                    <div class="card-body card-block">

                        <form method="post" action="" name="form1" id="form1">
                            <input type="hidden" name="company_id" id="company_id" value="46">
                            <input type="hidden" name="page" id="page" value="1">

                            <div class="row">
                                <div class="col-lg-3">
                                    <input class="form-control" type="text"
                                        name="v_make" id="v_make" placeholder="Make">
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control" type="text"
                                        name="v_model" id="v_model" placeholder="Model">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="results">
                    <div class="card-header text-black">
                        <strong>New Vehicle Queue</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Make</th>
                                        <th class="text-center font-weight-bold">Model</th>
                                        <th class="text-center font-weight-bold">Size</th>
                                        <th class="text-center font-weight-bold"></th>
                                        <th class="text-center font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Acura</td>
                                        <td class="text-center">Legend</td>
                                        <td>
                                            <select class="form-control" name="veh_type" id="veh_type">
                                                <option value="Car Mini">Car - Mini</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="http://images.google.com/images?q=Acura+Legend"><img
                                                    src="{{ asset('images/google.png') }}" width="30"></a>
                                        </td>
                                        <td>
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

    <script src="{{ asset('js/ajax/vehicle_size.js') }}"></script>
    @include('Layout.footer')

</body>
</html>
