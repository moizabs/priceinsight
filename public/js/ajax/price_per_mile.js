function displayRecords(pid){
    $.ajax({
        type: "GET",
        url: "/ajax/price_per_mile.php",
        data: "id=" + pid,
        success: function(html){
            $("#content").html(html);
            $("#dashboard").removeClass('active');
            $("#basicPricing").removeClass('active');
            $("#pricePerMile").addClass('active');
        }
    });
}

function saveEntry(){
    var ppm = document.getElementById('ppm').value;
    var ppm_non_hwy = document.getElementById('ppm_non_hwy').value;
    var field_id = document.getElementById('field_id').value;
    var submit_button = document.getElementById('Submit').value;

    $.ajax({
        type: "POST",
        url: "/ajax/price_per_mile.php",
        data: "ppm=" + ppm +
            "&ppm_non_hwy=" + ppm_non_hwy +
            "&field_id=" + field_id +
            "&submit=" + submit_button,
        success: function(html){
            $("#content").html(html);
            return displayRecords(field_id);
        }
    });
}

function resetall()
{
    var ppm1='1';
    $.ajax({
        type: "POST",
        url: "/ajax/price_per_mile.php",
        data: "resetall=" + ppm1,
        success: function(html){
            $("#content").html(html);
        }
    });
}

function adjustall()
{
    var amountval=document.getElementById("amount1").value;
    var ppm1='1';
    $.ajax({
        type: "POST",
        url: "/ajax/price_per_mile.php",
        data: "adjustall1=" + ppm1 +
            "&amount=" + amountval ,
        success: function(html){
            $("#content").html(html);
        }
    });
}

$( "#slider-range" ).slider({
    range: true,
    min: -100,
    max: 100,
    values: [ 0, 100 ],
    slide: function( event, ui ) {
        $( "#amount" ).val( + ui.values[ 0 ] + "%");
        $("#amount1").val(ui.values[ 0 ]);
        for(var n=1; n<=36; n++)
        {
            var minfinal=document.getElementById("test"+n+"");
            if(minfinal) {
                var minfinal1=document.getElementById("tst"+n+"").value;
                var finalminimun=((minfinal1*ui.values[ 0 ])/100).toFixed(4);
                document.getElementById("test"+n+"").value=parseFloat(finalminimun) + parseFloat(minfinal1);
                var minfinal1_max=document.getElementById("tast"+n+"").value;
                var finalmax=((minfinal1_max*ui.values[ 0 ])/100).toFixed(4);
                document.getElementById("max"+n+"").value=parseFloat(finalmax) + parseFloat(minfinal1_max);
            }
        }
    }
});