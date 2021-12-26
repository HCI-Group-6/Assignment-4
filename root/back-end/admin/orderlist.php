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
} else if(isset($_SESSION['login']) && getInfo('role') != 'Admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['removeOrder'])) {
    if (removeOrder($_GET['order_id']) == 1) {
        header('Location: orderlist.php');
    }
}

?>

<!Doctype html>
<html lang="en">

<head>
    <title>Admin | Order List</title>
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
</head>

<body>
    <div class="wrapper">
        <!-- Awal Navbar -->
        <?php require_once 'components/navbarHorizontalRoot.php' ?>
        <!-- Akhir Navbar -->
        
        <div id="body" class="active">
            <!-- Awal Navbar Vertical -->
            <?php require 'components/navbarVerticalRoot.php'; ?>
            <!-- Akhir Navbar Vertical -->
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
                                        <th class="col-md-2">Alamat</th>
                                        <th class="col-md-2">No. HP</th>
                                        <th class="col-md-3">List Order</th>
                                        <th class="col-md-1">Total</th>
                                        <th class="col-md-1">Bukti</th>
                                        <th class="col-md-1">A/N</th>
                                        <th class="col-md-1">Status</th>
                                        <th class="col-md-1"></th>
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
                                            <td><a href="<?= $buktiBayar ?>" target="_blank" class="btn btn-outline-primary" style="border-radius: 15px;"><i class="fas fa-image"></i></a></td>
                                            <td><?= $data['atasnama'] ?></td>
                                            <td><?= $data['orderstatus'] ?></td>
                                            <td>
                                                <a href="form/editOrderStatus.php?order_id=<?= $data['id'] ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                                <a href="orderlist.php?removeOrder=true&order_id=<?= $data['id'] ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                            </td>
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
        </div>
    </div>
</body>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/datatables.min.js"></script>
<script src="assets/js/initiate-datatables.js"></script>
<script src="assets/js/script.js"></script>

</html>