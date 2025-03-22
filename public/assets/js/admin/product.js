(function ($) {
    "use strict";
    //active
    $('#product').addClass('active');

    //brand datatable
    var table=$('#product_table').DataTable( {
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
            url: "get-product"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:"name"},
            {data:"lfCode"},
            {data:"brand",searchable:false,orderable:false,sortable:false},
            {data:"category",searchable:false,orderable:false,sortable:false},
            {data:"retailPrice"},
            {data:"wholeSalePrice"},
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

//delete brand
function submitProductDeleteForm(form) {
    new Swal({
        title: "Are you sure?",
        text: "to delete this product ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes Delete",
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

$(document).on('change', '#sectorId', function(){
    $.ajax({
        type : 'GET',
        data : 'id='+ $("#sectorId").val(),
        url : url('admin/get-sub-sector-by-sector'),
        success : function(data){
            var json = JSON.parse(data);
            // empty your dropdown
            $('#subSectorId').empty();
            $('#subSectorId').append($("<option></option>").val('').html(' - Please Select Sub Sector - '));
            $.each(json, function($index, $value) {
                $('#subSectorId').append($("<option></option>").val($value.id).html($value.subSectorName));
            });
        }
    });
});

$(document).on('change keyup', '#buyingPrice, #priceMargin', function(){
    var buying_price = $("#buyingPrice").val();
    var price_margin = $("#priceMargin").val();
    if (buying_price == null || buying_price === '')
        buying_price = 0;
    if (price_margin == null || price_margin === '')
        price_margin = 0;
    var sell = parseFloat(buying_price) + (parseFloat(buying_price) * parseFloat(price_margin) / 100);
    $("#sellingPrice").val(sell.toFixed(2));
});


