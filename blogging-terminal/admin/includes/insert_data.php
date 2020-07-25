<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/27/2018
 * Time: 1:15 PM
 */

include_once ("admin_functions.php");
function convertToString($item){
    $string_item = "'".$item."'";

    return $string_item;
}
if(isset($_POST['add_category'])){
    //insert category
    $cat_title = $_POST['cat_title'];
    $cat_title = convertToString($cat_title);
    insert("categories","cat_title","{$cat_title}");
    header("Location: ../categories.php");
}