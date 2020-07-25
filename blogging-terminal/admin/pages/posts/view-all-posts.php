<div class="row">
    <div class="col-md-12">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add posts</a>
    </div>
</div>
<div class="mb-5"></div>



<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once ("../includes/functions.php");
                $resultset = getAllPosts();
                while($row = mysqli_fetch_assoc($resultset)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_comment_count = $row['post_comment_count'];

                    //FETCH CATEGORY TITLE FROM post_cat_id
                    $category = getAllCategories("cat_id = $post_cat_id");
                    $cat_title = $category[0]['cat_title'];
                    echo<<<POST
<tr>
<td>$post_id</td>
<td>$post_author</td>
<td>$post_title</td>
<td>$cat_title</td>
<td>$post_status</td>
<td><img src="../images/$post_image" alt="" class="img-fluid" width="100"></td>
<td>$post_tags</td>
<td>$post_comment_count</td>
<td>$post_date</td>
<td><a href="posts.php?source=edit_post&post_id=$post_id" class="btn btn-info"><span class="fa fa-edit"></span></a></td>
<td><a href="posts.php?source=delete_post&post_id=$post_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

</tr>

POST;

                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>