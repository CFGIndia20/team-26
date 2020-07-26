<?php
require_once __DIR__ . "/../../helper/init.php";
$page_title = "Quick ERP | Add Sales";
$sidebarSection = 'transaction';
$sidebarSubSection = 'sales';
Util::createCSRFToken();
$errors = "";
$old = "";
if(Session::hasSession('old')) {
    $old = Session::getSession('old');
    Session::unsetSession('old');
    // Util::dd($old);
}

if(Session::hasSession('errors')) {
    $errors = unserialize(Session::getSession('errors'));
    Session::unsetSession('errors'); //Flash Sessions: matlab voh ek hi session ke liye valid hone chahiye.
    // Util::dd($errors);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once __DIR__ . "/../includes/head-section.php"; ?>
    <style>
        .email-verify {
            background: green;
            color: #FFF;
            padding: 5px 10px;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
            vertical-align: middle;
            display: none !important; 
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once __DIR__ . "../../includes/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar Navigation Bar -->
                <?php
                require_once __DIR__ . "/../includes/navbar.php";
                ?>
                <!-- End of Topbar Navigation Bar-->

                <!-- Begin Page Content-->

                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sales</h1>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Card Example -->
                                <div class="card shadow mb-4">
                                    <!-- START OF CARD HEADER -->
                                    <div class="card-header py-3 d-flex flex-row justify-content-end">
                                        <div class="mr-3">
                                            <input type="text" class="form-control" name="email" id="customer_email" placeholder="Enter Email Of Customer">
                                        </div>
                                        <div>
                                            <p class="email-verify mb-0" id="email_verify_success">
                                                <i class="fas fa-check fa-sm text-white"></i> Email Verified
                                            </p>
                                            <p class="email-verify bg-danger d-inline-block mb-0 mr-1" id="email_verify_fail">
                                                <i class="fas fa-times fa-sm text-white"></i> Email Not Verified
                                            </p>
                                            <a href="<?= BASEPAGES; ?>add-customer.php" class="btn btn-sm btn-warning shadow-sm d-none" id="add_customer_btn"><i class="fas fa-users"></i> Add Customer</a>

                                            <button type="button" onclick="getCustomerWithEmail();" class="d-sm-inline-block btn btn-primary shadow-sm" name="check_email" id="check_email">
                                                <i class="fas fa-envelope fa-sm text-white"></i> Check Email
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                    if($errors!="" && $errors->has('customer_id')):
                                        echo "<span class='error' style='display: block; padding-left: 830px; background: #f8f9fc;'> Please Verfiy Your Email ID!</span>";
                                    endif;
                                    ?>
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-plus"></i> Sales
                                        </h6>
                                        <button type="button" onclick="addProduct();" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                            <i class="fas fa-plus fa-sm text-white"></i> Add One More Product
                                        </button>
                                    </div>

                                    <!-- END OF CARD HEADER-->

                                    <!-- CARD BODY -->
                                    <form action="<?= BASEURL?>helper/routing.php" method="POST" id="add-sales">
                                        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                                       
                                        <input type="text" name="customer_id" id="customer_id">
                                        <div class="card-body">
                                            <div id="products_container">
                                                <!--BEGIN: PRODUCT CUSTOM CONTROL-->
                                                <div class="row product_row" id="element_1">
                                                    <!--BEGIN: CATEGORY SELECT-->
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Category</label>
                                                            <select name="category_id[]" id="category_1" class="form-control category_select">
                                                                <option disabled selected>Select Category</option>
                                                            
                                                                <?php
                                                                    $categories = $di->get('database')->readData("category", ['id', 'name'], "deleted=0");
                                                                    foreach ($categories as $category) {
                                                                        if($old != '' && $old['category_id'][0] == $category->id)
                                                                            echo "<option value='{$category->id}' selected>{$category->name}</option>";
                                                                        else
                                                                            echo "<option value='{$category->id}'>{$category->name}</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                            <?php
                                                            if($errors!="" && $errors->has('category_id')):
                                                                $categoryErrors = $errors->all('category_id');
                                                                for($i=0; $i<sizeof($categoryErrors); $i++):
                                                                    $errorWithId = explode("=>", $categoryErrors[$i]);
                                                                    $id = $errorWithId[0];
                                                                    $error = $errorWithId[1];
                                                                    if($id == 0):
                                                                        echo "<span class='error'> $error </span>";
                                                                        break;
                                                                    endif;
                                                                endfor;
                                                            endif;
                                                            ?>   
                                                        </div>
                                                    </div>
                                                    <!--END: CATEGORY SELECT-->
                                                    <!--BEGIN: PRODUCTS SELECT-->
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Products</label>
                                                            <select name="products_id[]" id="product_1" class="form-control product_select">
                                                                <option disabled selected>Select Product</option>
                                                                
                                                                <?php
                                                                if($old != '')
                                                                {
                                                                    $products = $di->get('database')->readData("products", ['id', 'name'], "category_id = {$old['category_id'][0]} AND deleted=0");
                                                                    
                                                                    foreach ($products as $product) 
                                                                    {
                                                                        if($old != '' && $old['products_id'][0] == $product->id)
                                                                            echo "<option value='{$product->id}' selected>{$product->name}</option>";
                                                                        else
                                                                            echo "<option value='{$product->id}'>{$product->name}</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php
                                                            if($errors!="" && $errors->has('products_id')):
                                                                $productErrors = $errors->all('products_id');
                                                                for($i=0; $i<sizeof($productErrors); $i++):
                                                                    $errorWithId = explode("=>", $productErrors[$i]);
                                                                    $id = $errorWithId[0];
                                                                    $error = $errorWithId[1];
                                                                    if($id == 0):
                                                                        echo "<span class='error'> $error </span>";
                                                                        break;
                                                                    endif;
                                                                endfor;
                                                            endif;
                                                            ?>   
                                                        </div>
                                                    </div>
                                                    <!--END: PRODUCTS SELECT-->
                                                    <!--BEGIN: SELLING PRICE-->
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Selling Price</label>
                                                            <input type="number" name="selling_price[]" id="selling_price_1" class="form-control selling_rate" value="<?= $old != '' ? $old['selling_price'][0] : '' ;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <!--END: SELLING PRICE-->
                                                    <!--BEGIN: QUANTITY-->
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="">Quantity</label>
                                                            <input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" value="<?= $old != '' ? $old['quantity'][0] : "0" ;?>">
                                                            <?php
                                                            if($errors!="" && $errors->has('quantity')):
                                                                $quantityErrors = $errors->all('quantity');
                                                                for($i=0; $i<sizeof($quantityErrors); $i++):
                                                                    $errorWithId = explode("=>", $quantityErrors[$i]);
                                                                    $id = $errorWithId[0];
                                                                    $error = $errorWithId[1];
                                                                    if($id == 0):
                                                                        echo "<span class='error'> $error </span>";
                                                                        break;
                                                                    endif;
                                                                endfor;
                                                            endif;
                                                            ?>   
                                                        </div>
                                                    </div>
                                                    <!--END: QUANTITY-->
                                                    <!--BEGIN: DISCOUNT-->
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="">Discount</label>
                                                            <input type="number" name="discount[]" id="discount_1" class="form-control discount" value="<?= $old != '' ? $old['discount'][0] : "0" ;?>">
                                                            <?php
                                                            if($errors!="" && $errors->has('discount')):
                                                                $discountErrors = $errors->all('discount');
                                                                for($i=0; $i<sizeof($discountErrors); $i++):
                                                                    $errorWithId = explode("=>", $discountErrors[$i]);
                                                                    $id = $errorWithId[0];
                                                                    $error = $errorWithId[1];
                                                                    if($id == 0):
                                                                        echo "<span class='error'> $error </span>";
                                                                        break;
                                                                    endif;
                                                                endfor;
                                                            endif;
                                                            ?>   
                                                        </div>
                                                    </div>
                                                    <!--END: DISCOUNT-->
                                                    <!--BEGIN: FINAL RATE-->
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Final Rate</label>
                                                            <input type="number" name="final_rate[]" id="final_rate_1" class="form-control" value="<?= $old != '' ? $old['final_rate'][0] : "0" ;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <!--END: FINAL RATE-->
                                                    <!--BEGIN: DELETE BUTTON-->
                                                    <div class="col-md-1">
                                                        <button onclick="deleteProduct(1)" type="button" class="btn btn-danger" style="margin-top: 40%; height: 40px">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                    <!--END: DELETE BUTTON-->
                                                </div>
                                                <!--END: PRODUCT CUSTOM CONTROL-->
                                                <?php
                                                if($old != '')
                                                {
                                                    for($i=1; $i<sizeof($old['category_id']); $i++):
                                                        $j = $i+1;
                                                ?>
                                                        <!--BEGIN: PRODUCT CUSTOM CONTROL-->
                                                        <div class="row product_row" id="element_<?= $j; ?>">
                                                        <!--BEGIN: CATEGORY SELECT-->
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Category</label>
                                                                <select name="category_id[]" id="category_<?= $j; ?>" class="form-control category_select">
                                                                    <option disabled selected>Select Category</option>

                                                                    <?php
                                                                    $categories = $di->get('database')->readData("category", ['id', 'name'], "deleted=0");
                                                                    foreach ($categories as $category) {
                                                                        if($old != '' && $old['category_id'][$i] == $category->id)
                                                                            echo "<option value='{$category->id}' selected>{$category->name}</option>";
                                                                        else
                                                                            echo "<option value='{$category->id}'>{$category->name}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <?php
                                                                if($errors!="" && $errors->has('category_id')):
                                                                    $categoryErrors = $errors->all('category_id');
                                                                    for($k=0; $k<sizeof($categoryErrors); $k++):
                                                                        $errorWithId = explode("=>", $categoryErrors[$k]);
                                                                        $id = $errorWithId[0];
                                                                        $error = $errorWithId[1];
                                                                        if($id == $i):
                                                                            echo "<span class='error'> $error </span>";
                                                                            break;
                                                                        endif;
                                                                    endfor;
                                                                endif;
                                                                ?>   
                                                            </div>
                                                        </div>
                                                        <!--END: CATEGORY SELECT-->
                                                        <!--BEGIN: PRODUCTS SELECT-->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Products</label>
                                                                <select name="products_id[]" id="product_<?= $j; ?>" class="form-control product_select">
                                                                    <option disabled selected>Select Product</option>
                                                                    
                                                                    <?php
                                                                    if($old != '')
                                                                    {
                                                                        $products = $di->get('database')->readData("products", ['id', 'name'], "category_id = {$old['category_id'][$i]} AND deleted=0");
                                                                        
                                                                        echo "<option disabled>Select Product</option>";
                                                                        foreach ($products as $product) 
                                                                        {
                                                                            if($old != '' && $old['products_id'][$i] == $product->id)
                                                                                echo "<option value='{$product->id}' selected>{$product->name}</option>";
                                                                            else
                                                                                echo "<option value='{$product->id}'>{$product->name}</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <?php
                                                                if($errors!="" && $errors->has('products_id')):
                                                                    $productErrors = $errors->all('products_id');
                                                                    for($k=0; $k<sizeof($productErrors); $k++):
                                                                        $errorWithId = explode("=>", $productErrors[$k]);
                                                                        $id = $errorWithId[0];
                                                                        $error = $errorWithId[1];
                                                                        if($id == $i):
                                                                            echo "<span class='error'> $error </span>";
                                                                            break;
                                                                        endif;
                                                                    endfor;
                                                                endif;
                                                                ?>   
                                                            </div>
                                                        </div>
                                                        <!--END: PRODUCTS SELECT-->
                                                        <!--BEGIN: SELLING PRICE-->
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Selling Price</label>
                                                                <input type="number" name="selling_price[]" id="selling_price_<?= $j; ?>" class="form-control selling_rate" value="<?= $old != '' ? $old['selling_price'][$i] : '' ;?>" readonly>
                                                            </div>
                                                        </div>
                                                        <!--END: SELLING PRICE-->
                                                        <!--BEGIN: QUANTITY-->
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="">Quantity</label>
                                                                <input type="number" name="quantity[]" id="quantity_<?= $j; ?>" class="form-control quantity" value="<?= $old != '' ? $old['quantity'][$i] : "0" ;?>">
                                                                <?php
                                                                if($errors!="" && $errors->has('quantity')):
                                                                    $quantityErrors = $errors->all('quantity');
                                                                    for($k=0; $k<sizeof($quantityErrors); $k++):
                                                                        $errorWithId = explode("=>", $quantityErrors[$k]);
                                                                        $id = $errorWithId[0];
                                                                        $error = $errorWithId[1];
                                                                        if($id == $i):
                                                                            echo "<span class='error'> $error </span>";
                                                                            break;
                                                                        endif;
                                                                    endfor;
                                                                endif;
                                                                ?>   
                                                            </div>
                                                        </div>
                                                        <!--END: QUANTITY-->
                                                        <!--BEGIN: DISCOUNT-->
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="">Discount</label>
                                                                <input type="number" name="discount[]" id="discount_<?= $j; ?>" class="form-control discount" value="<?= $old != '' ? $old['discount'][$i] : "0" ;?>">
                                                                <?php
                                                                if($errors!="" && $errors->has('discount')):
                                                                    $discountErrors = $errors->all('discount');
                                                                    for($k=0; $k<sizeof($discountErrors); $k++):
                                                                        $errorWithId = explode("=>", $discountErrors[$k]);
                                                                        $id = $errorWithId[0];
                                                                        $error = $errorWithId[1];
                                                                        if($id == $i):
                                                                            echo "<span class='error'> $error </span>";
                                                                            break;
                                                                        endif;
                                                                    endfor;
                                                                endif;
                                                                ?>   
                                                            </div>
                                                        </div>
                                                        <!--END: DISCOUNT-->
                                                        <!--BEGIN: FINAL RATE-->
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Final Rate</label>
                                                                <input type="number" name="final_rate[]" id="final_rate_<?= $j; ?>" class="form-control" value="<?= $old != '' ? $old['final_rate'][$i] : "0" ;?>" readonly>
                                                            </div>
                                                        </div>
                                                        <!--END: FINAL RATE-->
                                                        <!--BEGIN: DELETE BUTTON-->
                                                        <div class="col-md-1">
                                                            <button onclick="deleteProduct($j)" type="button" class="btn btn-danger" style="margin-top: 40%; height: 40px">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                        <!--END: DELETE BUTTON-->
                                                    </div>
                                                    <!--END: PRODUCT CUSTOM CONTROL-->      
                                                    <?php
                                                        endfor;
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <!-- END OF CARD BODY -->
                                        <!--BEGIN: CARD FOOTER-->
                                        <div class="card-footer d-flex justify-content-between">
                                            <div>
                                                <input type="submit" class="btn btn-primary" name="add_sales" value="Submit">
                                            </div>
                                            <div class="form-group row">
                                                <label for="finalTotal" class="col-sm-4 col-form-label">Final Total</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="final_total" id="final_total" value="<?= $old != '' ? $old['final_total'] : "0" ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--END: CARD FOOTER-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            
            <!-- Footer -->
            <?php require_once __DIR__ . "/../includes/footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->

    <?php require_once __DIR__ . "/../includes/scroll-to-top.php"; ?>
    <?php require_once __DIR__ . "/../includes/core-scripts.php"; ?>

    <script src="<?=BASEASSETS?>js/plugins/jquery-validation/jquery-validate.min.js"></script>
    <script src="<?=BASEASSETS?>js/pages/transaction/add-sales.js"></script>
    <?php require_once __DIR__ . "/../includes/page-level/sales/manage-sales-scripts.php"; ?>
</body>

</html>
