<?php
require_once __DIR__ . "/../../helper/init.php";
$page_title = "Quick ERP | Add Supplier";
$sidebarSection = 'supplier';
$sidebarSubSection = 'add-supplier';
Util::createCSRFToken();
$errors = "";
$old = "";
if(Session::hasSession('old'))
{
    $old = Session::getSession('old');
    Session::unsetSession('old');
}

if(Session::hasSession('errors'))
{
    $errors = unserialize(Session::getSession('errors'));
    Session::unsetSession('errors'); //Flash Sessions: matlab voh ek hi session ke liye valid hone chahiye.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once __DIR__ . "/../includes/head-section.php"; ?>

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
                        <h1 class="h3 mb-0 text-gray-800">Add Supplier</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-list-ul fa-sm text-white"></i>Manage Supplier</a>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- CARD HEADER -->
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fa fa-plus"></i>Add Supplier
                                        </h6>
                                    </div>
                                    <!-- END OF CARD HEADER -->

                                    <!-- CARD BODY -->
                                    <div class="card-body">
                                        <form id="add-supplier"  action="<?= BASEURL?>helper/routing.php" method="POST">
                                            <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Personal Information</h5>
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('first_name') ? 'error is-invalid' : '') : '';?>" 
                                                        name="first_name" 
                                                        id="first_name" 
                                                        placeholder="Enter First Name" 
                                                        value="<?= $old != '' ? $old['first_name'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('first_name')):
                                                        echo "<span class='error'> {$errors->first('first_name')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('last_name') ? 'error is-invalid' : '') : '';?>" 
                                                        name="last_name" 
                                                        id="last_name" 
                                                        placeholder="Enter Last Name" 
                                                        value="<?= $old != '' ? $old['last_name'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('last_name')):
                                                        echo "<span class='error'> {$errors->first('last_name')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone_no">Phone Number</label>
                                                        <input type="tel" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('phone_no') ? 'error is-invalid' : '') : '';?>" 
                                                        name="phone_no" 
                                                        id="phone_no" 
                                                        placeholder="Enter Phone Number" 
                                                        value="<?= $old != '' ? $old['phone_no'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('phone_no')):
                                                        echo "<span class='error'> {$errors->first('phone_no')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email_id">Email ID</label>
                                                        <input type="email" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('email_id') ? 'error is-invalid' : '') : '';?>" 
                                                        name="email_id" 
                                                        id="email_id" 
                                                        placeholder="Enter Email ID" 
                                                        value="<?= $old != '' ? $old['email_id'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('email_id')):
                                                        echo "<span class='error'> {$errors->first('email_id')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="col-md-12">
                                                    <hr>
                                                    <h5>Address Information</h5>
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="block_no">Block Number</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('block_no') ? 'error is-invalid' : '') : '';?>" 
                                                        name="block_no" 
                                                        id="block_no" 
                                                        placeholder="Enter Block Number" 
                                                        value="<?= $old != '' ? $old['block_no'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('block_no')):
                                                        echo "<span class='error'> {$errors->first('block_no')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="street">Street</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('street') ? 'error is-invalid' : '') : '';?>" 
                                                        name="street" 
                                                        id="street" 
                                                        placeholder="Enter Street" 
                                                        value="<?= $old != '' ? $old['street'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('street')):
                                                        echo "<span class='error'> {$errors->first('street')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('city') ? 'error is-invalid' : '') : '';?>" 
                                                        name="city" 
                                                        id="city" 
                                                        placeholder="Enter City" 
                                                        value="<?= $old != '' ? $old['city'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('city')):
                                                        echo "<span class='error'> {$errors->first('city')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pincode">Pincode</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('pincode') ? 'error is-invalid' : '') : '';?>" 
                                                        name="pincode" 
                                                        id="pincode" 
                                                        placeholder="Enter Pincode" 
                                                        value="<?= $old != '' ? $old['pincode'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('pincode')):
                                                        echo "<span class='error'> {$errors->first('pincode')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('state') ? 'error is-invalid' : '') : '';?>" 
                                                        name="state" 
                                                        id="state" 
                                                        placeholder="Enter State" 
                                                        value="<?= $old != '' ? $old['state'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('state')):
                                                        echo "<span class='error'> {$errors->first('state')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('country') ? 'error is-invalid' : '') : '';?>" 
                                                        name="country" 
                                                        id="country" 
                                                        placeholder="Enter Country" 
                                                        value="<?= $old != '' ? $old['country'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('country')):
                                                        echo "<span class='error'> {$errors->first('country')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="town">Town</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('town') ? 'error is-invalid' : '') : '';?>" 
                                                        name="town" 
                                                        id="town" 
                                                        placeholder="Enter Town" 
                                                        value="<?= $old != '' ? $old['town'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('town')):
                                                        echo "<span class='error'> {$errors->first('town')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>

                                            </div>
                                            <input type="submit" class="btn btn-primary" name="add_supplier" value="Submit">
                                        </form>
                                    </div>
                                    <!-- END OF CARD BODY -->
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
    <script src="<?=BASEASSETS?>js/pages/supplier/add-supplier.js"></script>
    <?php require_once __DIR__ . "/../includes/page-level/supplier/manage-supplier-scripts.php"; ?>
</body>

</html>
