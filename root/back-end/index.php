<?php

include 'php/loginwithGoogle.php';

// Awal Cek Cookies Login
if (isset($_COOKIE["rememberme"])) {
    if ($_COOKIE == "true") {
        $_SESSION == true;
    }
}
// Akhir Cek Cookies Login

// Awal Function Add to Cart
if (isset($_POST['addtocart'])) {
    if ($_SESSION['login']) {
        if (isset($_SESSION['cart'])) {

            $itemalready        = false;
            $itemalreadyindex   = 0;

            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i][0] == $_POST['product_id']) {
                    $itemalready = true;
                    $itemalreadyindex = $i;
                }
            }

            if ($itemalready) {
                $_SESSION['cart'][$itemalreadyindex][1] += 1;
                header('Location: index.php#menu');
            } else {

                $count = count($_SESSION['cart']);

                $_SESSION['cart'][$count][0] = $_POST['product_id'];
                $_SESSION['cart'][$count][1] = 1;
                header('Location: index.php#menu');
            }
        } else {

            $item_array = array('product_id' => $_POST['product_id']);

            // Membuat Session Variabel 
            $_SESSION['cart'][0][0] = $_POST['product_id'];
            $_SESSION['cart'][0][1] = 1;
            header('Location: index.php#menu');
        }
    } else {
        header("Location: php/login.php");
        exit;
    }
}
// Akhir Function Add to Cart


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gadget NFO | Home</title>
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
    <?php require_once ('php/headerfooter/navbarhome.php'); ?>
    <!-- Akhir Navbar-->

    <!-- Awal Carousel -->
    <section class="home-slider owl-carousel" data-touch='false'>
        <!-- Slide 01 -->
        <div class="slider-item" style="background-image: url(images/background/bg_01.jpg);" data-touch='false'>
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-4">Bermacam Gadget Sesuai Dengan Kebutuhanmu</h1>
                        <p class="mb-4 mb-md-5">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus molestiae aperiam fugit!</p>
                        <p><a href="#menu" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a></p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Slide 02 -->
        <div class="slider-item" style="background-image: url(images/background/bg_02.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-4">Jaminan Original atau Uang Kembali!</h1>
                        <p class="mb-4 mb-md-5">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quia exercitationem voluptas!</p>
                        <p><a href="#menu" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a></p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Slide 02 -->
        <div class="slider-item" style="background-image: url(images/background/bg_03.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-4">Pelayanan Berkualitas Tinggi dan Support yang Baik</h1>
                        <p class="mb-4 mb-md-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis, delectus facere! Quisquam.</p>
                        <p><a href="#menu" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Carousel -->

    <!-- Awal About -->
    <section class="ftco-about d-md-flex" id="about">
        <div class="one-half img" style="background-image: url(images/background/bg_04.jpg);"></div>
        <div class="one-half ftco-animate">
            <div class="heading-section ftco-animate ">
                <h2 class="mb-4">Tentang Kami</h2>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, beatae delectus incidunt facilis consequatur recusandae magni assumenda, quod nam et repellat quam, ab non ratione culpa. Facere tempora quasi impedit nulla ullam debitis eveniet
                nesciunt dolorum voluptas modi iste, ea voluptatem vel dolores consequatur quae adipisci laborum dicta, dolorem quos atque nobis molestias. Vel vitae exercitationem voluptatibus nobis obcaecati, nihil nostrum mollitia neque molestiae odio
                at! Nostrum veritatis nobis voluptates impedit, nemo ab odit culpa aut rem temporibus dignissimos a quas omnis ea minus laudantium amet quisquam dolore possimus iure iusto esse vitae? Consectetur explicabo quaerat dolore inventore, error
                unde?
            </p>
            <div>
            </div>
    </section>
    <!-- Akhir About -->

    <!-- Awal Services -->
    <section class="ftco-section ftco-services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <img src="images/icon/icon-trophy.png" style="filter: invert(75%) sepia(73%) saturate(309%) hue-rotate(123deg) brightness(80%) contrast(86%);">
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Trophy</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis eligendi fugit ea ipsum, sunt optio?</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <img src="images/icon/icon-awards.png" style="filter: invert(75%) sepia(73%) saturate(309%) hue-rotate(123deg) brightness(80%) contrast(86%);">
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Awards</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis eligendi fugit ea ipsum, sunt optio?</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <img src="images/icon/icon-safety.png" style="filter: invert(75%) sepia(73%) saturate(309%) hue-rotate(123deg) brightness(80%) contrast(86%);">
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Safety</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis eligendi fugit ea ipsum, sunt optio?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Services -->

    <!-- Awal Daftar Menu -->
    <section class="ftco-section" id="menu">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4">Daftar Product</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus excepturi veniam repudiandae itaque, fugiat voluptatibus</p>
                </div>
            </div>


            <div class="row">
                <?php while ($data = mysqli_fetch_array($productlistquery)) { ?>
                    <div class="col-md-3">
                        <form method="post">
                            <div class="menu-entry">
                                <a href="#" class="img" style="background-image: url(<?= $data['gambar_product'] ?>);"></a>
                                <div class="text text-center pt-4">
                                    <h3><a href="#"><?= $data['nama_product'] ?></a></h3>
                                    <p><?= $data['deskripsi_product'] ?></p>
                                    <p class="price"><span>Rp<?= number_format($data['harga_product'], 0, '', '.'); ?></span></p>
                                    <button type="submit" name="addtocart" class="btn btn-primary btn-outline-primary">Add to Cart</button>
                                    <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
    <!-- Akhir Daftar Menu -->

    <!-- Awal Contact Information -->
    <section class="ftco-section contact-section" style="background-color: #e8ffff;" id="contact">
        <div class="container mt-5">
            <div class="row block-9">
                <div class="col-md-4 contact-info ftco-animate">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h2 class="h4">Contact Information</h2>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Address :</span> Pondok Kelapa, Jakarta Timur. 13450</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Phone :</span> +6287887152775</a>
                            </p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Email :</span> chiko.tridipa1@gmail.com</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <p><span>Website :</span> youmycoffee.site</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 ftco-animate">
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Contact Information -->

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