var TableDatatables = function(){
    var handleProductTable = function(){
        var manageProductTable = $("#manage-product-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageProductTable.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL+filePath,
                type: "POST",
                data: {
                    "page": "manage_product"
                }
            },
            "lengthMenu": [
                [5, 15, 25, -1],
                [5, 15, 25, "All"]
            ],
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [
                {
                    'orderable': false,
                    'targets': [0, -2, -1]
                }
            ],

        });
        manageProductTable.on('click', '.delete', function(e){
            var id = $(this).data('id');
            $("#delete_record_id").val(id);
        });
        new $.fn.dataTable.Buttons(oTable, {
            buttons:[
                'copy', 'csv', 'pdf'
            ]
        } );
        oTable.buttons().container()
            .appendTo( $('#export-buttons') );
    }
    return {
        //main function to handle all the datatables
        init: function () {
            handleProductTable();
        }
    }
}();
jQuery(document).ready(function () {
    TableDatatables.init();
});