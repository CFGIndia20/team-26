<?php
include_once ("../../includes/functions.php");
//die(isset($_POST['reset_password']));
if(isset($_POST['reset_password'])){
    $token = $_POST['token'];
    $password = $_POST['confirm_password'];
    $confirm_password = $_POST['password'];
    if($password === $confirm_password){
        $result = getAllUsers("token='$token'");
        if($row=mysqli_fetch_assoc($result)){
            $email = $row['email'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password ='$hashed_password',token=' ' WHERE email = '$email'";
            mysqli_query($connection,$query);

            header("Location: ../../index.php");
        }
    }else{
        header("Location: ../reset.php?token=$token");
    }
}