<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #add_rules {
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
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
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
                                <select name="operation_type" id="operation_type" class="form-control"
                                    style="width: auto;">
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
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
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
                                        <input name="value" id="value" type="text" maxlength="5" placeholder=""
                                            class="form-control" style="width: 75%; flex: unset">
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
                                        <th class="text-center font-weight-bold">Action</th>
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
                        <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog"
                            data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-lg-4">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                            <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6"
                                                stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6"
                                                stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9"
                                                x2="95.8" y2="92.3" />
                                            <line class="path line" fill="none" stroke="#db3646" stroke-width="6"
                                                stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38"
                                                X2="34.4" y2="92.2" />
                                        </svg>
                                        <h4 class="text-danger mt-3">Oops!</h4>
                                        <p class="mt-3">Error saving the vehicle type option.</p>
                                        <button type="button" class="btn btn-sm mt-3 btn-danger"
                                            data-bs-dismiss="modal">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog"
                            data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-lg-4">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                            <circle class="path circle" fill="none" stroke="#198754" stroke-width="6"
                                                stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                            <polyline class="path check" fill="none" stroke="#198754" stroke-width="6"
                                                stroke-linecap="round" stroke-miterlimit="10"
                                                points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                                        </svg>
                                        <h4 class="text-success mt-3">Success</h4>
                                        <p class="mt-3">You have successfully updated Price Without a Vehicle type.</p>
                                        <button type="button" class="btn btn-sm mt-3 btn-success"
                                            data-bs-dismiss="modal">Ok</button>
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


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit State Exception</h5>
                    <button type="button" class="close" id="closemodal" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="form-group">
                        <label>Route Type</label>
                        <select name="modal_route_type" id="modal_route_type" class="form-control" style="width: auto;"
                            required>
                            <option value="">Please Select</option>
                            <option value="Any">Any</option>
                            <option value="Origin">Origin</option>
                            <option value="Destination">Destination</option>
                            <option value="Route">Route</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Operation Type</label>
                        <select name="modal_operation_type" id="modal_operation_type" class="form-control"
                            style="width: auto;" required>
                            <option value="">Please Select</option>
                            <option value="Add">Add</option>
                            <option value="Sub">Subtract</option>
                        </select>
                    </div>
                    <div class="form-group" id="input_display" style="display: none">
                        <label>Origin State</label>
                        <select name="modal_origin_zipcode" id="modal_origin_zipcode" class="form-control"
                            style="width: auto;">
                            <option value="">Select State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="form-group" id="input_display2" style="display: none">
                        <label>Destination State</label>
                        <select name="modal_destination_zipcode" id="modal_destination_zipcode" class="form-control"
                            style="width: auto;">
                            <option value="">Select State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="form-group" id="input_display4" style="display: none">
                        <label>State</label>
                        <select name="modal_zipcode" id="modal_zipcode" class="form-control" style="width: auto;">
                            <option value="">Select State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price ($)</label>
                        <input name="value" id="modal_value" type="text" maxlength="5" class="form-control">
                    </div>
                    <div class="form-group" id="input_display3" style="display: none">
                        <label>Price (%)</label>
                        <input name="modal_percentage" id="modal_percentage" type="number" min="0" maxlength="5"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="updateRecord" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadAllRuleRecords() {
            $.ajax({
                url: "{{ route('get.all.state.exceptions') }}",
                type: "GET",
                success: function (response) {
                    if (response.success) {
                        let rows = '';
                        response.data.forEach(function (item) {
                            rows += `
                                    <tr>
                                        <td class="text-center">${item.route_type} | ${item.origin_destination}</td>
                                        <td class="text-center">${item.value}</td>
                                        <td class="text-center">${item.value_percentage}</td>
                                        <td class="text-center">${item.operation_type}</td>
                                        <td class="text-center">${item.entered_by}</td>
                                        <td class="text-center">${formatDate(item.entery_date)}</td>
                                        <td class="text-center">
                                        <a href="javascript:void(0);" class="editBtn" 
                                            data-id="${item.id}" 
                                            data-route="${item.route_type}"
                                            data-origin_zipcode="${item.origin_state}" 
                                            data-dest_zipcode="${item.destination_state}" 
                                            data-value="${item.value}" 
                                            data-percentage="${item.value_percentage}" 
                                            data-operation="${item.operation_type}">Edit</a> |
                                            <button class="deleteBtn" data-id="${item.id}">Delete</button>
                                        </td>
                                    </tr>
                                `;
                        });
                        $('#contentMid tbody').html(rows);
                    }
                },
                error: function () {
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
                success: function (response) {
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
                error: function (xhr) {
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


        $(document).on('click', '.editBtn', function () {
            $('#edit_id').val($(this).data('id'));
            $('#modal_route_type').val($(this).data('route'));
            $('#modal_value').val($(this).data('value'));
            $('#modal_operation_type').val($(this).data('operation'));

            if ($(this).data('route') == 'Route') {

                $('#input_display').css('display', 'block');
                $('#input_display2').css('display', 'block');

                $('#modal_origin_zipcode').val($(this).data('origin_zipcode'));
                $('#modal_destination_zipcode').val($(this).data('dest_zipcode'));

                $('#input_display4').css('display', 'none');
                $('#modal_zipcode').val('');

            } else {

                $('#input_display').css('display', 'none');
                $('#input_display2').css('display', 'none');

                $('#modal_origin_zipcode').val('');
                $('#modal_destination_zipcode').val('');

                $('#input_display4').css('display', 'block');

                if ($(this).data('origin_zipcode') != null) {
                    $('#modal_zipcode').val($(this).data('origin_zipcode'));
                } else {
                    $('#modal_zipcode').val($(this).data('dest_zipcode'));
                }

            }

            if ($(this).data('percentage') != null) {

                $('#input_display3').css('display', 'block');
                $('#modal_percentage').val($(this).data('percentage'));

            } else {

                $('#input_display3').css('display', 'none');
                $('#modal_percentage').val('');

            }

            $('#editModal').modal('show');
        });

        $(document).on('click', '#closemodal', function () {
            $('#editModal').modal('hide');
        });

        $('#updateRecord').click(function () {
            let id = $('#edit_id').val();
            $.ajax({
                url: `/state-exceptions/update/${id}`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    route_type: $('#modal_route_type').val(),
                    value: $('#modal_value').val(),
                    operation_type: $('#modal_operation_type').val(),
                    origin_zipcode: $('#modal_origin_zipcode').val(),
                    dest_zipcode: $('#modal_destination_zipcode').val(),
                    zipcode: $('#modal_zipcode').val(),
                    percentage: $('#modal_percentage').val(),
                },
                success: function (res) {
                    $('#editModal').modal('hide');
                    loadAllRuleRecords();
                    var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                    successModal.show();
                },
                error: function (res) {
                    alert(res.message);
                    $('#editModal').modal('hide');
                    var errorModal = new bootstrap.Modal(document.getElementById('statusErrorsModal'));
                    errorModal.show();
                }
            });
        });


        $(document).on('click', '.deleteBtn', function () {
            var id = $(this).data('id');

            $.ajax({
                url: `/state-exceptions/delete/${id}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (res) {
                    loadAllRuleRecords();
                    var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                    successModal.show();
                },
                error: function (xhr) {
                    var errorModal = new bootstrap.Modal(document.getElementById('statusErrorsModal'));
                    errorModal.show();
                }
            });
        });

    </script>

    @include('Layout.footer')
</body>

</html>