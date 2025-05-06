<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .swal2-cancel {
        margin-right: 20px;
    }
</style>
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
                            <h2 class="title-1 mb-2">Vehicle Size Queue</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Add Vehicle</strong>
                    </div>
                    <div class="card-body card-block">

                        <form method="post" action="javascript:void(0)" name="form1" id="form1">
                            <input type="hidden" name="company_id" id="company_id" value="46">
                            <input type="hidden" name="page" id="page" value="1">

                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="make" class="font-weight-bold">Make</label>
                                    <input class="form-control" type="text" name="make" id="make"
                                        placeholder="Enter Make">
                                </div>
                                <div class="col-lg-3">
                                    <label for="model" class="font-weight-bold">Model</label>
                                    <input class="form-control" type="text" name="model" id="model"
                                        placeholder="Enter Model">
                                </div>
                                <div class="col-lg-2">
                                    <input type="submit" name="submit" id="submit"
                                        class="btn btn-primary btn-block" style="margin-top: 24%;" value="Add">
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
                                <tbody id="result">

                                    <tr id="vehId${html.vehicleid}">
                                        <td class="text-center">Honda</td>
                                        <td class="text-center">Accord</td>
                                        <td>
                                            <select class="form-control" name="veh_type" id="veh_type">
                                                <option value="1">Moped /Scooter</option>
                                                <option value="2">Motorcycle - Small</option>
                                                <option value="3">Motorcycle - Medium</option>
                                                <option value="4">Motorcycle - Large</option>
                                                <option value="5">Trike / ATV</option>
                                                <option value="6">Car - Mini</option>
                                                <option value="7">Car - Sports</option>
                                                <option value="8">Car - Compact</option>
                                                <option value="9">Car - Midsize</option>
                                                <option value="10">Car - Large</option>
                                                <option value="11">Minivan</option>
                                                <option value="12">SUV - Small</option>
                                                <option value="13">SUV - Medium</option>
                                                <option value="14">SUV - Large</option>
                                                <option value="15">Truck - Small 2WD</option>
                                                <option value="16">Truck - Small 4WD</option>
                                                <option value="17">Truck - Medium</option>
                                                <option value="18">Truck - Large</option>
                                                <option value="19">Truck - Extra Large</option>
                                                <option value="20">Truck-Dually</option>
                                                <option value="21">Truck-Commercial</option>
                                                <option value="22">DO NOT QUOTE</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="http://images.google.com/images?q=${html.make}+${html.model}"><img
                                                    src="/images/google.png" width="30"></a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" onClick="delvelRule(${html.vehicleid});"><img
                                                    src="/images/delete.png" /></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2025 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/ajax/vehicle_size_queue.js') }}"></script>
    @include('Layout.footer')
</body>
</html>
