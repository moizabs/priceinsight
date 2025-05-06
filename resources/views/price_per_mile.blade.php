<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<style>
    .slider-container {
        width: 100%;
        max-width: 80%;
        margin: 30px auto;
        /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
    }
    
    .slider-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        align-items: center;
    }
    
    .slider-title {
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }
    
    .slider-value {
        font-size: 18px;
        font-weight: bold;
        color: #2c7be5;
        background: #f0f4f9;
        padding: 4px 12px;
        border-radius: 20px;
        min-width: 60px;
        text-align: center;
    }
    
    .slider-track {
        width: 100%;
        height: 6px;
        background: #e6e9ed;
        border-radius: 3px;
        position: relative;
    }
    
    .slider-progress {
        height: 100%;
        background: #2c7be5;
        border-radius: 3px;
        position: absolute;
        left: 0;
    }
    
    input[type="range"] {
        width: 100%;
        height: 6px;
        -webkit-appearance: none;
        appearance: none;
        background: transparent;
        position: absolute;
        top: 0;
        z-index: 2;
    }
    
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #ffffff;
        border: 2px solid #2c7be5;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #ffffff;
        border: 2px solid #2c7be5;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .slider-ticks {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
    }
    
    .slider-tick {
        font-size: 12px;
        color: #7d8c9e;
        /* position: relative; */
        /* width: 1px; */
        text-align: center;
    }
    
    .slider-tick::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 1px;
        height: 5px;
        background: #d1d7e0;
    }
    
    .adjustment-controls {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .adjustment-info {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 20px;
        border-left: 4px solid #2c7be5;
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
                            <h2 class="title-1 mb-2">Price Per Mile</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Price Adjustment</strong>
                    </div>

                    <div class="card-body card-block">
                        <a href="{{ route('add.price.per.mile') }}" name="add"
                            class="btn-primary btn-sm pull-right">Add Records</a>

                        <div class="adjustment-controls">
                            <p class="help-block m-0">
                                All pricing will be adjusted by:
                            </p>
                            <input type="text" id="amount" name="amount" value="0%" placeholder="" 
                                class="form-control" style="width: 80px; text-align: center;" readonly>

                            <input type="button" name="applyadjustment" id="applyadjustment" 
                                class="btn-primary btn-sm" value="Apply Adjustment">

                            {{-- <input type="button" name="reset" id="reset" class="btn-danger btn-sm" 
                                value="Reset Prices" style="display: none;"> --}}
                        </div>

                        <div class="adjustment-info">
                            <i class="fa fa-info-circle"></i> Adjusting prices will modify all existing records by the selected percentage.
                        </div>

                        <div class="slider-container">
                            <div class="slider-header">
                                <span class="slider-title">Adjustment Percentage</span>
                                <span class="slider-value" id="sliderValue">0%</span>
                            </div>
                            <div class="slider-track">
                                <div class="slider-progress" id="sliderProgress"></div>
                                <input type="range" min="-100" max="100" value="0" step="1" id="percentageSlider">
                            </div>
                            <div class="slider-ticks">
                                <span class="slider-tick">-100%</span>
                                <span class="slider-tick">-50%</span>
                                <span class="slider-tick">0%</span>
                                <span class="slider-tick">50%</span>
                                <span class="slider-tick">100%</span>
                            </div>
                        </div>

                        <div class="table-responsive table--no-card m-b-30" id="contentMid">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Milage Range</th>
                                        <th class="text-center font-weight-bold">Price</th>
                                        <th class="text-center font-weight-bold">Entered By</th>
                                        <th class="text-center font-weight-bold">Entery Date</th>
                                        <th class="text-center font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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

    <!-- Error Modal -->
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
                    <p class="mt-3" id="errorMessage">Error updating the price per mile.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div>
    
    <!-- Success Modal -->
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
            <div class="modal-content"> 
                <div class="modal-body text-center p-lg-4"> 
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                    </svg> 
                    <h4 class="text-success mt-3">Success!</h4>
                    <p class="mt-3" id="successMessage">You have successfully updated Price Per Mile.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Price Per Mile</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="form-group">
                        <label>Start Range</label>
                        <input type="number" id="edit_start_range" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>End Range</label>
                        <input type="number" id="edit_end_range" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" id="edit_price" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="updateRecord" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let originalPrices = {};
            let currentPercentage = 0;
            
            // Initialize slider
            const slider = document.getElementById('percentageSlider');
            const sliderValue = document.getElementById('sliderValue');
            const sliderProgress = document.getElementById('sliderProgress');
            const amountDisplay = document.getElementById('amount');
            
            function updateSlider() {
                const value = slider.value;
                currentPercentage = parseInt(value);
                const displayText = value > 0 ? `+${value}%` : `${value}%`;
                
                sliderValue.textContent = displayText;
                amountDisplay.value = displayText;
                
                // Update progress bar (different colors for positive/negative)
                sliderProgress.style.width = `${Math.abs(value)}%`;
                sliderProgress.style.background = value >= 0 ? '#2c7be5' : '#db3646';
                
                // Show/hide reset button
                if (value != 0) {
                    $('#reset').show();
                } else {
                    $('#reset').hide();
                }
            }
            
            slider.addEventListener('input', updateSlider);
            updateSlider();
            
            // Load all records
            function loadAllRecords() {
                $.ajax({
                    url: "{{ route('get.price.per.mile') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            let rows = '';
                            originalPrices = {}; // Reset original prices
                            
                            response.data.forEach(function(item) {
                                originalPrices[item.id] = parseFloat(item.price);
                                
                                rows += `
                                <tr data-id="${item.id}">
                                    <td class="text-center">${item.range}</td>
                                    <td class="text-center price-cell">$ ${item.price}</td>
                                    <td class="text-center">${item.entered_by}</td>
                                    <td class="text-center">${formatDate(item.entery_date)}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="editBtn" 
                                            data-id="${item.id}" 
                                            data-start="${item.start_range}" 
                                            data-end="${item.end_range}" 
                                            data-price="${item.price}">Edit</a>
                                    </td>
                                </tr>`;
                            });
                            $('#contentMid tbody').html(rows);
                        }
                    },
                    error: function() {
                        showError('Error loading records');
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
            
            // Apply percentage adjustment to all prices
            $('#applyadjustment').click(function() {
                if (currentPercentage === 0) {
                    showError('Please select a percentage other than 0%');
                    return;
                }
                
                if (!confirm(`Are you sure you want to adjust all prices by ${currentPercentage > 0 ? '+' : ''}${currentPercentage}%?`)) {
                    return;
                }
                
                $.ajax({
                    url: "{{ route('adjust.price.per.mile') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        percentage: currentPercentage
                    },
                    success: function(response) {
                        if (response.success) {
                            loadAllRecords();
                            showSuccess(`All prices have been adjusted by ${currentPercentage > 0 ? '+' : ''}${currentPercentage}% successfully.`);
                            slider.value = 0;
                            updateSlider();
                        } else {
                            showError(response.message || 'Error adjusting prices');
                        }
                    },
                    error: function(xhr) {
                        showError(xhr.responseJSON?.message || 'Server error occurred');
                    }
                });
            });
            
            // Edit record functionality
            $(document).on('click', '.editBtn', function() {
                $('#edit_id').val($(this).data('id'));
                $('#edit_start_range').val($(this).data('start'));
                $('#edit_end_range').val($(this).data('end'));
                $('#edit_price').val($(this).data('price'));
                $('#editModal').modal('show');
            });
            
            $('#updateRecord').click(function() {
                let id = $('#edit_id').val();
                $.ajax({
                    url: `/price-per-mile/update/${id}`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        start_range: $('#edit_start_range').val(),
                        end_range: $('#edit_end_range').val(),
                        price: $('#edit_price').val(),
                    },
                    success: function(res) {
                        $('#editModal').modal('hide');
                        loadAllRecords();
                        showSuccess('Price record updated successfully');
                    },
                    error: function(xhr) {
                        showError(xhr.responseJSON?.message || 'Error updating record');
                    }
                });
            });
            
            // Initial load
            loadAllRecords();
        });
    </script>

    @include('Layout.footer')
</body>
</html>