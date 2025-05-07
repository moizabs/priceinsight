<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #origin_zipcode, #destination_zipcode{
        display: none
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
                            <br/><br/>
                            <div class="row">
                                {{-- <div class="col-lg-4"></div> --}}
                                <div class="col-lg-2">
                                    <select name="zipcode_route_type" id="zipcode_route_type" class="form-control" style="width: auto;">
                                        <option value="">Please Select</option>
                                        <option value="Any">Any</option>
                                        <option value="Origin">Origin</option>
                                        <option value="Destination">Destination</option>
                                        <option value="Route">Route</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select name="zipcode_operation_type" id="zipcode_operation_type" class="form-control" style="width: auto;">
                                        <option value="">Please Select</option>
                                        <option value="Add">Add</option>
                                        <option value="Sub">Subtract</option>
                                    </select>
                                </div>
                                {{-- <div class="col-lg-4"></div> --}}
                            </div>

                            <br/>
                            <div class="row">

                                <div class="col-lg-2" id="origin_zipcode">
                                    <div class="form-group">
                                        <div class="input-group" style="width: 155px;">
                                            <input name="only_origin_zipcode" id="only_origin_zipcode" type="text" maxlength="5"
                                                placeholder="Origin Zip Code" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2" id="destination_zipcode">
                                    <div class="form-group">
                                        <div class="input-group" style="width: 155px;">
                                            <input name="only_destination_zipcode" id="only_destination_zipcode" type="text" maxlength="5"
                                                placeholder="Destination Zip Code" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2" id="zipcode">
                                    <div class="form-group">
                                        <div class="input-group" style="width: 155px;">
                                            <input name="only_zipcode" id="only_zipcode" type="text" maxlength="5"
                                                placeholder="Enter Zip Code" class="form-control">
                                        </div>
                                    </div>
                                </div>
    
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
    
                                <div class="col-lg-2">
                                    <input type="submit" name="Submit" onclick="add_zipcode_rules();" value="Add Rule"
                                        class="btn btn-primary ml-3">
                                </div>                                
                            </div>

                    </div>
                </div>

                <div class="card-header text-black">
                    <strong>Matches</strong>
                </div>
                <div class="card-body card-block">

                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning" id="contentMid">
                            <thead>
                                <tr>
                                    <th class="text-center font-weight-bold">Zip Code</th>
                                    <th class="text-center font-weight-bold">Amount ($)</th>
                                    <th class="text-center font-weight-bold">Amount (%)</th>
                                    <th class="text-center font-weight-bold">Operation</th>                                        
                                    <th class="text-center font-weight-bold">Enter By</th>                                        
                                    <th class="text-center font-weight-bold">Created at</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                                        <p class="mt-3">Error saving the vehicle size option.</p>
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
                                        <h4 class="text-success mt-3">Oh Yeah!</h4> 
                                        <p class="mt-3">You have successfully updated Price Without a Vehicle Size.</p>
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


            function loadzipcoderules() {
                $.ajax({
                    url: "{{ route('get.all.zipcode.exceptions') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            let rows = '';
                            response.data.forEach(function(item) {
                                rows += `
                                    <tr>
                                        <td class="text-center">${item.route_type} | ${item.zipcode}</td>
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

            loadzipcoderules(); 

        function add_zipcode_rules() {
            var Route_Type = $('#zipcode_route_type').val();
            var Operation_Type = $('#zipcode_operation_type').val();
            var Origin_ZipCode = $('#only_origin_zipcode').val();
            var Destination_ZipCode = $('#only_destination_zipcode').val();
            var ZipCode = $('#only_zipcode').val();
            var Value = $('#value').val();
            var Value_Percentage = $('#value_percentage').val();

            $.ajax({
                url: "{{ route('add.zipcode.exceptions') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    Route_Type: Route_Type,
                    Operation_Type: Operation_Type,
                    Origin_ZipCode: Origin_ZipCode,
                    Destination_ZipCode: Destination_ZipCode,
                    ZipCode: ZipCode,
                    Value: Value,
                    Value_Percentage: Value_Percentage,
                },
                success: function(response) {
                    if (response.success) {
                        loadzipcoderules();
                        var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                        successModal.show();
                        $('#zipcode_route_type').val('');
                        $('#zipcode_operation_type').val('');
                        $('#only_origin_zipcode').val('');
                        $('#only_destination_zipcode').val('');
                        $('#only_zipcode').val('');
                        $('#value').val('');
                        $('#value_percentage').val('');
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

    $('#zipcode_route_type').on('change', function () {
        var selected = $(this).val();
        if (selected === 'Route') {
            $('#origin_zipcode').show();
            $('#destination_zipcode').show();
            $('#zipcode').hide().val('');
        } else {
            $('#origin_zipcode').hide().val('');
            $('#destination_zipcode').hide().val('');
            $('#zipcode').show();
        }
    });

    </script>

    @include('Layout.footer')
    {{-- <script src="{{ asset('js/ajax/getziprules.js') }}"></script> --}}

</body>

</html>
