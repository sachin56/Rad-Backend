(function ($) {
    "use strict";
    //active
    $('#order_list').addClass('active');

    //brand datatable
    var table=$('#order_list_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CVS',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            },
            {
                extend:    'colvis',
                text:      '<i class="fas fa-eye"></i>',
                titleAttr: 'PDF'
            }

        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "get-orders"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"customerEmail",searchable:false,orderable:false,sortable:false},
            {data:"customerMobile",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"status",searchable:false,orderable:false,sortable:false},
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


    //active
    $('#confirmed_order').addClass('active');

    //brand datatable
    var table=$('#confirmed_order_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CVS',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            },
            {
                extend:    'colvis',
                text:      '<i class="fas fa-eye"></i>',
                titleAttr: 'PDF'
            }

        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "get-confirmed-orders"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"customerEmail",searchable:false,orderable:false,sortable:false},
            {data:"customerMobile",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"deliveryStatus",searchable:false,orderable:false,sortable:false},
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


    //active
    $('#modified_order').addClass('active');

    //brand datatable
    var table=$('#modified_order_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CVS',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            },
            {
                extend:    'colvis',
                text:      '<i class="fas fa-eye"></i>',
                titleAttr: 'PDF'
            }

        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "get-modified-orders"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"customerEmail",searchable:false,orderable:false,sortable:false},
            {data:"customerMobile",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"status",searchable:false,orderable:false,sortable:false},
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

    $('#cancel_order_list').addClass('active');

    //brand datatable
    var table=$('#cancel_order_list_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CVS',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            },
            {
                extend:    'colvis',
                text:      '<i class="fas fa-eye"></i>',
                titleAttr: 'PDF'
            }

        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "get-cancel-request-orders"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"customerEmail",searchable:false,orderable:false,sortable:false},
            {data:"customerMobile",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"status",searchable:false,orderable:false,sortable:false},
            {data:"deliveryStatus",searchable:false,orderable:false,sortable:false},
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

