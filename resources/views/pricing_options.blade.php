<!DOCTYPE html>
<html lang="en">

@include('Layout.header')

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
                            <h2 class="title-1 mb-2">Pricing Options</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Price Without a Vehicle Type</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            Price vehicles as a regular car if they are not found in the vehicle type database.
                        </p>
                        <div class="form-group">
                            <select name="veh_size_pass" id="veh_size_pass" class="form-control" style="width: auto;" onchange="withoutVehicleSize();">
                                <option selected disabled>Please Select</option>
                                <option value="Yes" @selected(($pricing_options->disabled_vehicle ?? '') == 'Yes')>Yes</option>
                                <option value="No" @selected(($pricing_options->disabled_vehicle ?? '') == 'No')>No</option>
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
                            This amount is intended to cover the extra costs associated with loading and unloading a non-running vehicle.
                        </p>
                        <div class="form-group">
                            <div class="input-group pull-left" style="width: 270px;">
                                <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <input type="text" id="in_operable" name="in_operable" maxlength="5" value="{{ $pricing_options->in_operable ?? 0 }}"
                                    placeholder="" class="form-control" style="width: auto;">
                            </div>
                            <button type="button" class="btn btn-primary ml-3" onclick="withoutVehicleSize();">
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
                                <input type="text" id="enclosed" name="enclosed" maxlength="5" value="{{ $pricing_options->enclosed_transport ?? 0 }}"
                                    placeholder="" class="form-control" style="width: auto;">
                            </div>
                            <button type="submit" class="btn btn-primary ml-3" onclick="withoutVehicleSize();">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
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
                                        <input type="text" id="deposit" name="deposit" value="{{ $pricing_options->deposit_amount ?? 0 }}"
                                            placeholder="" class="form-control" style="width: auto;">
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-3" onclick="withoutVehicleSize();">
                                        <i class="fa fa-dot-circle-o"></i> Set
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="nf-email"
                                        class="font-weight-bold form-control-label mt-2 label-config">Hide
                                        Deposit:</label>
                                        <select class="form-control" style="width: auto;" id="DepositHide"
                                        name="DepositHide" onchange="withoutVehicleSize();">
                                    <option selected disabled>Please select</option>
                                    <option value="Yes" @selected(($pricing_options->hide_deposit ?? '') == 'Yes')>Yes</option>
                                    <option value="No" @selected(($pricing_options->hide_deposit ?? '') == 'No')>No</option>
                                </select>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="container  p-5">
                    <div class="row">
                        <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
                                <div class="modal-content"> 
                                    <div class="modal-body text-center p-lg-4"> 
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                            <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" /> 
                                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" X2="34.4" y2="92.2" /> 
                                        </svg> 
                                        <h4 class="text-danger mt-3">Oops!</h4> 
                                        <p class="mt-3">Error saving the vehicle type option.</p>
                                        <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button> 
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
                                <div class="modal-content"> 
                                    <div class="modal-body text-center p-lg-4"> 
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                            <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                            <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                                        </svg> 
                                        <h4 class="text-success mt-3">Success</h4> 
                                        <p class="mt-3">You have successfully updated Price Without a Vehicle type.</p>
                                        <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button> 
                                    </div> 
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

    
    <script>
        function withoutVehicleSize() {
            var selectedValue = $('#veh_size_pass').val();
            var in_operable = $('#in_operable').val();
            var enclosed = $('#enclosed').val();
            var deposit_amount = $('#deposit').val();
            var DepositHide = $('#DepositHide').val();

            $.ajax({
                url: "{{ route('add.pricing.options') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    vehicle_size: selectedValue,
                    in_operable: in_operable,
                    enclosed: enclosed,
                    deposit_amount: deposit_amount,
                    DepositHide: DepositHide,
                },
                success: function(response) {
                    if (response.success) {
                        var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                        successModal.show();
                    } else {
                        var errorModal = new bootstrap.Modal(document.getElementById('statusErrorsModal'));
                        errorModal.show();
                    }
                },
                error: function(xhr) {
                    alert("An error occurred.");
                }
            });
        }
    </script>
    
    @include('Layout.footer')
</body>

</html>
