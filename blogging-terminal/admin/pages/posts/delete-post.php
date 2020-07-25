<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/28/2018
 * Time: 1:20 PM
 */

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    include_once ("../includes/connection.php");

    $query = "DELETE FROM posts WHERE post_id = $post_id";

    mysqli_query($connection,$query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: posts.php");
    }
}