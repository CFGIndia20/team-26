<?php
if(isset($_POST['add_user'])){
    $username = $_POST['username'];

    $password = $_POST['password'];
    $password = password_hash($password,PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_image= $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];



    $email = $_POST['email'];
    $role = $_POST['role'];

    move_uploaded_file($user_image_temp,"images/users/$user_image");

    //inserting values

    include_once ("../includes/connection.php");
    $query = "INSERT INTO users (username,password,first_name,last_name,email,image,role) VALUES (?,?,?,?,?,?,?)";

    $ps = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($ps,"sssssss",$username,$password,$first_name,$last_name,$email,$user_image,$role);

    mysqli_stmt_execute($ps);

    mysqli_query($connection,$sql);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: users.php");
    }

}
?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Add user</legend>
            <hr>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="user_image">User image</label>
                <input type="file" class="form-control-file" name="user_image" id="user_image">
            </div>

            <div class="form-group">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">last name</label>
                <input type="text" class="form-control" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="subscriber">subscriber</option>
                    <option value="admin">admin</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary" name="add_user">add user</button>
        </form>
        <div class="mb-5"></div>
    </div>
</div>