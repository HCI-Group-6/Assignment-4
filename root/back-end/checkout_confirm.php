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

if (empty($_SESSION["cart"])) {
    header("Location: index.php#menu");
    exit;
}

if (isset($_POST['konfirmasibukti'])) {
    if(func_checkoutConfirm($_POST) > 0) {
        header("Location: orderhistory.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gadget NFO | Checkout Confirm</title>
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

<body>
    <!-- Awal Navbar -->
    <?php require_once('php/headerfooter/navbar.php'); ?>
    <!-- Akhir Navbar-->

    <!-- Awal Carousel -->
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/background/bg_07.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Checkout Confirm</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span>Confirm</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Carousel -->

    <!-- Awal Form -->
    <section class="ftco-section">
        <div class="container">
            <div class="row">

                <div class="col-xl-2"></div>

                <div class="col-xl-8">

                    <?php
                    $data           = func_paymentMethod($_SESSION['paymentMethod']);
                    $metode         = $data[0];
                    $metodejenis    = $data[1];
                    $nomor          = $data[2];
                    $atasnama       = $data[3];

                    $cart_total     = 0;
                    if (isset($_SESSION['cart'])) {
                        $pengiriman = 10000;
                        $discount   = 30000;
                        while ($data = mysqli_fetch_array($productlistquery)) {
                            for ($i = 0; $i < $count; $i++) {
                                $id         = $_SESSION['cart'][$i][0];
                                $quantity   = $_SESSION['cart'][$i][1];
                                if ($data['id'] == $id) {
                                    $cart_total += ((int)$data['harga_product'] * (int)$quantity);
                                }
                            }
                        }
                        $subtotal   = ($cart_total + $pengiriman) - $discount;
                    }
                    ?>

                    <!-- Awal Cart Total -->
                    <div class="col-md-14 d-flex">
                        <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Pembayaran</h3>
                            <p class="d-flex">
                                <span>Metode</span>
                                <span><?= $metode ?></span>
                            </p>
                            <p class="d-flex">
                                <span>Nomor <?= $metodejenis ?></span>
                                <span><?= $nomor ?></span>
                            </p>
                            <p class="d-flex">
                                <span>Atas Nama</span>
                                <span><?= $atasnama ?></span>
                            </p>
                            <hr>
                            <p class="d-flex total-price" style="margin-bottom: 10px;">
                                <span>Total</span>
                                <span>Rp<?= number_format($subtotal, 0, '', '.'); ?></span>
                            </p>
                        </div>
                    </div>
                    <!-- Akhir Cart Total -->

                    <!-- Awal Payment Method -->
                    <div class="col-md-14">
                        <div class="billing-form ftco-bg-dark p-3 p-md-4 billing-form">
                            <form method="post" enctype="multipart/form-data">
                                <h3 class="billing-heading mb-4">Upload Bukti Pembayaran</h3>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Dari Atas Nama</label>
                                            <input type="text" class="form-control" name="atasnama">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Bukti Pembayaran (Max. file size: 5 MB)</label>
                                            <input type="file" class="form-control" name="buktipembayaran" value="pending" style="border-style: none !important">
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" value="Pending" name="status">
                                <button type="submit" name="konfirmasibukti" class="btn btn-primary py-3 px-4" style="margin: 15px 0 15px 15px">Konfirmasi Pembayaran</button>
                            </form>
                        </div>
                    </div>
                    <!-- Akhir Payment Method -->
                </div>
            </div>
            <div class="col-xl-2"></div>

    </section>
    <!-- Akhir Form -->

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

    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>


</body>

</html>