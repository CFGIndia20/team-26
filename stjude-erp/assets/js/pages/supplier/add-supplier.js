$(function(){
    $("#add-supplier").validate({
        rules: {
            'first_name': {
                required: true,
                minlength: 2
            },
            'last_name': {
                required: true,
                minlength: 2
            },
            'gst_no': {
                required: true,
                minlength: 15, 
                maxlength: 15
            },
            'phone_no': {
                required: true
            },
            'email_id': {
                required: true,
                email: true
            },
            'comapany_name': {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            'block_no': {
                required: true,
                minlength: 1, 
                maxlength: 30
            },
            'street': {
                required: true,
                minlength: 2, 
                maxlength: 25
            },
            'city': {
                required: true,
                minlength: 2, 
                maxlength: 25
            },
            'pincode': {
                required: true,
                minlength: 2, 
                maxlength: 6
            },
            'state': {
                required: true,
                minlength: 2, 
                maxlength: 25
            },
            'country': {
                required: true,
                minlength: 2, 
                maxlength: 25
            },
            'town': {
                required: true,
                minlength: 2, 
                maxlength: 25
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
});