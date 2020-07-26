<?php

if(isset($_GET['comment_id'])){
    $post_id = $_GET['comment_id'];
    include_once ("../includes/connection.php");

    $query = "DELETE FROM comments WHERE comment_id = $post_id";

    mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: comments.php");
    }
}