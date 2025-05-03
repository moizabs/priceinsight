function submitzipRule(){

    var data = $("#form1").serialize();

    $.ajax({
        type: "GET",
        url: "/ajax/add_zip.php",
        data: data,
        success: function(html){
            $(".success_result").prepend(html);
        }
    });
    // return fetchzipRules();
}

function fetchzipRules(){
    var zip_id = document.getElementById('zip').value;

    $.ajax({
        type: "GET",
        url: "fetch_rules_zip.php",
        data: "zip_id=" + zip_id,
        success: function(html){

            $("#results").html(html);
        }
    });
}

function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var limit = 15;
    var zip = $("#zip").val();
    var zipDest = $("#zipDest").val();
    $('#results').html('');
    $.ajax({
        type: 'POST',
        url: '/calc/response.php',
        data:'page='+page_num+'&zip='+zip+'&zipDest='+zipDest+'&limit='+limit+'&filter=zip_exception',
        beforeSend: function () {
        },
        success: function (html) {
            if(!zip) {
                $('#results').html('');
            } else {
                $('#results').html('');
                $('#results').html(html);
            }
        },
    });
}

function searchZip() {
    searchFilter(0)
}

function makeRoute(val) {
    var stName = val.value;
    if(stName=="route")
    {
        $("#routeWithDzip").html(`
                <div class="col-lg-2">
                    <input class="form-control" type="text" name="zip" id="zip" onkeyup="searchZip()" placeholder="Ori Zip Code" onfocus="">
                </div>
                <div class="col-lg-2">
                    <input class="form-control" type="text" name="zipDest" id="zipDest" onkeyup="searchZip()" placeholder="Dest Zip Code" onfocus="">
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="input-group" style="width: 155px;">
                            <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" id="add_amt" name="add_amt" maxlength="5" placeholder="" class="form-control" style="width: 75%; flex: unset">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="input-group" style="width: 155px;">
                            <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                <i class="fa fa-percent"></i>
                            </div>
                            <input type="number" id="add_amt_per" name="add_amt_per" min='0' maxlength="5" placeholder="" class="form-control" style="width: 74%; flex: unset">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <input type="submit" name="Submit" id="Submit" value="Add Rule" class="btn btn-primary ml-3" />
                </div>
                <div class="col-lg-3"></div>
            `);
        $("#routeWithOutDzip").html('');
    }
    else
    {
        $("#routeWithDzip").html('');
        $("#routeWithDzip").html(`
                <div class="col-lg-3">
                    <input class="form-control" type="text" name="zip" id="zip" onkeyup="searchZip()" placeholder="Enter Zip Code" onfocus="">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="input-group" style="width: 155px;">
                            <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" id="add_amt" name="add_amt" maxlength="5" placeholder="" class="form-control" style="width: 75%; flex: unset">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="input-group" style="width: 155px;">
                            <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                                <i class="fa fa-percent"></i>
                            </div>
                            <input type="number" id="add_amt_per" name="add_amt_per" min='0' maxlength="5" placeholder="" class="form-control" style="width: 74%; flex: unset">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <input type="submit" name="Submit" id="Submit" value="Add Rule" class="btn btn-primary ml-3" />
                </div>
                <div class="col-lg-3"></div>
            `);
    }
}

$("#routeWithDzip").html(`
    <div class="col-lg-3">
        <input class="form-control" type="text" name="zip" id="zip" onkeyup="searchZip()" placeholder="Enter Zip Code" onfocus="">
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-2">
        <div class="form-group">
            <div class="input-group" style="width: 155px;">
                <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="add_amt" name="add_amt" maxlength="5" placeholder="" class="form-control" style="width: 75%; flex: unset">
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <div class="input-group" style="width: 155px;">
                <div class="input-group-addon" style="border-radius: .25rem 0 0 .25rem;">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="number" id="add_amt_per" name="add_amt_per" min='0' maxlength="5" placeholder="" class="form-control" style="width: 74%; flex: unset">
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <input type="submit" name="Submit" id="Submit" value="Add Rule" class="btn btn-primary ml-3" />
    </div>
    <div class="col-lg-3"></div>
`);