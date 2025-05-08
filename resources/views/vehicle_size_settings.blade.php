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
                            <h2 class="title-1 mb-2">Vehicle Type Pricing</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Vehicle Type Pricing</strong>
                    </div>
                    <div class="card-body card-block">
                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-5">
                                    <label for="make" class="font-weight-bold">Vehicle Type:</label>
                                    <select class="form-control" name="vehicle_type" id="vehicle_type">
                                        <option value="">Please Select</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="Coupe">Coupe (2 Doors)</option>
                                        <option value="SUV">SUV</option>
                                        <option value="Pickup-2doors">Pickup (2 Doors)</option>
                                        <option value="Pickup-4doors">Pickup (4 Doors)</option>
                                        <option value="Van">Van</option>
                                    </select>
                                </div>

                                <div class="col-lg-5">
                                    <label for="model" class="font-weight-bold">Operation Type:</label>
                                    <select class="form-control" name="operation_type" id="operation_type">
                                        <option value="">Please Select</option>
                                        <option value="Add">Add</option>
                                        <option value="Sub">Subtract</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-10">
                                    <label for="model" class="font-weight-bold">Price ($):</label>
                                    <input name="type_price" id="type_price" type="text" maxlength="8"
                                        placeholder="Enter Price" class="form-control">
                                </div>
                            </div>

                            <div class="row justify-content-center mb-5">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary" onclick="add_vehicle_type();">Submit</button>
                                </div>
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
                                        <th class="text-center font-weight-bold">Vehicle Type</th>
                                        <th class="text-center font-weight-bold">Amount ($)</th>
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
                                        <p class="mt-3">You have successfully updated Price Without a Vehicle Type.</p>
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


            function loadAllVehicleRecords() {
                $.ajax({
                    url: "{{ route('get.all.vehicle.size.settings') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            let rows = '';
                            response.data.forEach(function(item) {
                                rows += `
                                    <tr>
                                        <td class="text-center">${item.vehicle_type}</td>
                                        <td class="text-center">${item.price}</td>
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

            loadAllVehicleRecords();



        function add_vehicle_type() {
            var Vehicle_Type = $('#vehicle_type').val();
            var Operation_Type = $('#operation_type').val();
            var Price = $('#type_price').val();

            $.ajax({
                url: "{{ route('add.vehicle.size.settings') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    Vehicle_Type: Vehicle_Type,
                    Operation_Type: Operation_Type,
                    Price: Price,
                },
                success: function(response) {
                    if (response.success) {
                        loadAllVehicleRecords();
                        var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                        successModal.show();
                        $('#vehicle_type').val('');
                        $('#operation_type').val('');
                        $('#type_price').val('');
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
