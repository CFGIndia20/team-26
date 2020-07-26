<?php
$page_title = "categories";
?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once ("includes/header.php");
?>
  <body id="page-top" class="sidebar-toggled">

      <!-- Navbar -->
        <?php
        include_once ("includes/navigation.php");
        ?>

    <div id="wrapper">

      <!-- Sidebar -->
        <?php
        include_once ("includes/sidebar.php");
        ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">CMS Dashboard</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $page_title;?></li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">

              <div class="col-md-6">
<!--                  add form-->
                  <?php
                  include_once ("pages/categories/add-category-form.php");
                  ?>
<!--                  end of add form-->
              </div>
              <div class="col-md-6">
<!--                  edit-->
                  <?php
                  include_once ("pages/categories/edit-category-form.php");
                  ?>
<!--                  end of edit form-->
              </div>


          </div>
<!--            table-->
            <?php
            include_once("pages/categories/view_all_categories.php");
            ?>
<!--end of table-->

        </div>
        <!-- /.container-fluid -->

          <?php
          include_once ("includes/footer.php");
          ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

        <?php
            include_once ("includes/scripts_btn_to_top.php");
        ?>


  </body>

</html>
