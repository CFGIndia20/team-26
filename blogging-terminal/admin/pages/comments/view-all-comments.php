<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Post title</th>
                    <th>Date</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once ("../includes/functions.php");
                $comment_result = getAllComments();
                while($row = mysqli_fetch_assoc($comment_result)){
                    $comment_id = $row['comment_id'];
                    $comment_author= $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];
                    $comment_post_id= $row['comment_post_id'];

                    //FETCH CATEGORY TITLE FROM post_cat_id
                    $post_result_set = getAllPosts("post_id = $comment_post_id");
                    if($post_result = mysqli_fetch_assoc($post_result_set)){
                        $post_title = $post_result['post_title'];
                        $post_id = $post_result['post_id'];
                    }else{
                        $post_title ="somethings";
                        $post_id = 0;
                    }

                    echo<<<COMMENT
<tr>
<td>$comment_id</td>
<td>$comment_author</td>
<td>$comment_content</td>
<td>$comment_email</td>
<td>$comment_status</td>
<td><a href="http://localhost/cms/post.php?post_id=$post_id">$post_title</a></td>
<td>$comment_date</td>
<td><a href="comments.php?source=approved&comment_id=$comment_id" class="btn btn-info">approve</a></td>
<td><a href="comments.php?source=disapproved&comment_id=$comment_id" class="btn btn-info">disapprove</a></td>
<td><a href="comments.php?source=delete&comment_id=$comment_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

</tr>

COMMENT;

                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>