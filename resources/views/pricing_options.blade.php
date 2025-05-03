<!DOCTYPE html>
<html lang="en">

@include('Layout.header')

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
                            <h2 class="title-1 mb-2">Pricing Options</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Price Without a Vehicle Size</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            Price vehicles as a regular car if they are not found in the vehicle size database.
                        </p>
                        <div class="form-group">
                            <select name="veh_size_pass" id="veh_size_pass" class="form-control" style="width: auto;"
                                onchange="pricewithoutvs();">
                                <option selected disabled>Please select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Disabled Vehicles</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            This amount is intended to cover the extra costs associated with loading and unloading a
                            non-running vehicle.
                        </p>
                        <div class="form-group">
                            <div class="input-group pull-left" style="width: 270px;">
                                <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <input type="text" id="veh_op" name="veh_op" maxlength="5" value=""
                                    placeholder="" class="form-control" style="width: auto;">
                            </div>
                            <button type="button" class="btn btn-primary ml-3" onclick="disabledVehicle();">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Enclosed Transports</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            This is a multiplier for enclosed rates.
                        </p>
                        <p class="help-block">
                            (ex. $500 x 1.7 = $850)
                        </p>
                        <div class="form-group">
                            <div class="input-group pull-left" style="width: 270px;">
                                <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <input type="text" id="enclosed" name="enclosed" maxlength="5" value=""
                                    placeholder="" class="form-control" style="width: auto;">
                            </div>
                            <button type="submit" class="btn btn-primary ml-3" onclick="enclosedTransports();">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Deposit Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            The deposit will only be added to the base price when using QuotesTR or the Gmail service.
                        </p>
                        <p class="help-block mt-2">
                            Any price returned through the API will not include the deposit.
                        </p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="nf-email"
                                        class="font-weight-bold form-control-label mt-2 label-config">Deposit
                                        Amount:</label>
                                    <br>
                                    <div class="input-group pull-left" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="text" id="deposit" name="deposit" value=""
                                            placeholder="" class="form-control" style="width: auto;">
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-3" onclick="depositAmount();">
                                        <i class="fa fa-dot-circle-o"></i> Set
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="nf-email"
                                        class="font-weight-bold form-control-label mt-2 label-config">Hide
                                        Deposit:</label>
                                    <select class="form-control" style="width: auto;" id="DepositHide"
                                        name="DepositHide" onchange="depositAmount();">
                                        <option selected disabled>Please select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
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

    <script src="{{ asset('js/ajax/setbasicprice.js') }}"></script>
    @include('Layout.footer')
</body>

</html>
