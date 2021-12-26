<?php

include "../php/functions.php";

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

if (isset($_POST['addProduct'])) {
    if (addProduct($_POST) == 1) {
        header('Location: ../products.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Add Products</title>
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
                                <div class="card-header">Tambah Produk</div>
                                <div class="card-body">


                                    <form class="needs-validation" novalidate accept-charset="utf-8" method="post" enctype="multipart/form-data">

                                        <div class="mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" value="" name="nama_product" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Produk</label>
                                            <textarea name="deskripsi_product" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Harga Produk</label>
                                                <input type="number" class="form-control" value="" name="harga_product" required>
                                            </div>

                                            <div class="mb-3 col-md-8">
                                                <label class="form-label">Upload Gambar (max file size: 5 MB)</label>
                                                <input type="file" class="form-control" name="gambar_product" required>
                                            </div>
                                        </div>

                                        <a href="../products.php" class="btn btn-warning"><i class="fas fa-reply"></i> Back</a>
                                        <button type="submit" name="addProduct" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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