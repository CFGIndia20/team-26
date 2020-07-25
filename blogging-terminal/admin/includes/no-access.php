<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login required</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>Forgot to login?</h4>
                <p>Enter your username and password</p>
            </div>
            <form action="../includes/process-login.php" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="username" id="username" class="form-control" required="required" autofocus="autofocus" name="username">
                        <label for="username">Enter Username</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="password" class="form-control" required="required" autofocus="autofocus" name="password">
                        <label for="password">Enter password</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="register.html">Register an Account</a>
                <a class="d-block small" href="../index.php">Home Page</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
