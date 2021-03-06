<?php

require 'functions.php';

// Cek Session
if (isset($_SESSION["login"]) && isset($_COOKIE['id'])) {
    header("Location: ../index.php");
    exit;
} elseif (isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

// Awal Register
if (isset($_POST['register'])) {

    if (func_register($_POST) > 0) {
        if (!$success) {
            $success = 'Register berhasil';
        }
    } else {
        if (!$failed) {
            $failed = 'Register tidak berhasil';
        }
    }
}
// Akhir Register

?>

<!doctype html>
<html lang="en">

<head>
    <title>Gadget NFO | Register</title>
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
                <div class="col-md-7 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Register</h3>
                        <form method="post">

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <input type="text" name="namadepan" class="form-control" placeholder="Nama depan" required>
                                </div>


                                <div class="col-md-6 form-group">
                                    <input type="text" name="namabelakang" class="form-control" placeholder="Nama belakang" required>
                                </div>

                            </div>

                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="notelp" class="form-control" placeholder="Nomor telepon" required>
                            </div>

                            <div class="form-group">
                                <input id="password-field1" type="password" class="form-control" name="password" placeholder="Password" required>
                                <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <input id="password-field2" type="password" name="passwordconfirm" class="form-control" name="passwordconfirm" placeholder="Confirm password" required>
                                <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="register" class="form-control btn btn-primary submit px-3">Sign Up</button>
                            </div>

                            <div class="form-group text-right">
                                <a href="login.php" style="color: #fff">Sign In</a>
                            </div>

                            <?php if ($success) : ?>
                                <p class="success-Alert"><?= $success; ?></p>
                                <?php header('refresh:2;url=login.php') ?>
                            <?php elseif ($failed) : ?>
                                <p class="failed-Alert"><?= $failed; ?></p>
                            <?php else : ?>
                            <?php endif ?>

                        </form>
                        <p class="w-100 text-center">&mdash; Or Sign Up With &mdash;</p>
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