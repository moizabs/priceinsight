<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .swal2-cancel {
        margin-right: 20px;
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
                            <h2 class="title-1 mb-2">Last Activity</h2>
                        </div>
                    </div>
                </div>

                <div class="card" id="results">
                    <div class="card-header text-black">
                        <strong>Last Activity</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Date</th>
                                        <th class="text-center font-weight-bold">Name</th>
                                        <th class="text-center font-weight-bold">Ip</th>
                                        <th class="text-center font-weight-bold">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            {{ $last_Activity->last_login_at }}
                                        </td>
                                        <td class="text-center">
                                            {{ $last_Activity->name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $last_Activity->ip }}
                                        </td>
                                        <td class="text-center">
                                            {{ $last_Activity->location }}
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
                            <p>Copyright © 2025 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('Layout.footer')
</body>

</html>
