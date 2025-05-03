function delvelRule(id){

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this vehicle info!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Vehicle info has been deleted.',
                'success'
            )

            $.ajax({
                type: "POST",
                url: "/ajax/vehicle_size_queue.php",
                data: "delvelId=" + id,
                success: function(html){
                    $("#vehId"+id).remove();
                }
            });
        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your vehicle info is safe :)',
                'error'
            )
        }
    })
}

function addVehicle(){
    var model = document.getElementById('model').value;
    var make = document.getElementById('make').value;
    var buttonsubmit = document.getElementById('submit').value;
    $.ajax({
        type: "GET",
        url: "/ajax/del_veh.php",
        data: "model=" + model +
            "&make=" + make +
            "&submit=" + buttonsubmit,
        dataType: 'JSON',
        success: function(html){

            $("#make").val('');
            $("#model").val('');

            $("#result").append(`
                    <tr id="vehId${html.vehicleid}">
                        <td class="text-center">${html.make}</td>
                        <td class="text-center">${html.model}</td>
                        <td>
                            <select class="form-control" name="veh_type" id="veh_type" onchange="vehiclesizeUpdate(this,${html.vehicleid});">
                                                <option  value="1">Moped /Scooter</option>
                                                <option  value="2">Motorcycle - Small</option>
                                                <option  value="3">Motorcycle - Medium</option>
                                                <option  value="4">Motorcycle - Large</option>
                                                <option  value="5">Trike / ATV</option>
                                                <option  value="6">Car - Mini</option>
                                                <option  value="7">Car - Sports</option>
                                                <option  value="8">Car - Compact</option>
                                                <option  value="9">Car - Midsize</option>
                                                <option  value="10">Car - Large</option>
                                                <option  value="11">Minivan</option>
                                                <option  value="12">SUV - Small</option>
                                                <option  value="13">SUV - Medium</option>
                                                <option  value="14">SUV - Large</option>
                                                <option  value="15">Truck - Small 2WD</option>
                                                <option  value="16">Truck - Small 4WD</option>
                                                <option  value="17">Truck - Medium</option>
                                                <option  value="18">Truck - Large</option>
                                                <option  value="19">Truck - Extra Large</option>
                                                <option  value="20">Truck-Dually</option>
                                                <option  value="21">Truck-Commercial</option>
                                                <option  value="22">DO NOT QUOTE</option>
                                        </select>
                        </td>
                        <td>
                            <a target="_blank" href="http://images.google.com/images?q=${html.make}+${html.model}"><img src="/images/google.png" width="30"></a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onClick="delvelRule(${html.vehicleid});"><img src="/images/delete.png" /></a>
                        </td>
                    </tr>
                `);
        }
    });
}

function vehiclesizeUpdate(size,x) {
    var vehicle_size = size.value;

    var vId = x;
    $.ajax({
        type: "POST",
        url: "/ajax/vehicle_size_queue.php",
        data: "vehicle_size=" + vehicle_size +
            "&vId=" + vId,
        success: function(html){
        }
    });
}