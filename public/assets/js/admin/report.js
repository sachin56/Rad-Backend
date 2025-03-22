(function ($) {
    "use strict";
    //active
    $('#order_wise_report').addClass('active');

    var total = 0;
    var pageTotal = 0;
    var col_id = 5;
    //brand datatable
    var table=$('#order_wise_report_table').DataTable( {
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
            url: "get-order-wise-sales",
            data: function (data) {
                data.filter_date_range = $('#filter_date_range').val();
                data.filter_status = $('#filter_status').val();
                data.filter_customer = $('#filter_customer').val();
                data.filter_order_no = $('#filter_order_no').val();
            }
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"orderNo"},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"status",searchable:false,orderable:false,sortable:false},
            {data:"amount", name:"amount", searchable:false,orderable:false,sortable:false}
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
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return i.toString().replace(/[^0-9\.]+/g,"")*1;
            };

            col_id = 5;

            // Total over all pages
            total = api
                .column( col_id )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( col_id, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $('.footer_total_summary').html(
                '$' + pageTotal.toFixed(2) +' ( $'+ total.toFixed(2) +' total)'
            );
        }
    });


    $('#product_wise_report').addClass('active');

    var total_pro = 0;
    var pageTotal_pro = 0;
    var total_qty = 0;
    var pageTotal_qty = 0;
    var col_id_pro = 6;
    var col_id_qty = 5;
    //brand datatable
    var table_product=$('#product_wise_report_table').DataTable( {
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
            url: "get-product-wise-sales",
            data: function (data) {
                data.filter_date_range = $('#filter_date_range').val();
                data.filter_customer = $('#filter_customer').val();
                data.filter_order_no = $('#filter_order_no').val();
                data.filter_product = $('#lfCode').val();
                data.filter_status = $('#filter_status').val();
            }
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"product",searchable:false,orderable:false,sortable:false},
            {data:"orderNo",searchable:false,orderable:false,sortable:false},
            {data:"customerName",searchable:false,orderable:false,sortable:false},
            {data:"orderDate",searchable:false,orderable:false,sortable:false},
            {data:"itemPrice", name:"itemPrice", searchable:false,orderable:false,sortable:false},
            {data:"qty",searchable:false,orderable:false,sortable:false},
            {data:"amount", name:"amount", searchable:false,orderable:false,sortable:false}
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
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return i.toString().replace(/[^0-9\.]+/g,"")*1;
            };

            col_id_pro = 6;
            col_id_qty = 5;

            // Total over all pages
            total_pro = api
                .column( col_id_pro )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal_pro = api
                .column( col_id_pro, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over all pages
            total_qty = api
                .column( col_id_qty )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal_qty = api
                .column( col_id_qty, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $('.footer_total_summary').html(
                '$' + pageTotal_pro.toFixed(2) +' ( $'+ total_pro.toFixed(2) +' total)'
            );

            $('.footer_total_summary_qty').html(
                pageTotal_qty.toFixed(0) +' ( '+ total_qty.toFixed(0) +' total)'
            );
        }
    });

    $('#filter_status').on('change', function () {
        table.draw();
        table_product.draw();
    });

    $('#filter_customer').on('change', function () {
        table.draw();
        table_product.draw();
    });

    $('#filter_sales_agent').on('change', function () {
        table.draw();
    });

    $('#filter_order_no').on('keyup', function () {
        table.draw();
        table_product.draw();
    });

    $('#lfCode').on('change', function () {
        table_product.draw();
    });

    $('#filter_date_range').on('apply.daterangepicker', function () {
        table.draw();
        table_product.draw();
    });

    $('#filter_date_range').on('cancel.daterangepicker', function () {
        $(this).val('');
        table.draw();
        table_product.draw();
    });

})(jQuery);

