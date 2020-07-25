
<div class="col-md-4">

    <!-- login Widget -->
    <?php

    if(!isLoggedIn()){
        echo<<<SIDEBAR
 <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form action="includes/process-login.php" method="post">
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name = "username" id="username">
                </div>
                <div class="form-group ">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name = "password" id="username">
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="login">
                <a href="admin/forgot-password.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>

            </form>
        </div>
    </div>

SIDEBAR;

    }
    ?>

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form action="index.php" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for...">
                    <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit" >Go!</button>
                </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <?php
                include_once("functions.php");
                $categories = getAllCategories();
                $categories_count = count($categories);
                ?>

                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                    <?php
                    for ($i = 0; $i<ceil($categories_count / 2); $i++) {
                        echo <<<LINK
<li>
 <a href="index.php?cat_id={$categories[$i]['cat_id']}">{$categories[$i]['cat_title']}</a>
 </li>
LINK;
                    }
                    ?>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
<?php
for ($i = ceil($categories_count / 2); $i<$categories_count; $i++) {
    echo <<<LINK
<li>
 <a href="index.php?cat_id={$categories[$i]['cat_id']}">{$categories[$i]['cat_title']}</a>
 </li>
LINK;
    }
?>
                    </ul>
    <div >
            </div >
        </div >
    </div >
        </div>
    </div>
    <!--Side Widget-->
    <div class="card my-4" >
        <h5 class="card-header" > About</h5 >
        <div class="card-body" >
            We provide every child suffering from cancer, irrespective of economic status, a chance of surviving the disease and leading a full, healthy, happy life. Your support can help us bridge the gap between what the hospitals provide and what every child needs to get, a fighting chance to beat cancer.
        </div >
    </div >
</div>
</div >

