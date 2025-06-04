<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #origin_zipcode,
    #destination_zipcode {
        display: none
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 16px;
        margin: 0 4px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #f5f5f5;
    }

    .pagination .active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .disabled {
        color: #ddd;
        pointer-events: none;
    }
</style>

<body>
    <div class="page-wrapper">
        @include('Layout.sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('Layout.header-menu')

            <div class="container" style="padding-top: 120px">

                {{-- <div class="card-header text-black">
                    <strong>Dispatch Listing</strong>
                </div> --}}

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Dispatch Listing</strong>
                    </div>

                    <div class="card-body card-block">
                        <button name="add" class="btn-primary btn-sm pull-right addBtn" style="margin-left: 15px">Add
                            Records</button>

                        {{-- <a href="{{ route('add.price.per.mile') }}" name="add"
                            class="btn-primary btn-sm pull-right">Upload CSV</a> --}}
                    </div>

                    <div class="card-body card-block">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning" id="contentMid">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Status</th>
                                        <th class="text-center font-weight-bold">Origin Location</th>
                                        <th class="text-center font-weight-bold">Destination Location</th>
                                        <th class="text-center font-weight-bold">Vehicle Information</th>
                                        <th class="text-center font-weight-bold">Listed Price</th>
                                        <th class="text-center font-weight-bold">Dispatch Price</th>
                                        <th class="text-center font-weight-bold">Vehicle Type</th>
                                        <th class="text-center font-weight-bold">Vehicle Condition</th>
                                        <th class="text-center font-weight-bold">Trailer Type</th>
                                        <th class="text-center font-weight-bold">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container" id="paginationContainer"></div>
                    </div>

                </div>

                <!-- Add Modal -->
                <div class="modal fade" id="addModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add Dispatch Price</h5>
                                <button type="button" class="close" id="closemodal"
                                    data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_id">
                                <div class="form-group">
                                    <label>Origin Location</label>
                                    <input type="text" placeholder="Origin"
                                        class="form-control Origin_ZipCode typeahead" id="origin" required>
                                </div>
                                <div class="form-group">
                                    <label>Destination Location</label>
                                    <input type="text" placeholder="Destination"
                                        class="form-control Dest_ZipCode typeahead" id="destination" required>
                                    {{-- <input type="number" id="edit_end_range" class="form-control"> --}}
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Year</label>
                                    <input type="text" placeholder="Year" min="1900" max="2025" maxlength="4" required
                                        class="form-control" id="year_check" name="year">
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Make</label>
                                    <input type="text" placeholder="Make" class="form-control makes typeahead" id="make"
                                        required name="make">
                                </div>
                                <div class="form-group">
                                    <label>Vehicle Model</label>
                                    <input type="text" placeholder="Model" class="form-control models typeahead"
                                        id="model" name="model" required>
                                </div>

                                <div class="form-group">
                                    <label>Vehicle Type</label>

                                    <select class="form-control" name="type" id="vehicle_type">
                                        <option value="" selected disabled>Select Type</option>

                                        <option value="Car">Car</option>
                                        <option value="motorcycle">Motorcycle</option>
                                        <option value="3_wheel_sidecar">3 Wheel Sidecar</option>
                                        <option value="3_wheel_motorcycle">3 Wheel Motorcycle</option>
                                        <option value="atv">ATV</option>
                                        <option value="SUV">SUV</option>
                                        <option value="Mid SUV">Mid SUV</option>
                                        <option value="Large SUV">Large SUV</option>
                                        <option value="Van">Van</option>
                                        <option value="Mini Van">Mini Van</option>
                                        <option value="Cargo Van">Cargo Van</option>
                                        <option value="Passenger Van">Passenger Van</option>
                                        <option value="Pickup">Pickup</option>
                                        <option value="Pickup Dually">Pickup Dually</option>
                                        <option value="Box Truck Dually">Box Truck Dually</option>
                                        <option value="other_vehicle">Other Vehicle</option>
                                        <option value="other_motorcycle">Other Motorcycle</option>
                                        <option value="other">Other</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Vehicle Condition</label>

                                    <select class="form-control" name="inoperable" id="inoperable">
                                        <option value="" selected disabled>Select Condition</option>
                                        <option value="1">Operable</option>
                                        <option value="2">Inoperable</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Trailer Type</label><br />
                                    <label class="radio-option">
                                        <input type="radio" name="trailer-type" value="1" checked>
                                        Open
                                    </label>

                                    <label class="radio-option">
                                        <input type="radio" name="trailer-type" value="2">
                                        Enclosed
                                    </label>
                                </div>


                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" id="dispatch_price" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="addRecord" class="btn btn-primary">Add Price</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center p-lg-4">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                    <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6"
                                        stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                    <line class="path line" fill="none" stroke="#db3646" stroke-width="6"
                                        stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8"
                                        y2="92.3" />
                                    <line class="path line" fill="none" stroke="#db3646" stroke-width="6"
                                        stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" X2="34.4"
                                        y2="92.2" />
                                </svg>
                                <h4 class="text-danger mt-3">Oops!</h4>
                                <p class="mt-3">Error saving the vehicle type option.</p>
                                <button type="button" class="btn btn-sm mt-3 btn-danger"
                                    data-bs-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
                    data-bs-keyboard="false">
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

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script>
        let currentPage = 1;
        const recordsPerPage = 10;

        function loadzipcoderules(page = 1) {
            currentPage = page;
            $.ajax({
                url: "{{ route('get.all.dispatch.listing') }}",
                type: "GET",
                success: function (response) {
                    if (response.success) {
                        let rows = '';
                        const totalRecords = response.data.length;
                        const totalPages = Math.ceil(totalRecords / recordsPerPage);
                        const paginatedData = paginateData(response.data, page, recordsPerPage);

                        paginatedData.forEach(function (item) {
                            rows += `
                                <tr>
                                    <td class="text-center">${item.status}</td>
                                    <td class="text-center">${item.origin_location}</td>
                                    <td class="text-center">${item.destination_location}</td>
                                    <td class="text-center">${item.vehicle_info}</td>
                                    <td class="text-center">$ ${item.price}</td>
                                    <td class="text-center">$ ${item.dispatch_price}</td>
                                    <td class="text-center">${item.type}</td>
                                    <td class="text-center">${item.condition}</td>
                                    <td class="text-center">${item.transport}</td>
                                    <td class="text-center">${formatDate(item.entery_date)}</td>
                                </tr>
                            `;
                        });

                        $('#contentMid tbody').html(rows);
                        renderPagination(totalPages, page);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);

                    let errorMsg = 'An error occurred while loading data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    alert(errorMsg);
                }
            });
        }

        function paginateData(data, page, perPage) {
            const start = (page - 1) * perPage;
            const end = start + perPage;
            return data.slice(start, end);
        }

        function renderPagination(totalPages, currentPage) {
            let paginationHTML = '<div class="pagination">';

            // Previous button
            if (currentPage > 1) {
                paginationHTML += `<a href="#" onclick="loadzipcoderules(${currentPage - 1})">&laquo; Previous</a>`;
            } else {
                paginationHTML += '<span class="disabled">&laquo; Previous</span>';
            }

            // Page numbers
            const maxVisiblePages = 10;
            let startPage, endPage;

            if (totalPages <= maxVisiblePages) {
                startPage = 1;
                endPage = totalPages;
            } else {
                const maxVisibleBeforeCurrent = Math.floor(maxVisiblePages / 2);
                const maxVisibleAfterCurrent = Math.ceil(maxVisiblePages / 2) - 1;

                if (currentPage <= maxVisibleBeforeCurrent) {
                    startPage = 1;
                    endPage = maxVisiblePages;
                } else if (currentPage + maxVisibleAfterCurrent >= totalPages) {
                    startPage = totalPages - maxVisiblePages + 1;
                    endPage = totalPages;
                } else {
                    startPage = currentPage - maxVisibleBeforeCurrent;
                    endPage = currentPage + maxVisibleAfterCurrent;
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i === currentPage) {
                    paginationHTML += `<span class="active">${i}</span>`;
                } else {
                    paginationHTML += `<a href="#" onclick="loadzipcoderules(${i})">${i}</a>`;
                }
            }

            // Next button
            if (currentPage < totalPages) {
                paginationHTML += `<a href="#" onclick="loadzipcoderules(${currentPage + 1})">Next &raquo;</a>`;
            } else {
                paginationHTML += '<span class="disabled">Next &raquo;</span>';
            }

            paginationHTML += '</div>';
            $('#paginationContainer').html(paginationHTML);
        }

        function formatDate(date) {
            const options = {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            return new Date(date).toLocaleDateString('en-GB', options);
        }


        // Add record functionality
        $(document).on('click', '.addBtn', function () {
            $('#addModal').modal('show');
        });

        $(document).on('click', '#closemodal', function () {
            $('#addModal').modal('hide');
        });

        $('#addRecord').click(function () {
            $.ajax({
                url: `/dispatch-listing/price/add`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    origin_location: $('#origin').val(),
                    destination_location: $('#destination').val(),
                    vehicle_year: $('#year_check').val(),
                    vehicle_make: $('#make').val(),
                    vehicle_model: $('#model').val(),
                    vehicle_type: $('#vehicle_type').val(),
                    vehicle_condition: $('#inoperable').val(),
                    trailer_type: $('input[name="trailer-type"]:checked').val(),
                    dispatch_price: $('#dispatch_price').val(),
                },
                success: function (res) {
                    $('#addModal').modal('hide');
                    loadzipcoderules();
                    showSuccess('Price record added successfully');
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Error adding record');
                }
            });
        });


        function showError(message) {
                $('#errorMessage').text(message);
                var errorModal = new bootstrap.Modal(document.getElementById('statusErrorsModal'));
                errorModal.show();
            }
            
            function showSuccess(message) {
                $('#successMessage').text(message);
                var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
                successModal.show();
            }


        const path = "{{ route('autocomplete') }}";
        $('.Dest_ZipCode.typeahead, .Origin_ZipCode.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });


        const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
        const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';

        $('input.makes.typeahead').typeahead('destroy').typeahead({
            source: function (query, process) {
                return $.get(GetVehicleMake, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            },
            afterSelect: function (item) {
            }
        });

        $('input.models.typeahead').typeahead('destroy').typeahead({
            source: function (query, process) {
                return $.get(GetVehicleModel, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

        $('#year_check').on('change', function () {
            var value = $(this).val();
            if (value.length > 4) {
                value = value.slice(0, 4);
                alert("Year cannot exceed 4 digits.");
                $(this).addClass('error-border');
            } else if (value < 1900) {
                value = "";
                alert("Year must be greater than or equal to 1900.");
                $(this).addClass('error-border');
            } else if (value > 2025) {
                value = "";
                alert("Year must be less than or equal to 2025.");
                $(this).addClass('error-border');
            } else {
                $(this).removeClass('error-border');
            }
            $(this).val(value);
        });

        loadzipcoderules();
    </script>

    @include('Layout.footer')
</body>

</html>