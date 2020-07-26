<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/28/2018
 * Time: 1:20 PM
 */

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    include_once ("../includes/connection.php");

    $query = "DELETE FROM users WHERE user_id = $user_id";

    mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: users.php");
    }
}