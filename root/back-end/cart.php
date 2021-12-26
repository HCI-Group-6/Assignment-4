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

// Cek k

// POST Menambahkan Jumlah / Quantity
if (isset($_POST['quantityenter'])) {
    $key = 0;
    $count = count($_SESSION['cart']);
    for ($i = 0; $i < $count; $i++) {
        if ($_SESSION['cart'][$i][0] == $_POST['quantityid']) {
            $key = $i;
        }
    }
    if($_POST['quantity'] > 0 && $_POST['quantity'] <= 100) {
        $_SESSION['cart'][$key][1] = $_POST['quantity'];
    } else if ($_POST['quantity'] > 100) {
        $_SESSION['cart'][$key][1] = 100;
    } else {
        $_SESSION['cart'][$key][1] = 1;
    }
}
// POST Menambahkan Jumlah / Quantity

// POST Menghapus Barang
if (isset($_GET['removeCart'])) {
    $key = 0;
    $count = count($_SESSION['cart']);
    for ($i = 0; $i < $count; $i++) {
        if ($_SESSION['cart'][$i][0] == $_GET['productid']) {
            $key = $i;
        }
    }
    array_splice($_SESSION['cart'], $key, 1);
    header('Location: cart.php');
}
// POST Menghapus Barang

// Cek jika Session Cart Belum Ada
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
// Cek jika Session Cart Belum Ada

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gadget NFO | Cart</title>
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
                        <h1 class="mb-3 mt-5 bread">Cart</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span>Cart</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Carousel -->

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th style="border-top-left-radius: 15px;">#</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th style="border-top-right-radius: 15px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Awal PHP -->
                                <?php

                                if (isset($_SESSION['cart'])) {
                                    $cart_total = 0;
                                    $count  = count($_SESSION['cart']);
                                    while ($data = mysqli_fetch_array($productlistquery)) {
                                        for ($i = 0; $i < $count; $i++) {
                                            $id         = $_SESSION['cart'][$i][0];
                                            $quantity   = $_SESSION['cart'][$i][1];
                                            if ($data['id'] == $id) {
                                                $cart_total += ((int)$data['harga_product'] * (int)$quantity);
                                ?>
                                                <!-- Awal Cart List -->
                                                <tr class="text-center">
                                                    <form method="get">
                                                        <td class="product-remove">
                                                            <a href="cart.php?removeCart=true&productid=<?= $data['id'] ?>">
                                                                <span class="icon-close"></span>
                                                            </a>
                                                        </td>
                                                    </form>

                                                    <td class="image-prod">
                                                        <div class="img" style="background-image:url(<?= $data['gambar_product'] ?>);"></div>
                                                    </td>

                                                    <td class="product-name">
                                                        <h3><?= $data['nama_product'] ?></h3>
                                                        <p><?= $data['deskripsi_product'] ?></p>
                                                    </td>

                                                    <td class="price">Rp<?= number_format($data['harga_product'], 0, '', '.'); ?></td>

                                                    <form method="post">
                                                        <td class="quantity">
                                                            <div class="input-group mb-3">
                                                                <input type="number" name="quantity" class="quantity form-control input-number" value="<?= $quantity ?>" min="1" max="100">
                                                                <input type="hidden" name="quantityid" value="<?= $data['id'] ?>">
                                                                <input type="submit" name="quantityenter" style="display: none" />
                                                            </div>
                                                        </td>
                                                    </form>

                                                    <td class="total">Rp<?= number_format(((int)$data['harga_product'] * (int)$quantity), 0, '', '.') ?></td>
                                                </tr>
                                                <!-- Akhir Cart List -->
                                <?php
                                            };
                                        };
                                    };
                                };
                                ?>
                                <!-- Akhir PHP -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cart Totals -->
            <?php
            if (isset($_SESSION['cart'])) {
                if (count($_SESSION['cart']) > 0) {
                    $pengiriman = 10000;
                    $discount   = 30000;
                    $subtotal = ($cart_total + $pengiriman) - $discount;
                } else {
                    $pengiriman = 0;
                    $discount   = 0;
                    $subtotal   = 0;
                    $cart_total = 0;
                }
            } else {
            }
            ?>

            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Subtotal</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>Rp<?= number_format($cart_total, 0, '', '.'); ?></span>
                        </p>
                        <p class="d-flex shipping">
                            <span>Pengiriman</span>
                            <span style="color: red;">Rp<?= number_format($pengiriman, 0, '', '.'); ?></span>
                        </p>
                        <p class="d-flex discount">
                            <span>Discount</span>
                            <span style="color: darkgreen;">Rp<?= number_format($discount, 0, '', '.'); ?></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>Rp<?= number_format($subtotal, 0, '', '.'); ?></span>
                        </p>
                    </div>
                    <p class="text-center"><a href="<?= (count($_SESSION['cart']) > 0) ? 'checkout.php' : 'index.php#menu' ?>" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
            <!-- Cart Totals -->

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