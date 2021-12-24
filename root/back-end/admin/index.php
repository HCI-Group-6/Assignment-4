<?php

include 'php/functions.php';

if (isset($_COOKIE["rememberme"])) {
    if ($_COOKIE == "true") {
        $_SESSION['login'] = true;
    }
}

if (!isset($_SESSION["login"])) {
    header("Location: php/login.php");
    exit;
} else if (isset($_SESSION['login']) && getInfo('role') != 'Admin') {
    header("Location: ../index.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <link rel="icon" href="images/logo/admin_logo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <!-- Awal Navbar Horizontal-->
        <?php require_once 'components/navbarHorizontalRoot.php' ?>
        <!-- Akhir Navbar Horizontal-->

        <div id="body" class="active">


            <!-- Awal Navbar Vertical -->
            <?php require 'components/navbarVerticalRoot.php'; ?>
            <!-- Akhir Navbar Vertical -->


            <!-- AWAL SECTION ORDER LIST -------------------------------------------------------------------- -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Order List</h3>
                    </div>

                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="">ID</th>
                                        <th class="col-md-2">Nama Pembeli</th>
                                        <th class="col-md-3">Alamat</th>
                                        <th class="col-md-2">No. HP</th>
                                        <th class="col-md-3">List Order</th>
                                        <th class="col-md-2">Total</th>
                                        <th class="col-md-1">Status</th>
                                    </tr>
                                </thead>

                                <!-- AWAL BODY TABEL -->
                                <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($orderlistQuery)) {
                                        $totalHarga     = number_format($data['total'], 0, '', '.');
                                        $alamatLengkap  = $data['alamat'] . ", " . $data['provinsi'];
                                        $buktiBayar     = "../" . $data['buktipembayaran'];
                                        $jumlahOrder    = count(explode_all($data['order_list']));
                                    ?>

                                        <tr>
                                            <td><?= $data['id'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $alamatLengkap ?></td>
                                            <td><?= $data['nomortelepon'] ?></td>
                                            <td>
                                                <?php
                                                for ($i = 0; $i < $jumlahOrder; $i++) {
                                                    $listOrder      = explode_all($data['order_list']);
                                                    $idKopi         = $listOrder[$i][0];
                                                    $quantity       = $listOrder[$i][1];
                                                    $queryIDKopi    = mysqli_query($host, "SELECT * FROM productlist WHERE id = '$idKopi'");
                                                    $listKopi       = mysqli_fetch_assoc($queryIDKopi);
                                                    $nama_product       = $listKopi['nama_product'];
                                                ?>
                                                    <span><?= $nama_product ?> x <?= $quantity ?></span><br>
                                                <?php } ?>
                                            </td>
                                            <td>Rp<?= $totalHarga ?></td>
                                            <td><?= $data['orderstatus'] ?></td>
                                        </tr>
                                    <?php
                                    } ?>
                                    <!-- AWAL BODY TABEL -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR SECTION ORDER LIST -------------------------------------------------------------------- -->

            <!-- AWAL SECTION USER LIST------------------------------------------------------------------------ -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>User List</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Nomor Telepon</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>

                                <!-- AWAL BODY TABEL -->
                                <tbody>

                                    <?php

                                    while ($data = mysqli_fetch_array($userlistQuery)) {
                                        $nama = $data['nama_depan'] . " " . $data['nama_belakang'];
                                    ?>

                                        <tr>
                                            <td><?= $data['id'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td><?= $nama ?></td>
                                            <td><?= $data['nomor_telepon'] ?></td>
                                            <td><?= $data['email'] ?></td>
                                            <td><?= $data['user_role'] ?></td>
                                        </tr>

                                    <?php } ?>
                                    <!-- AWAL BODY TABEL -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR SECTION USER LIST----------------------------------------------------------------------- -->

            <!-- AWAL SECTION PRODUCT LIST-------------------------------------------------------------------- -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Product List</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi Produk</th>
                                        <th>Harga Produk</th>
                                    </tr>
                                </thead>

                                <!-- AWAL BODY TABEL -->
                                <tbody>

                                    <?php

                                    while ($data = mysqli_fetch_array($productlistQuery)) {
                                        $hargaproduk = number_format($data['harga_product'], 0, '', '.');
                                    ?>

                                        <tr>
                                            <td><?= $data['id'] ?></td>
                                            <td><img class="productImage" src="../<?= $data['gambar_product'] ?>" alt=""></td>
                                            <td><?= $data['nama_product'] ?></td>
                                            <td><?= $data['deskripsi_product'] ?></td>
                                            <td>Rp<?= $hargaproduk ?></td>
                                        </tr>

                                    <?php } ?>
                                    <!-- AWAL BODY TABEL -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR SECTION PRODUCT LIST-------------------------------------------------------------------- -->

        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/dashboard-charts.js"></script>
    <script src="assets/js/script.js"></script>
</body>


</html>