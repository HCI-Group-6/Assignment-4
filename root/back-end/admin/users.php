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

if (isset($_GET['removeAccount'])) {
    if (removeAccount($_GET['user_id']) == 1) {
        header('Location: users.php');
    }
}

?>

<!Doctype html>
<html lang="en">

<head>
    <title>Admin | Users List</title>
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
                        <h3>User List
                            <a href="form/addUser.php" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-user-plus"></i> Tambah User</a>
                        </h3>
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
                                        <th></th>
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
                                            <td class="text-end">
                                                <a href="form/editUser.php?user_id=<?= $data['id'] ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                                <a href="users.php?removeAccount=true&user_id=<?= $data['id'] ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php } ?>
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