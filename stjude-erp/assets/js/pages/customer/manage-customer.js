var TableDatatables = function(){
    var handleCustomerTable = function(){
        var manageCustomerTable = $("#manage-customer-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageCustomerTable.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL+filePath,
                type: "POST",
                data: {
                    "page": "manage_customer"
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
        manageCustomerTable.on('click', '.delete', function(e){
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
            handleCustomerTable();
        }
    }
}();
jQuery(document).ready(function () {
    TableDatatables.init();
});