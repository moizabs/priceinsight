function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var limit = 15;
    $('#results').html('');
    $.ajax({
        type: 'POST',
        url: '/calc/response.php',
        data:'page='+page_num+'&limit='+limit+'&filter=view_exceptions',
        beforeSend: function () {
        },
        success: function (html) {
            $('#results').html('');
            $('#results').html(html);
        },
    });
}

function delstateRule(id){

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this exception info!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Exception info has been deleted.',
                'success'
            )

            $.ajax({
                type: "GET",
                url: "/ajax/del_rule.php",
                data: "id=" + id,
                success: function(html){
                }
            });
            return viewExceptions();
        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Exception info is safe :)',
                'error'
            )
        }
    })

}