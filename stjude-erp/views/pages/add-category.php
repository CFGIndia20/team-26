<?php
require_once __DIR__ . "/../../helper/init.php";
$page_title = "Quick ERP | Add Category";
$sidebarSection = 'category';
$sidebarSubSection = 'add-category';
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
                        <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-list-ul fa-sm text-white"></i>Manage Category</a>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- CARD HEADER -->
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fa fa-plus"></i>Add Category
                                        </h6>
                                    </div>
                                    <!-- END OF CARD HEADER -->

                                    <!-- CARD BODY -->
                                    <div class="card-body">
                                        <form id="add-category"  action="<?= BASEURL?>helper/routing.php" method="POST">
                                            <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token');?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <input type="text" 
                                                        class="form-control <?= $errors!='' ? ($errors->has('name') ? 'error is-invalid' : '') : '';?>" 
                                                        name="name" 
                                                        id="name" 
                                                        placeholder="Enter Category Name" 
                                                        value="<?= $old != '' ? $old['name'] : '';?>"
                                                    >
                                                    <?php
                                                    if($errors!="" && $errors->has('name')):
                                                        echo "<span class='error'> {$errors->first('name')}</span>";
                                                    endif;
                                                    ?>    
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="add_category" value="Submit">
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
    <script src="<?=BASEASSETS?>js/pages/category/add-category.js"></script>
</body>

</html>
