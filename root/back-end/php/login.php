<?php

require 'functions.php';

// Cek Cookie

if (isset($_COOKIE["id"])) {
    $check  = mysqli_query($host, "SELECT * FROM users WHERE id = '$_COOKIE[id]'");
    $row    = mysqli_fetch_assoc($check);
    $key    = hash("sha256", $row["username"]);
    $value  = hash("ripemd256", $key);

    if (isset($_COOKIE["$key"])) {
        $_SESSION["login"] = true;
    }
}

// Cek Session

if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

// Awal Login
if (isset($_POST['login'])) {

    if (func_login($_POST) > 0) {
        if (!$success) {
            $success = 'Login berhasil';
        }
    } else {
        if (!$failed) {
            $failed = 'Username atau password salah';
        }
    }
}
// Akhir Login

?>

<!doctype html>
<html lang="en">

<head>
    <title>Gadget NFO | Login</title>
    <link rel="icon" href="../images/logo/logo.svg">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/loginRegister01.css">
    <link rel="stylesheet" href="css/loginRegister02.css">
</head>

<body class="img da" style="background-image: url(images/bg.jpg);">
    <section class="ftco-section img" style="background-image: url(images/bg.jpg);">
        <div class="container">
            <div class="row justify-content-left">
                <div class="col-md-6 col-lg-4 text-center mb-5">
                    <h2 class="heading-section">Gadget<h2 class="heading-section" style="color: #2ccccc;">  NFO</h2></h2>
                </div>
            </div>
            <div class="row justify-content-left">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Login</h3>
                        <form method="post">

                            <div class="form-group">
                                <input type="text" name="usernameoremail" class="form-control" placeholder="Username or Email" required>
                            </div>

                            <div class="form-group">
                                <input id="password-field" class="form-control" type="password" name="password" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>

                            <div class="form-group row d-flex justify-content-between">
                                <div class="col">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" name="rememberme" value="true" disabled>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col text-right">
                                    <a href="register.php" style="color: #fff">Sign Up</a>
                                </div>
                            </div>

                            <?php if ($success) : ?>
                                <p class="success-Alert text-center"><?= $success; ?></p>
                                <?php header('refresh:2;url=../index.php') ?>
                            <?php elseif ($failed) : ?>
                                <p class="failed-Alert text-center"><?= $failed; ?></p>
                            <?php else : ?>
                            <?php endif ?>

                        </form>
                        <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
                        <div class="social d-flex text-center">
                            <a href="<?= $google_client->createAuthUrl() ?>" class="px-2 py-2 ml-md-1 rounded"><span class="bi bi-google"></span> Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>