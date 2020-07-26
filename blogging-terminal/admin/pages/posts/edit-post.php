<?php
include_once("../includes/connection.php");
if (isset($_POST['edit_post']) and isset($_GET['post_id'])) {
    $edit_post_id = $_GET['post_id'];
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_status = $_POST['post_status'];
    $old_image = $_POST['old_image'];
    $post_image = $_FILES['post_image']['name'];

    if ($post_image=="") {
        $post_image = $old_image;
    } else {
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/$post_image");
    }


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];


    //editing values


    $query = "UPDATE posts SET post_cat_id=?,post_title=?,post_author=?,post_image=?,post_content=?,post_tags=?,post_status=? WHERE post_id=?";

    $ps = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($ps, "dssssssd", $post_cat_id, $post_title, $post_author, $post_image, $post_content, $post_tags, $post_status, $edit_post_id);

    mysqli_stmt_execute($ps);

    mysqli_query($connection, $sql);
    if (mysqli_errno($connection)) {
        die(mysqli_error($connection));
    } else {
        header("Location: posts.php");
    }

}
//CODE TO LOAD DATA OF POST WHEN THE PAGE IS LOADED FOR FIRST TIME

if (isset($_GET['post_id'])){
$edit_post_id = $_GET['post_id'];

$query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
$post_author = $row['post_author'];
$post_title = $row['post_title'];
$post_cat_id = $row['post_cat_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_tags = $row['post_tags'];
$post_content = $row['post_content'];


?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Add posts</legend>
            <hr>

            <div class="form-group">
                <label for="post_title">Post title</label>
                <input type="text" class="form-control" name="post_title" id="post_title"
                       value="<?php echo $post_title ?>">
            </div>
            <div class="form-group">
                <label for="post_cat_id">Post category id</label>
                <?php
                include_once("../includes/functions.php");
                $categories = getAllCategories();
                $categories_count = count($categories);
                $i = 0;
                ?>
                <select name="post_cat_id" id="post_cat_id" class="form-control">

                    <?php
                    while ($i < $categories_count) {
                        $cat_id = $categories[$i]['cat_id'];
                        $cat_title = $categories[$i]['cat_title'];
                        $option_equal = "<option value='$cat_id'selected>$cat_title</option>";
                        $option_normal = "<option value='$cat_id'>$cat_title</option>";
                        if($cat_id == $post_cat_id){
                            echo $option_equal;
                        }else{
                            echo $option_normal;
                        }
                        $i++;
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_author">Post author</label>
                <input type="text" class="form-control" name="post_author" id="post_author"
                       value="<?php echo $post_author ?>">
            </div>
            <div class="form-group">
                <input type="hidden" value="<?php echo $post_image?>" name="old_image" id="old_image">
                <label for="post_image">Post image</label>
                <input type="file" class="form-control-file" name="post_image" id="post_image">
            </div>

            <div class="form-group">
                <label for="post_tags">Post tags</label>
                <input type="text" class="form-control" name="post_tags" id="post_tags"
                       value="<?php echo $post_tags ?>">
            </div>
            <div class="form-group">
                <label for="post_content">Post content</label>
                <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control"><?php echo $post_content?></textarea>
            </div>

            <div class="form-group">
                <label for="post_status">Post status</label>
                <select name="post_status" id="post_status" class="form-control">
                    <option value="draft"<?php echo $post_status=="draft"?"selected":""; ?>>Draft</option>
                    <option value="published"<?php echo $post_status=="published"?"selected":""; ?>>Published</option>
                </select>
            </div>


            <button type="submit" class="btn btn-outline-warning" name="edit_post">Edit</button>
        </form>
        <?php
            }
        }
        ?>
        <div class="mb-5"></div>
    </div>
</div>