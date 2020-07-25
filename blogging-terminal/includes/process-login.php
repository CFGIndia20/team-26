<?php
include_once ("connection.php");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "";
    $query = "SELECT * FROM users WHERE username = ?";
    $ps = mysqli_prepare($connection , $query);
    mysqli_stmt_bind_param($ps,"s",$username);
    mysqli_stmt_execute($ps);
    $rs = mysqli_stmt_get_result($ps);
    $db_password = "";
    while ($row = mysqli_fetch_assoc($rs)){
        $user_id = $row['user_id'];
        $db_password = $row['password'];
        $role = $row['role'];
    }
    if(password_verify($password,$db_password)){
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        header("Location: ../admin/index.php");
    }else{
        echo "login unsuccesfull";
    }
}