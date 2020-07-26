<?php
require_once __DIR__ . "/../../helper/init.php";
$page_title = "Quick ERP | Invoice";
$sidebarSection = 'invoice';
$sidebarSubSection = 'manage-invoice';
Util::createCSRFToken();
$errors = "";
$old = "";
if(isset($_GET['id']))
{
    $invoice_id = $_GET['id'];
    $result = $di->get('invoice')->getInvoiceDetailsByInvoiceID($invoice_id);
    Util::dd($result);
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Invoices</h1>

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

</body>

</html>