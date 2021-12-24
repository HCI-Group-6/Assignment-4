<!-- Awal Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a href="index.php">
            <div class="navbar-brand" style="display: inline-block;">
                <span class="navbar-brand" style="display: inline-block;">Gadget<span style="color: #2ccccc;"> NFO</span></span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="index.php#menu" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="index.php#about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="index.php#contact" class="nav-link">Contact</a></li>

                <?php
                if (isset($_SESSION['login'])) {
                    $usernameoremail    = $_SESSION["username"];
                    $namadepanquery     = mysqli_query($host, "SELECT * FROM user_account WHERE username = '$usernameoremail' or email = '$usernameoremail'");
                    $data               = mysqli_fetch_assoc($namadepanquery);

                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                    } else {
                        $count = 0;
                    }


                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, <?= $data['nama_depan'] ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <?php if (getInfo('role') == 'Admin') {  ?>
                                <a class="dropdown-item" href="admin/index.php">Admin</a>
                                <div class="dropdown-divider"></div>
                            <?php } ?>
                            <a class="dropdown-item" href="cart.php">Cart</a>
                            <a class="dropdown-item" href="checkout.php">Checkout</a>
                            <a class="dropdown-item" href="orderhistory.php">Order History</a>
                            <a class="dropdown-item" href="php/logout.php">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item cart"><a href="cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small><?= $count ?></small></span></a></li>
                <?php } else { ?>
                    <li class="nav-item"><a href="php/login.php" class="nav-link">Login</a></li>
                    <li class="nav-item cart"><a href="cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>0</small></span></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Akhir Navbar-->