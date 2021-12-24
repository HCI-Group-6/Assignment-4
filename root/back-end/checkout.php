<?php

// include "php/functions.php";
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

if (isset($_POST["checkout"])) {
    $_SESSION['paymentMethod'] = $_POST['metodepembayaran'];
    if (func_checkout($_POST) > 0) {
        header("Location: checkout_confirm.php");
    } else {
        return false;
    }
}

if(isset($_SESSION['cart'])) {
    if(count($_SESSION['cart']) == 0) {
        header("Location: index.php#menu");
    }
} else {
    header("Location: index.php#menu");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gadget NFO | Checkout</title>
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
        <div class="slider-item" style="background-image: url(images/background/bg_06.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Checkout</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span>Checkout</p>
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
                <div class="col-xl-7 ftco-animate">

                    <?php
                    $usernameoremail    = $_SESSION['username'];
                    $useraccountquery   = mysqli_query($host, "SELECT * FROM user_account WHERE username = '$usernameoremail' OR email = '$usernameoremail'") or die(mysqli_error($host));

                    $data = mysqli_fetch_assoc($useraccountquery);
                    ?>

                    <!-- Awal Form -->
                    <form method="post" class="billing-form ftco-bg-dark p-3 p-md-5">
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Nama Depan</label>
                                    <input type="text" class="form-control" name="namadepan" value="<?= $data['nama_depan'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Nama Belakang</label>
                                    <input type="text" class="form-control" required name="namabelakang" value="<?= $data['nama_belakang'] ?>">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Provinsi</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="provinsi" id="" class="form-control" required>
                                            <option value="DKI Jakarta">DKI Jakarta</option>
                                            <option value="Banten">Banten</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Jawa Tengah">Jawa Tengah</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="Yogyakarta">Yogyakarta</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="streetaddress">Alamat</label>
                                    <textarea name="alamat" rows="3" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Kota</label>
                                    <input type="text" class="form-control" required name="kota">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Kode Pos</label>
                                    <input type="text" class="form-control" required name="kodepos">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" class="form-control" required name="nomortelepon" value="<?= $data['nomor_telepon'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email</label>
                                    <input type="text" class="form-control" required name="email" value="<?= $data['email'] ?>">
                                </div>
                            </div>
                            <div class="w-100"></div>
                        </div>

                        <!-- Akhir Form -->

                </div>

                <div class="col-xl-5">

                    <?php
                    $cart_total = 0;
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
                    } else {
                        $pengiriman = 0;
                        $discount   = 0;
                        $subtotal   = 0;
                        $cart_total = 0;
                    }
                    ?>
                    <!-- Awal Cart Total -->
                    <div class="col-md-14 d-flex">
                        <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Total Belanjaan</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>Rp<?= number_format($cart_total, 0, '', '.'); ?></span>
                            </p>
                            <p class="d-flex">
                                <span>Pengiriman</span>
                                <span style="color: red;">Rp<?= number_format($pengiriman, 0, '', '.'); ?></span>
                            </p>
                            <p class="d-flex">
                                <span>Discount</span>
                                <span style="color: darkgreen;">Rp<?= number_format($discount, 0, '', '.'); ?></span>
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
                        <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Metode Pembayaran</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="metodepembayaran" class="mr-2" value='bankmethod'> Bank Transfer (BCA)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="metodepembayaran" class="mr-2" value='emoneymethod'> E-Money (Dana, Ovo, Gopay, dll)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="metodepembayaran" class="mr-2" value='ccmethod' disabled> Kartu Kredit (Visa, Master Card, dll)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox-required">
                                        <label><input type="checkbox" value="agreement" class="mr-2" required> Setuju dengan syarat dan ketentuan</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="checkout" class="btn btn-primary py-3 px-4" style="margin: 20px 0 14px 0">Konfirmasi</button>

                            <input type="hidden" name="user_id" value="<?= getInfo('id') ?>">
                            <input type="hidden" name="buktipembayaran" value="false">
                            <input type="hidden" name="status" value="false">
                            <input type="hidden" name="total" value="<?= $cart_total ?>">
                        </div>
                        <!-- Akhir Payment Method -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
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