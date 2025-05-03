function vehiclesizeUpdate() {
    var vehicle_size = document.getElementById('veh_type').value;
    var vehicle_perval = document.getElementById('priceadj1').value;
    var vehicle_fxval = document.getElementById('priceadj').value;
    $.ajax({
        type: "GET",
        url: "/ajax/del_veh.php",
        data: "vehicle_size=" + vehicle_size +"&vehicle_perval=" + vehicle_perval +"&vehicle_fxval=" + vehicle_fxval,
        success: function(html){
            // $("#content").html(html);
            return vehicleSizeSetting();
        }
    });
}
function checkvalue()
{
    var vehicle_size = document.getElementById('veh_type').value;
    $.ajax({
        type: "GET",
        url: "/ajax/del_veh.php",
        data: "vehicle_size=" + vehicle_size +"&getdata=getdata",
        success: function(html){
            if(html!="") {
                var n=html.split(",");
                if(n[0]!="")
                {
                    document.getElementById("priceadj1").value=n[0];
                } else {
                    document.getElementById("priceadj1").value="";
                }
                document.getElementById("priceadj").innerHTML=n[1];
            }
            //$("#content").html(html);
        }
    });
}