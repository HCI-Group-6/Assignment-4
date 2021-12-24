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

if (!isset($_GET['order_id'])) {
    header("Location: ../orderlist.php");
    exit;
} 

if (isset($_POST['editOrderStatus'])) {
    if (editOrderStatus($_POST) == 1) {
        header('Location: ../orderlist.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Edit Order Status</title>
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
                                <div class="card-header">Edit Order Status</div>
                                <div class="card-body">

                                    <?php

                                    $id                 = $_GET['order_id'];
                                    $orderIDlistQuery = mysqli_query($host, "SELECT * FROM orderlist WHERE id = '$id'");

                                    $data           = mysqli_fetch_array($orderIDlistQuery);
                                    $totalHarga     = number_format($data['total'], 0, '', '.');
                                    $alamatLengkap  = $data['alamat'] . ", " . $data['provinsi'];
                                    $buktiBayar     = "../" . $data['buktipembayaran'];
                                    $jumlahOrder    = count(explode_all($data['order_list']));

                                    ?>


                                    <form class="needs-validation" novalidate accept-charset="utf-8" method="post" enctype="multipart/form-data">
                                        <div class="row g-2">
                                            <div class="mb-3 col-md-8">
                                                <fieldset disabled>
                                                    <label class="form-label">Nama Pembeli</label>
                                                    <input type="text" class="form-control" value="<?= $data['nama'] ?>" name="namapembeli" required>
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-2 form-group">
                                                <fieldset disabled>
                                                    <label for="disabledTextInput" class="form-label">Order ID</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $data['id'] ?>">
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-2 form-group">
                                                <fieldset disabled>
                                                    <label for="disabledTextInput" class="form-label">User ID</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $data['userid'] ?>">
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <fieldset disabled>
                                                <label class="form-label">Alamat Lengkap</label>
                                                <textarea name="alamatlengkap" class="form-control" rows="3" required><?= $alamatLengkap ?></textarea>
                                            </fieldset>
                                        </div>

                                        <div class="mb-3">
                                            <fieldset disabled>
                                                <label>Order List</label>
                                                <select multiple class="form-control" id="exampleFormControlSelect1">
                                                    <?php
                                                    for ($i = 0; $i < $jumlahOrder; $i++) {
                                                        $listOrder      = explode_all($data['order_list']);
                                                        $idKopi         = $listOrder[$i][0];
                                                        $quantity       = $listOrder[$i][1];
                                                        $queryIDKopi    = mysqli_query($host, "SELECT * FROM productlist WHERE id = '$idKopi'");
                                                        $listKopi       = mysqli_fetch_assoc($queryIDKopi);
                                                        $nama_product       = $listKopi['nama_product'];

                                                        $quantity       = sprintf('%02d', $quantity);
                                                    ?>
                                                        <option style="text-weight: 700;"><?= $quantity ?> x <?= $nama_product ?></option>
                                                    <?php } ?>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-6">
                                                <fieldset disabled>
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" class="form-control" value="<?= $data['nomortelepon'] ?>" name="notelp" required>
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <fieldset disabled>
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" value="<?= $data['email'] ?>" name="email" required>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-3">
                                                <fieldset disabled>
                                                    <label class="form-label">Total Harga</label>
                                                    <input type="text" class="form-control" value="Rp<?= $totalHarga ?>" name="total" required>
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-9">
                                                <fieldset disabled>
                                                    <label class="form-label">Path Bukti Pembayaran</label>
                                                    <input type="text" class="form-control" value="<?= $data['buktipembayaran'] ?>" name="buktipembayaran" required>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Bukti Pembayaran</label> <br>
                                                <a href="../../<?= $data['buktipembayaran'] ?>" target="_blank" class="badge bg-success">Lihat Gambar </a>
                                            </div>

                                            <div class="mb-3 col-md-8">
                                                <label>Ubah Status Order</label>
                                                <select name="status" class="form-select" required>
                                                    <?php
                                                    switch ($data['orderstatus']) {
                                                        case 'Pending': ?>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                        <?php break;
                                                        case 'Tidak Valid': ?>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                        <?php break;
                                                        case 'Terverifikasi': ?>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                        <?php break;
                                                        case 'Dalam Proses': ?>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                        <?php break;
                                                        case 'Dalam Pengiriman': ?>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                        <?php break;
                                                        default: ?>
                                                            <option value="Pending">01. Pending</option>
                                                            <option value="Tidak Valid">2f. Tidak Valid</option>
                                                            <option value="Terverifikasi">2t. Terverifikasi</option>
                                                            <option value="Dalam Proses">03. Dalam Proses</option>
                                                            <option value="Dalam Pengiriman">04. Dalam Pengiriman</option>
                                                    <?php break;
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="order_id" value="<?= $data['id'] ?>">
                                        <a href="../orderlist.php" class="btn btn-warning"><i class="fas fa-reply"></i> Back</a>
                                        <button type="submit" name="editOrderStatus" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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