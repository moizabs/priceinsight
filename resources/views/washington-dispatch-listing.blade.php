<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #origin_zipcode, #destination_zipcode{
        display: none
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a, .pagination span {
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

                <div class="card-header text-black">
                    <strong>Dispatch Listing</strong>
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
                                    <th class="text-center font-weight-bold">Created at</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container" id="paginationContainer"></div>
                </div>

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
        let currentPage = 1;
        const recordsPerPage = 10;

        function loadzipcoderules(page = 1) {
            currentPage = page;
            $.ajax({
                url: "{{ route('get.all.dispatch.listing') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        let rows = '';
                        const totalRecords = response.data.length;
                        const totalPages = Math.ceil(totalRecords / recordsPerPage);
                        const paginatedData = paginateData(response.data, page, recordsPerPage);
                        
                        paginatedData.forEach(function(item) {
                            rows += `
                                <tr>
                                    <td class="text-center">${item.status}</td>
                                    <td class="text-center">${item.origin_location}</td>
                                    <td class="text-center">${item.destination_location}</td>
                                    <td class="text-center">${item.vehicle_info}</td>
                                    <td class="text-center">$ ${item.price}</td>
                                    <td class="text-center">$ ${item.dispatch_price}</td>
                                    <td class="text-center">${formatDate(item.entery_date)}</td>
                                </tr>
                            `;
                        });
                        
                        $('#contentMid tbody').html(rows);
                        renderPagination(totalPages, page);
                    }
                },
                error: function(xhr, status, error) {
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

        loadzipcoderules();
    </script>

    @include('Layout.footer')
</body>
</html>