<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/27/2018
 * Time: 3:08 PM
 */

include_once ("admin_functions.php");
if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    delete("categories","cat_id = $cat_id");
    header("Location: ../categories.php");
}