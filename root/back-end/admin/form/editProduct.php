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

if (!isset($_GET['product_id'])) {
    header("Location: ../products.php");
    exit;
} 

if (isset($_POST['editProduct'])) {
    // var_dump($_FILES['gambar_product']); die;
    if (editProduct($_POST) == 1) {
        header('Location: ../products.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Edit Product</title>
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
                                <div class="card-header">Edit Product Info</div>
                                <div class="card-body">

                                    <?php

                                    $id                 = $_GET['product_id'];
                                    $productIDlistQuery = mysqli_query($host, "SELECT * FROM productlist WHERE id = '$id'");

                                    $data = mysqli_fetch_array($productIDlistQuery);

                                    ?>


                                    <form class="needs-validation" novalidate accept-charset="utf-8" method="post" enctype="multipart/form-data">
                                        <div class="row g-2">
                                            <div class="mb-3 col-md-2 form-group">
                                                <fieldset disabled>
                                                    <label for="disabledTextInput" class="form-label">Product ID</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $data['id'] ?>">
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-10">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" value="<?= $data['nama_product'] ?>" name="nama_product" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Produk</label>
                                            <textarea name="deskripsi_product" class="form-control" rows="3" required><?= $data['deskripsi_product'] ?></textarea>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Harga Produk</label>
                                                <input type="number" class="form-control" value="<?= $data['harga_product'] ?>" name="harga_product" required>
                                            </div>

                                            <div class="mb-3 col-md-8">
                                                <fieldset disabled>
                                                    <label class="form-label">Path Gambar</label>
                                                    <input type="text" class="form-control" value="<?= $data['gambar_product'] ?>" name="nama_product" required>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-2">
                                                <label class="form-label">Gambar Saat Ini</label> <br>
                                                <img class="productImage2" src="../../<?= $data['gambar_product'] ?>">
                                            </div>

                                            <div class="mb-3 col-md-10">
                                                <label class="form-label">Upload Gambar Baru (max file size: 5 MB)</label>
                                                <input type="file" class="form-control" name="gambar_product">
                                            </div>
                                        </div>

                                        <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                        <a href="../products.php" class="btn btn-warning"><i class="fas fa-reply"></i> Back</a>
                                        <button type="submit" name="editProduct" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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