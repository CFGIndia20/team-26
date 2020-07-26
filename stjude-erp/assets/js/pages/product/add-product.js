$(function(){
    $("#add-product").validate({
        rules: {
            'name': {
                required: true,
                minlength: 2
            },
            'specification': {
                required: true,
                minlength: 2
            },
            'hsn_code': {
                required: true
            },
            'supplier_id[]': {
                required: true
            },
            'category_id': {
                required: true
            },
            'selling_rate': {
                required: true,
                min: 1
            },
            'eoq_level': {
                required: true,
                min: 0
            },
            'danger_level': {
                required: true,
                min: 0
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
});