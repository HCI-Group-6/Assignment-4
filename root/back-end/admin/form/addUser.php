<?php

include "../../php/functions.php";

if (isset($_COOKIE["rememberme"])) {
    if ($_COOKIE == "true") {
        $_SESSION['login'] = true;
    }
}

if (!isset($_SESSION["login"])) {
    header("Location: ../php/login.php");
    exit;
} else if(isset($_SESSION['login']) && getInfo('role') != 'Admin') {
    header("Location: ../../index.php");
    exit;
} 

if (isset($_POST['addUser'])) {
    if (func_register($_POST) > 0) {
        header('Location: ../users.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Edit Account</title>
    <link rel="icon" href="../images/logo/admin_logo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/master.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <!-- Awal Navbar Horizontal -->
        <?php require_once '../components/navbarHorizontal.php' ?>
        <!-- Akhir Navbar Horizontal -->
        
        <div id="body" class="active">
            
            <!-- Awal Navbar Vertical -->
            <?php require_once '../components/navbarVertical.php' ?>
            <!-- Akhir Navbar Vertical -->

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">Tambah Akun</div>
                                <div class="card-body">


                                    <form class="needs-validation" novalidate accept-charset="utf-8" method="post">
                                        <div class="row g-2">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nama Depan</label>
                                                <input type="text" class="form-control" value="" name="namadepan" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nama Belakang</label>
                                                <input type="text" class="form-control" value="" name="namabelakang" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" value="" name="email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" value="" name="notelp" required>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" value="" name="username" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="state" class="form-label">Role</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="Guest">Guest</option>
                                                    <option value="Admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Password Confirm</label>
                                                <input type="password" class="form-control" name="passwordconfirm" required>
                                            </div>
                                        </div>

                                        <a href="../users.php" class="btn btn-warning"><i class="fas fa-reply"></i> Back</a>
                                        <button type="submit" name="addUser" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Akun</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validator.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>