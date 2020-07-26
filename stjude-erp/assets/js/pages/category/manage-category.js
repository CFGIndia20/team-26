var TableDatatables = function(){
    var handleCategoryTable = function(){
        var manageCategoryTable = $("#manage-category-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageCategoryTable.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL+filePath,
                type: "POST",
                data: {
                    "page": "manage_category"
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
        manageCategoryTable.on('click', '.edit', function(e){
            var id = $(this).data('id');
            $("#edit_category_id").val(id);
            //Fetching all other values from the database using AJAX and loading them onto their respective fields in the modal.
            $.ajax({
                url: baseURL + filePath,
                method: "POST",
                data: {
                    "category_id": id,
                    "fetch": "category"
                },
                dataType: "json",
                success: function(data){
                    $("#edit_category_name").val(data.name);
                }
            })
        });

        manageCategoryTable.on('click', '.delete', function(e){
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
            handleCategoryTable();
        }
    }
}();
jQuery(document).ready(function () {
    TableDatatables.init();
});