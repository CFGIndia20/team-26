<?php
if(isset($_GET['id'])) {
    include_once ("../includes/functions.php");
    $cat_id = $_GET['id'];
    $category = getAllCategories("cat_id=$cat_id");
    if(count($category) > 0) {
        $cat_title = $category[0]['cat_title'];

        ?>
        <form action="includes/edit_data.php" method="post" role="form">
            <legend>Edit category</legend>

            <div class="form-group">
                <label for="cat_title">Category title</label>
                <input type="hidden" class="form-control" name="cat_id" id="cat_id" value="<?php echo $cat_id;?>">
                <input type="text" class="form-control" name="cat_title" id="cat_title" value="<?php echo $cat_title;?>">
            </div>
            <button type="submit" class="btn btn-warning" name="edit_category">Edit Category</button>
        </form>
        <?php
    }
}
?>
