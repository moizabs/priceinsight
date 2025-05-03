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
                type: "GET",
                url: "/ajax/del_veh.php",
                data: "id=" + id,
                success: function(html){
                    searchFilter(0)
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

function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var limit = 15;
    var make = $("#v_make").val();
    var model = $("#v_model").val();
    $('#results').html('');
    $.ajax({
        type: 'POST',
        url: '/calc/response.php',
        data:'page='+page_num+'&make='+make+'&model='+model+'&limit='+limit+'&filter=vehicle_size',
        beforeSend: function () {
        },
        success: function (html) {
            $('#results').html('');
            $('#results').html(html);
        },
    });
}

function searchVehicle(name) {
    searchFilter(0)
}

function vehiclesizeUpdate(selc,x) {
    //alert(selc.value);
    var vehicle_size = selc.value;
    var vId = x;
    $.ajax({
        type: "POST",
        url: "/ajax/vehicle_size.php",
        data: "vehicle_size=" + vehicle_size +"&vId=" + vId,
        success: function(html){
            $("#content").html(html);
        }
    });
}