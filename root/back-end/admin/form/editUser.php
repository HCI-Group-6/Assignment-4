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

if (!isset($_GET['user_id'])) {
    header("Location: ../users.php");
    exit;
} 

if (isset($_POST['editUser'])) {
    if (editAccount($_POST) == 1) {
        header('Location: ../users.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin | Edit Account</title>
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
                                <div class="card-header">Edit Akun</div>
                                <div class="card-body">

                                    <?php

                                    $id                 = $_GET['user_id'];
                                    $userIDlistQuery    = mysqli_query($host, "SELECT * FROM user_account WHERE id = '$id'");

                                    $data = mysqli_fetch_array($userIDlistQuery);


                                    ?>


                                    <form class="needs-validation" novalidate accept-charset="utf-8" method="post">
                                        <div class="row g-2">
                                            <div class="mb-3 col-md-2 form-group">
                                                <fieldset disabled>
                                                    <label for="disabledTextInput" class="form-label">User ID</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $data['id'] ?>">
                                                </fieldset>
                                            </div>

                                            <div class="mb-3 col-md-5">
                                                <label class="form-label">Nama Depan</label>
                                                <input type="text" class="form-control" value="<?= $data['nama_depan'] ?>" name="namadepan" required>
                                            </div>

                                            <div class="mb-3 col-md-5">
                                                <label class="form-label">Nama Belakang</label>
                                                <input type="text" class="form-control" value="<?= $data['nama_belakang'] ?>" name="namabelakang" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" value="<?= $data['email'] ?>" name="email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" value="<?= $data['nomor_telepon'] ?>" name="nomortelepon" required>
                                        </div>

                                        <div class="row g-2">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" value="<?= $data['username'] ?>" name="username" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="state" class="form-label">Role</label>
                                                <?php if ($data['user_role'] == "Admin") { ?>
                                                    <select name="role" class="form-select" required>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Guest">Guest</option>
                                                    </select>
                                                <?php } else { ?>
                                                    <select name="role" class="form-select" required>
                                                        <option value="Guest">Guest</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
                                        <a href="../users.php" class="btn btn-warning"><i class="fas fa-reply"></i> Back</a>
                                        <button type="submit" name="editUser" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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