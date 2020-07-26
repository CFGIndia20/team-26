<?php
  include_once ("../includes/functions.php");

  if(!isset($_GET['token'])){
      header("Location: ../index.php");
  }else{
      $token = $_GET['token'];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>St. Jude - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>
<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">RESET PASSWORD</div>
        <div class="card-body">
            <form action="includes/process-reset.php" method="post">

                <input type="hidden" name="token" value="<?php echo "{$token}";?>">
                <input type="hidden" name="email" value="<?php echo "{$email}";?>">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="required">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit" id="reset_password" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
