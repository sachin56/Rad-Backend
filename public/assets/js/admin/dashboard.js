(function ($) {
    "use strict";
    //active
    $('#cancel_request_list').addClass('active');

    //brand datatable
    var table=$('#cancel_request_list_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "dashboard/cancel-request"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"salesAgent",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"amount",searchable:false,orderable:false,sortable:false},
            {data:"action",searchable:false,orderable:false,sortable:false}//action
        ],
        "language": {
            "sEmptyTable":     "No data available in table",
            "sInfo":           "Showing"+" _START_ "+"to"+" _END_ "+"of"+" _TOTAL_ "+"records",
            "sInfoEmpty":      "Showing"+" 0 "+"to"+" 0 "+"of"+" 0 "+"records",
            "sInfoFiltered":   "("+"filtered"+" "+"from"+" _MAX_ "+"total"+" "+"records"+")",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Show"+" _MENU_ "+"records",
            "sLoadingRecords": "Loading...",
            "sProcessing":     "Processing...",
            "sSearch":         "Search"+":",
            "sZeroRecords":    "No matching records found",
            "oPaginate": {
                "sFirst":    "First",
                "sLast":     "Last",
                "sNext":     "Next",
                "sPrevious": "Previous"
            },
        }
    });

    $('#today_orders').addClass('active');

    //brand datatable
    var table=$('#today_orders_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "dashboard/today-orders"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"salesAgent",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"amount",searchable:false,orderable:false,sortable:false},
            {data:"action",searchable:false,orderable:false,sortable:false}//action
        ],
        "language": {
            "sEmptyTable":     "No data available in table",
            "sInfo":           "Showing"+" _START_ "+"to"+" _END_ "+"of"+" _TOTAL_ "+"records",
            "sInfoEmpty":      "Showing"+" 0 "+"to"+" 0 "+"of"+" 0 "+"records",
            "sInfoFiltered":   "("+"filtered"+" "+"from"+" _MAX_ "+"total"+" "+"records"+")",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Show"+" _MENU_ "+"records",
            "sLoadingRecords": "Loading...",
            "sProcessing":     "Processing...",
            "sSearch":         "Search"+":",
            "sZeroRecords":    "No matching records found",
            "oPaginate": {
                "sFirst":    "First",
                "sLast":     "Last",
                "sNext":     "Next",
                "sPrevious": "Previous"
            },
        }
    });

})(jQuery);

//confirm order
function submitOrderConfirmForm(form) {
    new Swal({
        title: "Are you sure?",
        text: "to confirm this order ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes Confirm",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
    })
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
                $("#btn_confirm").attr("disabled", true);
                return true;
            }
        })
    return false;
}

//confirm order
function submitOrderCancelForm(form) {
    new Swal({
        title: "Are you sure?",
        text: "to cancel this order ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes Cancel",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
    })
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    return false;
}

function submitOrderCancelRejectForm(form) {
    new Swal({
        title: "Are you sure?",
        text: "to reject this cancel request ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
    })
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    return false;
}

