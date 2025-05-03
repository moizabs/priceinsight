<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<body class="animsition">
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
                        <p class="help-block pull-left" style="line-height: 35px;">
                            All pricing will be adjusted by:
                        </p>
                        <input type="text" id="amount" name="amount" value="0%" placeholder=""
                            class="form-control pull-left" style="width: auto; border: unset;">
                        <input type="button" name="applyadjustment" id="applyadjustment"
                            class="btn-primary btn-sm pull-right ml-2" value="Apply Adjustment">
                        <input type="button" name="reset" id="reset" class="btn-primary btn-sm pull-right"
                            value="Reset Prices">
                        {{-- <input type="hidden" id="amount1"/> --}}

                        <div class="clearfix"></div>

                        <div style="margin:30px 0;" id="slider-range"></div>

                        <div class="row">
                            <div class="col-lg-3 text-center">
                                <label class="text-black font-weight-bold"></label>
                            </div>
                            <div class="col-lg-3 text-center">
                                <label class="text-black font-weight-bold">Highway</label>
                                <div class="form-group">
                                    <div class="input-group" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="text" id="ppm" name="ppm" maxlength="6"
                                            value="755412" placeholder="" class="form-control"
                                            style="width: 75%; flex: unset">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 text-center">
                                <label class="text-black font-weight-bold">Non-Highway</label>
                                <div class="form-group">
                                    <div class="input-group" style="width: 270px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="text" id="ppm_non_hwy" name="ppm_non_hwy" maxlength="6"
                                            value="56456" placeholder="" class="form-control"
                                            style="width: 75%; flex: unset">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="text-black font-weight-bold">
                                    <input type="hidden" name="field_id" id="field_id" value="564564"
                                        style="margin-left:10px;" />
                                </label>
                                <input type="submit" name="Submit" id="Submit" value="Update"
                                    class="btn btn-primary ml-3" style="margin-top: 15%;" />
                            </div>
                        </div>

                        <div class="table-responsive table--no-card m-b-30" id="contentMid">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Milage Range</th>
                                        <th class="text-center font-weight-bold">Highway</th>
                                        <th class="text-center font-weight-bold">Non-Highway</th>
                                        <th class="text-center font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center">
                                            1 to 100
                                        </td>
                                        <td class="text-center">
                                            1.208
                                        </td>
                                        <td>
                                            1.260
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);">Edit</a>
                                        </td>
                                    </tr>

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

    <script src="{{ asset('js/ajax/setbasicprice.js') }}"></script>
    <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.core.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.mouse.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.slider.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.sortable.js') }}"></script>
    @include('Layout.footer')
</body>

</html>
