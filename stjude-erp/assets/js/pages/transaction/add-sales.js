
$(function(){
    $("#add-sales").validate({
        rules: {
            'category_id[]': {
                required: true
            },
            'products_id[]': {
                required: true
            },
            'quantity[]': {
                required: true,
                min: 1
            },
            'discount[]': {
                required: true,
                range: [0, 100]
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
});

var id = 2;
var baseURL = window.location.origin;
var filePath = "/helper/routing.php";

function getCustomerWithEmail(){
    $("#email_verify_success").attr('style', 'display: none!important');
    $("#email_verify_fail").attr('style', 'display: none!important');
    $("#add_customer_btn").removeClass('d-inline-block');
    $("#add_customer_btn").addClass('d-none');
    var email_id = $("#customer_email").val();
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getCustomerWithEmail: true,
            email_id: email_id
        },
        dataType: 'json',
        success: function(customer) {
            if(customer.length == 0){
                $("#email_verify_fail").attr('style', 'display: inline-block!important');
                $("#add_customer_btn").removeClass('d-none');
                $("#add_customer_btn").addClass('d-inline-block');
            }else{
                $("#customer_id").attr("value", customer[0].id);
                $("#email_verify_success").attr('style', 'display: inline-block!important');
            }
        }
    })
}

function deleteProduct(delete_id) {
    var elements = document.getElementsByClassName("product_row");
    if(elements.length != 1) {
        $("#element_"+delete_id).remove();
    }
    calculateFinalTotal();
}

function addProduct(){
    $("#products_container").append(
        `<!--BEGIN: PRODUCT CUSTOM CONTROL-->
        <div class="row product_row" id="element_` + id + `">
            <!--BEGIN: CATEGORY SELECT-->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="category_id[]" id="category_` + id + `" class="form-control category_select">
                        <option disabled selected>Select Category</option>
                    </select>
                </div>
            </div>
            <!--END: CATEGORY SELECT-->
            <!--BEGIN: PRODUCTS SELECT-->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Products</label>
                    <select name="products_id[]" id="product_` + id + `" class="form-control product_select">
                        <option disabled selected>Select Product</option>
                    </select>
                </div>
            </div>
            <!--END: PRODUCTS SELECT-->
            <!--BEGIN: SELLING PRICE-->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Selling Price</label>
                    <input type="number" name="selling_price[]" id="selling_price_` + id + `" class="form-control selling_rate" readonly>
                </div>
            </div>
            <!--END: SELLING PRICE-->
            <!--BEGIN: QUANTITY-->
            <div class="col-md-1">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity[]" id="quantity_` + id + `" class="form-control quantity" value="0">
                </div>
            </div>
            <!--END: QUANTITY-->
            <!--BEGIN: DISCOUNT-->
            <div class="col-md-1">
                <div class="form-group">
                    <label for="">Discount</label>
                    <input type="number" name="discount[]" id="discount_` + id + `" class="form-control discount" value="0">
                </div>
            </div>
            <!--END: DISCOUNT-->
            <!--BEGIN: FINAL RATE-->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Final Rate</label>
                    <input type="number" name="final_rate[]" id="final_rate_` + id + `" class="form-control" value="0" readonly>
                </div>
            </div>
            <!--END: FINAL RATE-->
            <!--BEGIN: DELETE BUTTON-->
            <div class="col-md-1">
                <button onclick="deleteProduct(` + id + `)" type="button" class="btn btn-danger" style="margin-top: 40%; height: 40px">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
            <!--END: DELETE BUTTON-->
        </div>
        <!--END: PRODUCT CUSTOM CONTROL-->`
    );
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getCategories: true
        },
        dataType: 'json',
        success: function(categories) {
            categories.forEach(function (category) {
                $("#category_"+id).append(
                    `<option value='${category.id}'>${category.name}</option>`
                );
            });
            id++;
        }
    });
}
$("#products_container").on('change', '.category_select', function() { // this is jquery ka syntax, not of js
    // on('eventName', 'class_name', callback_function(){})
    var element_id = $(this).attr('id').split("_")[1];
    var category_id = this.value;
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getProductsByCategoryID: true,
            categoryID: category_id
        },
        dataType: 'json',
        success: function(products) {
            $("#product_"+element_id).empty();
            $("#product_"+element_id).append("<option disabled selected>Select Product</option>");
            products.forEach(function (product) {
                $("#product_"+element_id).append(
                    `<option value='${product.id}'>${product.name}</option>`
                );
            });
        }
    })
});
$("#products_container").on('change', '.product_select', function() { 
    var element_id = $(this).attr('id').split("_")[1];
    var product_id = this.value;
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getSellingRateByProductID: true,
            productID: product_id
        },
        dataType: 'json',
        success: function(sellingRate) {
            document.getElementById("selling_price_"+element_id).value = sellingRate[0].selling_rate;
            calculateFinalRate(element_id);
            calculateFinalTotal();
        }
    })
});

$("#products_container").on('change', '.quantity, .discount', function() { 
    var element_id = $(this).attr('id').split("_")[1];
    calculateFinalRate(element_id);
    calculateFinalTotal();
});

function calculateFinalRate(element_id) {
    var selling_rate = document.getElementById("selling_price_"+element_id).value;
    var quantity = document.getElementById("quantity_"+element_id).value;
    var discount = document.getElementById("discount_"+element_id).value;
    var discountAmount = selling_rate * (discount / 100);
    var finalRate = ((selling_rate * quantity) - discountAmount);
    document.getElementById("final_rate_"+element_id).value = finalRate;
}

function calculateFinalTotal(){
    let finalTotal = 0;
    for($i=0; $i<id-1; $i++){
        let element_id = $i+1;
        let finalRateElement = document.getElementById("final_rate_"+element_id);
        let finalRate = 0;
        if(finalRateElement != null)
            finalRate = parseInt(document.getElementById("final_rate_"+element_id).value);
        finalTotal = parseInt(finalTotal + finalRate);
    }
    document.getElementById("final_total").value = finalTotal;
}

/* Sir Wala

$("#products_container").on('change', '.product_select', function() { 
    var element_id = $(this).attr('id').split("_")[1];
    var product_id = this.value;
    $.ajax({
        url: baseURL+filePath,
        method: 'POST',
        data: {
            getSellingPriceByProductID: true,
            productID: product_id
        },
        dataType: 'json',
        success: function(selling_price) {
            $("#selling_price_"+element_id).attr("value", selling_price);
        }
    })
});

$("#products_container").on('change', '.quantity_input, .discount_input', function() { 
    var element_id = $(this).attr('id').split("_")[1];
    
    if($(this).val() == "" || parseInt($(this).val()) <= 0){
        $(this).addClass("text-field-error");
        return;
    }
    $(this).removeClass("text-field-error");

    calculatefinalPrice(element_id);
    calculateTotalAmount();
});

function calculatefinalPrice(element_id){
    selling_rate = parseInt($("#selling_price_"+element_id).val());
    quantity = parseInt($("#quantity_"+element_id).val());
    discountPerc = parseInt($("#discount_"+element_id).val());
    
    price = selling_rate * quantity;
    if(discountPerc > 0){
        discount = price * (discountPrice/100);
        price = price - discount;
    }

    $("#final_price_"+element_id).attr("value", price);
}

function calculateTotalAmount(){
    totalFinalPrice = 0;
    for(i=0; i<$(".final_pirce_input").length; i++){
        totalFinalPrice += parseInt($(".final_price_input")[i].value);
    }
    
    $("#finalTotal").attr("value", totalFinalPrice);
}
*/