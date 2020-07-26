var TableDatatables = function(){
    var handleSupplierTable = function(){
        var manageSupplierTable = $("#manage-supplier-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageSupplierTable.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL+filePath,
                type: "POST",
                data: {
                    "page": "manage_supplier"
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
                    'targets': [0, -1]
                }
            ],

        });
        manageSupplierTable.on('click', '.delete', function(e){
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
            handleSupplierTable();
        }
    }
}();
jQuery(document).ready(function () {
    TableDatatables.init();
});