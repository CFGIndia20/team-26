$(function(){
    $("#add-category").validate({
        rules: {
            'name': {
                required: true
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
});