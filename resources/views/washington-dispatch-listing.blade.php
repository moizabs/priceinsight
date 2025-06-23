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
    .table{
        color: black;
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
                        <div class="row mb-3">
                            <div class="col-md-6 text-right">
                                <button name="add" class="btn-primary btn-sm addBtn2"
                                    style="margin-right: 5px;">
                                    Add Rec
                                </button>
                            </div>
                            <div class="col-md-8 text-right">
                                <button name="add" class="btn-primary btn-sm addBtn"
                                    style="margin-right: -58px; height: 32px;" >
                                    Add Records
                                </button>
                            </div>
                            <div class="col-md-4 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal" 
                              >
                                    Upload CSV
                                </button>
                                <a href="{{ asset('sample_dispatch_listing.csv') }}"
                                    class="btn btn-primary btn-sm ml-2"  >
                                    Download Sample CSV
                                </a>
                            </div>
                        </div>

                   

                    <div class="card-body card-block">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning " id="contentMid" >
                                <thead class="custom-thead" style="background-color: #2c3e50;">
                                    <tr  style="background-color: #2c3e50;">
                                        <th class="text-center font-weight-bold">Status</th>
                                        <th class="text-center font-weight-bold">Origin Location</th>
                                        <th class="text-center font-weight-bold">Destination Location</th>
                                        <th class="text-center font-weight-bold">Vehicle Information</th>
                                        <th class="text-center font-weight-bold">Dispatch Price</th>
                                        <th class="text-center font-weight-bold">Vehicle Type</th>
                                        <th class="text-center font-weight-bold">Vehicle Condition</th>
                                        <th class="text-center font-weight-bold">Trailer Type</th>
                                        <th class="text-center font-weight-bold">Entered By</th>
                                        <th class="text-center font-weight-bold">Created at</th>
                                        <th class="text-center font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container" id="paginationContainer"></div>
                    </div>
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
                                        <option value="" selected disabled>Vechile Type</option>

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
                                    <label>Dispatch Price</label>
                                    <input type="number" id="dispatch_price" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="addRecord" class="btn btn-primary">Add Price</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Dispatch Price</h5>
                                <button type="button" class="close" id="closemodal"
                                    data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_id">
                                <div class="form-group">
                                    <label>Origin Location</label>
                                    <input type="text" placeholder="Origin" value=""
                                        class="form-control Origin_ZipCode typeahead" id="originE" required>
                                </div>
                                <div class="form-group">
                                    <label>Destination Location</label>
                                    <input type="text" placeholder="Destination" value=""
                                        class="form-control Dest_ZipCode typeahead" id="destinationE" required>
                                    {{-- <input type="number" id="edit_end_range" class="form-control"> --}}
                                </div>

                                <div class="form-group">
                                    <label>Vehicle Type</label>

                                    <select class="form-control" name="type" id="vehicle_typeE">
                                        <option value="" selected disabled>Vechile Type</option>

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

                                    <select class="form-control" name="inoperable" id="inoperableE">
                                        <option value="" selected disabled>Select Condition</option>
                                        <option value="1">Operable</option>
                                        <option value="2">Inoperable</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Trailer Type</label><br />
                                    <label class="radio-option">
                                        <input type="radio" name="trailer-typeE" value="1" checked>
                                        Open
                                    </label>

                                    <label class="radio-option">
                                        <input type="radio" name="trailer-typeE" value="2">
                                        Enclosed
                                    </label>
                                </div>


                                <div class="form-group">
                                    <label>Dispatch Price</label>
                                    <input type="number" id="dispatch_priceE" value="" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="editRecord" class="btn btn-primary">Edit Price</button>
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


                <!-- Upload CSV Modal -->
                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Dispatch Listing CSV</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="uploadForm" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="csvFile">Select CSV File</label>
                                        <input type="file" class="form-control-file" id="csvFile" name="csv_file"
                                            accept=".csv" required>
                                        <small class="form-text text-muted">
                                            File must be in CSV format with proper headers. <a
                                                href="{{ asset('sample_dispatch_listing.csv') }}">Download sample
                                                CSV</a>
                                        </small>
                                    </div>
                                    <div class="progress" style="display: none;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <div id="uploadStatus" class="mt-2"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
                                </div>
                            </form>
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
    <!-- New modal check  -->


    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>

        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData();
            let file = $('#csvFile')[0].files[0];
            formData.append('csv_file', file);
            formData.append('_token', '{{ csrf_token() }}');

            $('.progress').show();
            $('#uploadStatus').html('');
            $('#uploadBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('dispatch.listing.upload') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            let percent = Math.round((e.loaded / e.total) * 100);
                            $('.progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
                        }
                    });
                    return xhr;
                },
                success: function (response) {
                    if (response.success) {
                        $('#uploadStatus').html('<div class="alert alert-success">' + response.message + '</div>');
                        loadzipcoderules();
                        setTimeout(function () {
                            $('#uploadModal').modal('hide');
                            $('.progress').hide();
                            $('#uploadBtn').prop('disabled', false);
                        }, 1500);
                    } else {
                        $('#uploadStatus').html('<div class="alert alert-danger">' + response.message + '</div>');
                        $('#uploadBtn').prop('disabled', false);
                    }
                },
                error: function (xhr) {
                    let errorMsg = 'An error occurred during upload.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#uploadStatus').html('<div class="alert alert-danger">' + errorMsg + '</div>');
                    $('#uploadBtn').prop('disabled', false);
                }
            });
        });

        // Reset form when modal is closed
        $('#uploadModal').on('hidden.bs.modal', function () {
            $('#uploadForm')[0].reset();
            $('.progress').hide();
            $('.progress-bar').css('width', '0%');
            $('#uploadStatus').html('');
            $('#uploadBtn').prop('disabled', false);
        });




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
                                    <td class="text-center">$ ${item.dispatch_price}</td>
                                    <td class="text-center">${item.type}</td>
                                    <td class="text-center">${item.condition}</td>
                                    <td class="text-center">${item.transport}</td>
                                    <td class="text-center">${item.user}</td>
                                    <td class="text-center">${formatDate(item.entery_date)}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="editBtn" 
                                            data-id="${item.id}" 
                                            data-origin_location="${item.origin_location}" 
                                            data-destination_location="${item.destination_location}"
                                            data-dispatch_price="${item.dispatch_price}"
                                            data-type="${item.type}"
                                            data-condition="${item.conditionE}"
                                            data-transport="${item.transportE}"
                                            >Edit</a> |
                                            <button class="deleteBtn" data-id="${item.id}">Delete</button>
                                    </td>
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
        $(document).on('click', '.addBtn2', function () {
            $('#priceModal').modal('show');
        });

 
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





        // Edit record functionality
        $(document).on('click', '.editBtn', function () {
            $('#edit_id').val($(this).data('id'));
            $('#originE').val($(this).data('origin_location'));
            $('#destinationE').val($(this).data('destination_location'));
            $('#vehicle_typeE').val($(this).data('type'));
            $('#inoperableE').val($(this).data('condition'));
            let trailerValue = $(this).data('transport'); // e.g. 1 or 2
            $('input[name="trailer-typeE"][value="' + trailerValue + '"]').prop('checked', true);
            $('#dispatch_priceE').val($(this).data('dispatch_price'));
            $('#editModal').modal('show');
        });

        $(document).on('click', '#closemodal', function () {
            $('#editModal').modal('hide');
        });

        $('#editRecord').click(function () {
            let id = $('#edit_id').val();
            $.ajax({
                url: `/dispatch-listing/price/edit/${id}`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    origin_location: $('#originE').val(),
                    destination_location: $('#destinationE').val(),
                    vehicle_type: $('#vehicle_typeE').val(),
                    vehicle_condition: $('#inoperableE').val(),
                    trailer_type: $('input[name="trailer-typeE"]:checked').val(),
                    dispatch_price: $('#dispatch_priceE').val(),
                },
                success: function (res) {
                    $('#editModal').modal('hide');
                    loadzipcoderules();
                    showSuccess('Price record updated successfully');
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Error updating record');
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

        $(document).on('click', '.deleteBtn', function () {
            let id = $(this).data('id');
            $.ajax({
                url: `/dispatch-listing/price/delete/${id}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (res) {
                    loadzipcoderules();
                    showSuccess('Dispatch Listing Price record deleted successfully');
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Error updating record');
                }
            });
        });
        

    </script>

    @include('Layout.footer')
</body>

</html>