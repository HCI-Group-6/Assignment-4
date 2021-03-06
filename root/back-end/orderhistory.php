<?php

include "php/functions.php";

if (isset($_COOKIE["rememberme"])) {
    if ($_COOKIE == "true") {
        $_SESSION['login'] = true;
    }
}

if (!isset($_SESSION["login"])) {
    header("Location: php/login.php");
    exit;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gadget NFO | Order History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS LINK -->
    <link rel="icon" href="images/logo/logo.svg">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS LINK -->
</head>

<body style="background-color: #fff;">
    <!-- Awal Navbar -->
    <?php require_once('php/headerfooter/navbar.php'); ?>
    <!-- Akhir Navbar-->

    <!-- Awal Carousel -->
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/background/bg_05.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Order History</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span>History</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Carousel -->

    <section class="ftco-section ftco-cart" style="min-height: 600px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="col-md-1"  style="border-top-left-radius: 15px">ID</th>
                                    <th class="col-md-3">Produk</th>
                                    <th class="col-md-2">Total</th>
                                    <th class="col-md-3">Alamat & Penerima</th>
                                    <th class="col-md-2"  style="border-top-right-radius: 15px;">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <!-- Awal PHP -->
                                <?php

                                $id                     = getInfo('id');
                                $orderlistIDQuery       = mysqli_query($host, "SELECT * FROM orderlist WHERE userid = '$id'");

                                while ($data = mysqli_fetch_array($orderlistIDQuery)) {
                                ?>
                                    <!-- Awal Cart List -->
                                    <tr>
                                        <td><?= $data['id'] ?></td>

                                        <td>
                                            <?php
                                            $totalHarga     = number_format($data['total'], 0, '', '.');
                                            $jumlahOrder    = count(explode_all($data['order_list']));

                                            $alamatLengkap  = $data['alamat'] . ", " . $data['provinsi'];
                                            $namaPenerima   = $data['nama'];
                                            $nomorTelepon   = $data['nomortelepon'];
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
                                        <td><?= $namaPenerima ?> (<?= $nomorTelepon ?>)<br><?= $alamatLengkap ?></td>
                                        <td><?= $data['orderstatus'] ?></td>
                                    </tr>
                                    <!-- Akhir Cart List -->
                                <?php } ?>
                                <!-- Akhir PHP -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Awal Footer -->
    <?php require_once('php/headerfooter/footer.php') ?>
    <!-- Akhir Footer -->

    <!-- Awal Loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <!-- Akhir Loader -->


</body>

</html>