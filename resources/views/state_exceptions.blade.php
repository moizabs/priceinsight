<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #add_rules{
        display: none;
    }

    #destination_state {
        display: none;
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
                            <h2 class="title-1 mb-2">State Exceptions</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>State Search</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            Select State and Create/View/Delete Rules
                        </p>
                        <div class="form-group">
                            <select name="origin_state" id="origin_state" class="form-control" style="width: auto;">
                                <option value="">Select State</option>
                                <option value="Alabama">Alabama</option>
                                <option value="Alaska">Alaska</option>
                                <option value="Arizona">Arizona</option>
                                <option value="Arkansas">Arkansas</option>
                                <option value="California">California</option>
                                <option value="Colorado">Colorado</option>
                                <option value="Connecticut">Connecticut</option>
                                <option value="Delaware">Delaware</option>
                                <option value="Florida">Florida</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Idaho">Idaho</option>
                                <option value="Illinois">Illinois</option>
                                <option value="Indiana">Indiana</option>
                                <option value="Iowa">Iowa</option>
                                <option value="Kansas">Kansas</option>
                                <option value="Kentucky">Kentucky</option>
                                <option value="Louisiana">Louisiana</option>
                                <option value="Maine">Maine</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Massachusetts">Massachusetts</option>
                                <option value="Michigan">Michigan</option>
                                <option value="Minnesota">Minnesota</option>
                                <option value="Mississippi">Mississippi</option>
                                <option value="Missouri">Missouri</option>
                                <option value="Montana">Montana</option>
                                <option value="Nebraska">Nebraska</option>
                                <option value="Nevada">Nevada</option>
                                <option value="New Hampshire">New Hampshire</option>
                                <option value="New Jersey">New Jersey</option>
                                <option value="New Mexico">New Mexico</option>
                                <option value="New York">New York</option>
                                <option value="North Carolina">North Carolina</option>
                                <option value="North Dakota">North Dakota</option>
                                <option value="Ohio">Ohio</option>
                                <option value="Oklahoma">Oklahoma</option>
                                <option value="Oregon">Oregon</option>
                                <option value="Pennsylvania">Pennsylvania</option>
                                <option value="Rhode Island">Rhode Island</option>
                                <option value="South Carolina">South Carolina</option>
                                <option value="South Dakota">South Dakota</option>
                                <option value="Tennessee">Tennessee</option>
                                <option value="Texas">Texas</option>
                                <option value="Utah">Utah</option>
                                <option value="Vermont">Vermont</option>
                                <option value="Virginia">Virginia</option>
                                <option value="Washington">Washington</option>
                                <option value="West Virginia">West Virginia</option>
                                <option value="Wisconsin">Wisconsin</option>
                                <option value="Wyoming">Wyoming</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card" id="add_rules">
                    <div class="card-header text-black">
                        <strong><span id="selected_state_header"></span></strong>
                    </div>
                    <div class="card-body card-block">

                        <h3 style="margin-bottom:15px;">Create a rule for <span id="selected_state_h3"></span></h3>

                        <div class="row">
                            <div class="col-lg-2">
                                <select name="route_type" id="route_type" class="form-control" style="width: auto;">
                                    <option value="">Select Type</option>
                                    <option value="Any">Any</option>
                                    <option value="Route">Route</option>
                                    <option value="Origin">Origin</option>
                                    <option value="Destination">Destination</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="operation_type" id="operation_type" class="form-control" style="width: auto;">
                                    <option value="">Select Operation</option>
                                    <option value="Add">Add</option>
                                    <option value="Sub">Subtract</option>
                                    <option value="No">Don't Quote</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                        <select name="destination_state" id="destination_state" class="form-control"
                                        style="width: auto;">
                                            <option value="">Select State</option>
                                            <option value="Alabama">Alabama</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Arizona">Arizona</option>
                                            <option value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>
                                        </select>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="input-group" style="width: 155px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input name="value" id="value" type="text" maxlength="5"
                                            placeholder="" class="form-control" style="width: 75%; flex: unset">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="input-group" style="width: 155px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-percent"></i>
                                        </div>
                                        <input name="value_percentage" id="value_percentage" type="number" min="0"
                                            maxlength="5" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <input type="submit" name="Submit" onclick="add_state_rules();" value="Add Rule"
                                    class="btn btn-primary ml-3">
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                </div>

                <div class="card" id="rules_list">
                    <div class="card-header text-black">
                        <strong>Current Rules</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning" id="contentMid">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Origin/Destination State</th>
                                        <th class="text-center font-weight-bold">Amount ($)</th>
                                        <th class="text-center font-weight-bold">Amount (%)</th>
                                        <th class="text-center font-weight-bold">Operation</th>                                        
                                        <th class="text-center font-weight-bold">Entered By</th>                                        
                                        <th class="text-center font-weight-bold">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


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
            function loadAllRuleRecords() {
                $.ajax({
                    url: "{{ route('get.all.state.exceptions') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            let rows = '';
                            response.data.forEach(function(item) {
                                rows += `
                                    <tr>
                                        <td class="text-center">${item.route_type} | ${item.origin_destination}</td>
                                        <td class="text-center">${item.value}</td>
                                        <td class="text-center">${item.value_percentage}</td>
                                        <td class="text-center">${item.operation_type}</td>
                                        <td class="text-center">${item.entered_by}</td>
                                        <td class="text-center">${formatDate(item.entery_date)}</td>
                                    </tr>
                                `;
                            });
                            $('#contentMid tbody').html(rows);
                        }
                    },
                    error: function() {
                        alert('Error loading records');
                    }
                });
            }

            function formatDate(date) {
                const options = {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                };
                return new Date(date).toLocaleDateString('en-GB', options);
            }

            loadAllRuleRecords();


        function add_state_rules() {
            var Origin_State = $('#origin_state').val();
            var Destination_State = $('#destination_state').val();
            var Route_Type = $('#route_type').val();
            var Operation_Type = $('#operation_type').val();
            var Value = $('#value').val();
            var Value_Percentage = $('#value_percentage').val();

            $.ajax({
                url: "{{ route('add.state.exceptions') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    Origin_State: Origin_State,
                    Destination_State: Destination_State,
                    Route_Type: Route_Type,
                    Operation_Type: Operation_Type,
                    Value: Value,
                    Value_Percentage: Value_Percentage,
                },
                success: function(response) {
                    if (response.success) {
                        loadAllRuleRecords();
                        var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                        successModal.show();
                        $('#value').val('');
                        $('#value_percentage').val('');
                        $('#destination_state').val('');
                        $('#route_type').val('');
                        $('#operation_type').val('');
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

        $('#origin_state').on('change', function () {
            var selectedState = $(this).val();
    
            if (selectedState !== '') {
                loadAllRuleRecords();
                $('#add_rules').show();
                $('#selected_state_header').text(selectedState);
                $('#selected_state_h3').text(selectedState);
            } else {
                $('#add_rules').hide();
            }
        });


        $('#route_type').on('change', function () {
            var selected = $(this).val();
            if (selected === 'Route') {
                $('#destination_state').show();
            } else {
                $('#destination_state').hide().val('');
            }
        });
    </script>

    @include('Layout.footer')
</body>
</html>
