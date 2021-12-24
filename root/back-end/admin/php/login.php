<?php 

include 'functions.php';

// Cek Session

if (isset($_SESSION["login"]) && getInfo('role') == 'Admin') {
    header("Location: ../index.php");
    exit;
} else if (isset($_SESSION["login"]) && getInfo('role') != 'Admin') {
    header("Location: ../../index.php");
    exit;
}

// Awal Login
if (isset($_POST['loginAdmin'])) {

    if (func_loginAdmin($_POST) > 0) {
        if (!$success) {
            $success = 'Login berhasil';
        }
    } else {
        if (!$failed) {
            $failed = 'Username atau password salah';
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Login</title>
    <link rel="icon" href="../images/logo/admin_logo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/auth.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img src="../../images/logo/logo.svg" alt="bootraper logo" width="40px">
                        <div class="loginLogo text-center"><h4 class="loginLogo1">Gadget<h4 class="loginLogo2">&nbsp;NFO</h4></h4></div>
                    </div>
                    <h6 class="mb-4 text-muted">Admin Login</h6>

                    <form method="post">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Username or Email</label>
                            <input type="text" name="usernameoremail" class="form-control" placeholder="Enter Username or Email" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="mb-3 text-start">
                            <div class="form-check">
                                <fieldset disabled="disabled">
                                    <input class="form-check-input" name="rememberme" type="checkbox" value="" id="check1">
                                    <label class="form-check-label" for="check1">
                                        Remember me
                                    </label>
                                </fieldset>
                            </div>
                        </div>

                        <?php if ($success) : ?>
                            <p class="success-Alert"><?= $success; ?></p>
                            <?php header('refresh:2;url=../index.php') ?>
                        <?php elseif ($failed) : ?>
                            <p class="failed-Alert"><?= $failed; ?></p>
                        <?php else : ?>
                        <?php endif ?>

                        <button name="loginAdmin" class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>