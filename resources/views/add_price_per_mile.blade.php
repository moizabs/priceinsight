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
                            <h2 class="title-1 mb-2">Add Price Per Mile</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Price Records</strong>
                    </div>

                    <div class="card-body card-block">

                        <a href="{{ route('price.per.mile') }}" name="add"
                            class="btn-primary btn-sm pull-right">Back to Record List</a>
                        <br /><br />

                        <div class="row">

                            <div class="col-lg-3">
                                <label class="text-black font-weight-bold">Start Range</label>
                                <div class="form-group">
                                    <div class="input-group" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-sort-numeric-down"></i>
                                        </div>
                                        <input type="text" id="start_range" name="start_range" maxlength="6"
                                            placeholder="" class="form-control" style="width: 75%; flex: unset"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="text-black font-weight-bold">End Range</label>
                                <div class="form-group">
                                    <div class="input-group" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-sort-numeric-up"></i>
                                        </div>
                                        <input type="text" id="end_range" name="end_range" maxlength="6"
                                            placeholder="" class="form-control" style="width: 75%; flex: unset"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <label class="text-black font-weight-bold">Price</label>
                                <div class="form-group">
                                    <div class="input-group" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="text" id="price" name="price" maxlength="6"
                                            placeholder="" class="form-control" style="width: 75%; flex: unset"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <input type="submit" name="Submit" id="Submit_PPM" value="Submit"
                                    class="btn btn-outline-primary ml-3" style="margin-top: 13%;" />
                            </div>
                        </div>

                        <br />

                        <div class="table-responsive table--no-card m-b-30" id="contentMid">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Milage Range</th>
                                        <th class="text-center font-weight-bold">Price</th>
                                        <th class="text-center font-weight-bold">Entered By</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2019 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            function loadAllRecords() {
                $.ajax({
                    url: "{{ route('get.price.per.mile') }}",
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            let rows = '';
                            response.data.forEach(function(item) {
                                rows += `
                                    <tr>
                                        <td class="text-center">${item.range}</td>
                                        <td class="text-center">$ ${item.price}</td>
                                        <td class="text-center">${item.entered_by}</td>
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

            loadAllRecords();


            $('#Submit_PPM').click(function(e) {

                if (($('#start_range').val() == '') || ($('#end_range').val() == '') || ($('#price')
                    .val() == '')) {
                    alert('All fields are required');
                } else {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('store.price.per.mile') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            start_range: $('#start_range').val(),
                            end_range: $('#end_range').val(),
                            price: $('#price').val()
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#start_range').val('');
                                $('#end_range').val('');
                                $('#price').val('');
                                loadAllRecords();
                            }
                        },
                        error: function() {
                            alert('Error submitting record');
                        }
                    });
                }
            });
        });
    </script>

    @include('Layout.footer')
</body>
</html>
