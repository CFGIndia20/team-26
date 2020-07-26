<div class="row">
    <div class="col-md-12">
        <a href="users.php?source=add_user" class="btn btn-primary">Add Users</a>
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
                    <th>Image</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>email</th>
                    <th>Role</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once ("../includes/functions.php");
                $resultset = getAllusers();
                while($row = mysqli_fetch_assoc($resultset)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $password= $row['password'];
                    $first_name= $row['first_name'];
                    $last_name = $row['last_name'];
                    $email = $row['email'];
                    $image = $row['image'];
                    $role = $row['role'];

                    echo<<<POST
<tr>
<td>$user_id</td>
<td> <img src="images/users/$image" alt="" class="img-fluid rounded-circle" width="100"></td>
<td>$username</td>
<td>$password</td>
<td>$first_name</td>
<td>$last_name</td>
<td>$email</td>
<td>$role</td>
<td><a href="user.php?source=edit_post&post_id=post_id" class="btn btn-info"><span class="fa fa-edit"></span></a></td>
<td><a href="users.php?source=delete_user&user_id=$user_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

</tr>

POST;

                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>