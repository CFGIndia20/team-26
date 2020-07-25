<?php
include_once ("config.php");
$connection = mysqli_connect(HOST,USER, PASSWORD,DB_NAME);
if($connection){
//   echo "Connection Successful";
}else{
    die(mysqli_connect_error($connection));
}
?>



