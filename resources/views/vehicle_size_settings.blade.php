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
                            <h2 class="title-1 mb-2">Vehicle Size Settings</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Vehicle Size Pricing</strong>
                    </div>
                    <div class="card-body card-block">

                        <form method="post" action="javascript:void(0)" name="form1" id="form1">

                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-5">
                                    <label for="make" class="font-weight-bold">Vehicle Type:</label>
                                    <select class="form-control" name="veh_type" id="veh_type">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="Motorcycle - Small">Motorcycle - Small</option>
                                        <option value="Motorcycle - Small">Motorcycle - Large</option>
                                    </select>
                                </div>

                                <div class="col-lg-5">
                                    <label for="model" class="font-weight-bold">Add or Deduct:</label>
                                    <input class="form-control" type="text" name="priceadj1" id="priceadj1"
                                        placeholder="Enter Add or Deduct">
                                </div>
                            </div>

                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-10">
                                    <label for="model" class="font-weight-bold">Fixed Price:</label>
                                    <select class="form-control" name="priceadj" id="priceadj">
                                        <option value="+1000">+1000</option>
                                        <option value="+950">+950</option>
                                        <option value="+900">+900</option>
                                        <option value="+850">+850</option>
                                        <option value="+800">+800</option>
                                        <option value="+750">+750</option>
                                        <option value="+700">+700</option>
                                        <option value="+650">+650</option>
                                        <option value="+600">+600</option>
                                        <option value="+550">+550</option>
                                        <option value="+500">+500</option>
                                        <option value="+450">+450</option>
                                        <option value="+400">+400</option>
                                        <option value="+350">+350</option>
                                        <option value="+300">+300</option>
                                        <option value="+250">+250</option>
                                        <option value="+200">+200</option>
                                        <option value="+150">+150</option>
                                        <option value="+100">+100</option>
                                        <option value="+50">+50</option>
                                        <option selected="selected" value="0">0</option>
                                        <option value="-50">-50</option>
                                        <option value="-100">-100</option>
                                        <option value="-150">-150</option>
                                        <option value="-200">-200</option>
                                        <option value="-250">-250</option>
                                        <option value="-300">-300</option>
                                        <option value="-350">-350</option>
                                        <option value="-400">-400</option>
                                        <option value="-450">-450</option>
                                        <option value="-500">-500</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row justify-content-center mb-5">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>

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

    <script src="{{ asset('js/ajax/vehicle_size_setting.js') }}"></script>
    @include('Layout.footer')
</body>

</html>
