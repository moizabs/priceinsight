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
                            <h2 class="title-1 mb-2">State Exceptions</h2>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>State Search</strong>
                    </div>
                    <div class="card-body card-block">
                        <p class="help-block">
                            Select State and Create/View/Delete Rules
                        </p>
                        <div class="form-group">
                            <select name="stateRule" id="stateRuleId" class="form-control" style="width: auto;">
                                <option value="NO">Select State</option>
                                <option value="Maryland">Maryland</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Maryland</strong>
                    </div>
                    <div class="card-body card-block">

                        <h3 style="margin-bottom:15px;">Create a rule for Maryland</h3>

                        <div class="row">

                            <div class="col-lg-2">
                                <select name="orig_dest" id="orig_dest" class="form-control" style="width: auto;">
                                    <option selected="selected">Select</option>
                                    <option value="any">Any</option>
                                    <option value="route">Route</option>
                                    <option value="origin">Origin</option>
                                    <option value="destination">Destination</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="add_sub" id="add_sub" class="form-control" style="width: auto;">
                                    <option selected="selected">Select</option>
                                    <option value="add">Add</option>
                                    <option value="sub">Subtract</option>
                                    <option value="no">Don't Quote</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <select name="stateDestRule" id="stateDestRule" class="form-control"
                                        style="width: auto;">
                                        <option value="NO">Select State</option>
                                        <option value="Nebraska">Nebraska</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="input-group" style="width: 155px;">
                                        <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <input name="add_amt" id="add_amt" type="text" maxlength="5"
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
                                        <input name="add_amt_zip" id="add_amt_zip" type="number" min="0"
                                            maxlength="5" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <input name="st" id="st" value="AZ" type="hidden" />
                            <div class="col-lg-1">
                                <input type="submit" name="Submit" id="submit" value="Add Rule"
                                    class="btn btn-primary ml-3">
                            </div>
                            <div class="col-lg-3"></div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-black">
                        <strong>Current Rules</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold">Origin / Destination</th>
                                        <th class="text-center font-weight-bold">Amount</th>
                                        <th class="text-center font-weight-bold">Add /Subtract</th>
                                        <th class="text-center font-weight-bold">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>Route CT -> MD</td>
                                        <td>$140</td>
                                        <td>Add</td>
                                        <td><a href="javascript:;"><img src="{{ asset('images/delete.png') }}" /></a>
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

    @include('Layout.footer')


</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#route").hide();

    });

    function delstateRule(id) {
        $.ajax({
            type: "GET",
            url: "/ajax/state/del_rule.php",
            data: "id=" + id + "&userobj=" + 987897,
            success: function(html) {
                $("#delrule").html(html);
            }
        });
        return fetchstateRules();
    }

    function submitStateRule() {

        var orig_dest = document.getElementById('orig_dest').options[document.getElementById('orig_dest').selectedIndex]
            .value;
        var add_sub = document.getElementById('add_sub').options[document.getElementById('add_sub').selectedIndex]
            .value;
        var add_amt = document.getElementById('add_amt').value;
        var origin = document.getElementById('stateRuleId').options[document.getElementById('stateRuleId')
            .selectedIndex].value;
        var desti = document.getElementById('stateDestRule').options[document.getElementById('stateDestRule')
            .selectedIndex].value;
        var buttonsubmit = document.getElementById('submit').value;

        $.ajax({
            type: "GET",
            url: "/ajax/state/del_rule.php",
            data: "orig_dest=" + orig_dest +
                "&origin=" + origin +
                "&desti=" + desti +
                "&add_sub=" + add_sub +
                "&add_amt=" + add_amt + "&userobj=" + 154212,

            success: function(html) {
                //$("#createrule").html(html);
                return getstateRules();
            }
        });
    }

    function fetchstateRules() {
        var state_id = document.getElementById('stateRuleId').options[document.getElementById('stateRuleId')
            .selectedIndex].value;
        $.ajax({
            type: "GET",
            url: "/ajax/state/fetch_rules.php",
            data: "state_id=" + state_id + "&userobj=" + 326556,
            success: function(html) {
                $("#showrules").html(html);
            }
        });
    }

    function makeRoute() {
        var stName = document.getElementById('orig_dest').value;
        if (stName == "route") {
            $("#route").show();
        } else {
            $("#route").hide();
        }
    }

    function getstateRules() {
        var state_id = document.getElementById('stateRuleId').options[document.getElementById('stateRuleId')
            .selectedIndex].value;
        if (state_id == 'NO') {
            return stateExceptions();
        } else {
            $.ajax({
                type: "GET",
                url: "/ajax/state/create_rule.php",
                data: "state_id=" + state_id + "&userobj=" + 012010,
                success: function(html) {
                    $("#createrule").html(html);
                }
            });
            return fetchstateRules(state_id);
        }
    }
</script>
