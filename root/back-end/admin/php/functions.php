<?php

session_start();

// Awal Global Variabel

$dbHost             = 'localhost';
$dbName             = 'gadgetnfo';
$dbUser             = 'root';
$dbPass             = 'muhaya#@123';
$host               = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
$success            = '';
$failed             = '';

$userlistQuery      = mysqli_query($host, "SELECT * FROM user_account") or die(mysqli_error($host));
$productlistQuery   = mysqli_query($host, "SELECT * FROM productlist") or die(mysqli_error($host));
$orderlistQuery     = mysqli_query($host, "SELECT * FROM orderlist") or die(mysqli_error($host));

// Awal Fungsi Remove --------------------------------------------------------------------------------------------

// Remove User Account
function removeAccount($id)
{

    global $host, $success, $failed;

    $deleteAccount  = mysqli_query($host, "DELETE FROM user_account WHERE id = '$id'");
    if ($deleteAccount) {
        $success    = "Berhasil menghapus data dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal menghapus data";
        return 0;
    }
}

// Remove Produk
function removeProduct($id)
{

    global $host, $success, $failed;

    $deleteProduct  = mysqli_query($host, "DELETE FROM productlist WHERE id = '$id'");
    if ($deleteProduct) {
        $success    = "Berhasil menghapus produk dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal menghapus produk";
        return 0;
    }
}

// Remove Order
function removeOrder($id)
{

    global $host, $success, $failed;

    $deleteOrder = mysqli_query($host, "DELETE FROM orderlist WHERE id = '$id'");
    if ($deleteOrder) {
        $success    = "Berhasil menghapus order dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal menghapus order";
        return 0;
    }
}

// Akhir Fungsi Remove --------------------------------------------------------------------------------------------

// Awal Fungsi Edit -----------------------------------------------------------------------------------------------


function editAccount($data)
{

    global $host, $success, $failed;

    $id             = $data['user_id'];

    $role           = $data['role'];
    $namaDepan      = $data['namadepan'];
    $namaBelakang   = $data['namabelakang'];
    $nomorTelepon   = $data['nomortelepon'];
    $email          = $data['email'];
    $username       = $data['username'];

    $editAccount = mysqli_query($host, "UPDATE user_account SET
    user_role='$role',
    nama_depan='$namaDepan',
    nama_belakang='$namaBelakang',
    nomor_telepon='$nomorTelepon',
    email='$email',
    username='$username' WHERE id = '$id'");

    if ($editAccount) {
        $success    = "Berhasil mengedit data dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal mengedit data";
        return 0;
    }
}

function editProduct($data)
{

    global $host, $success, $failed;

    $id             = $data['product_id'];

    $nama_product       = $data['nama_product'];
    $deskripsi_product  = $data['deskripsi_product'];
    $hargaKopi      = $data['harga_product'];

    $gambarBaru     = false;

    if ($_FILES['gambar_product']['name'] != "") {
        $gambar_product     = "images/products/" . upload($id);
        $gambarBaru     = true;
    }

    if ($gambarBaru) {
        $editProduct    = mysqli_query($host, "UPDATE productlist SET
        nama_product='$nama_product',
        deskripsi_product='$deskripsi_product',
        harga_product='$hargaKopi',
        gambar_product='$gambar_product' WHERE id = '$id'");
    } else {
        $editProduct    = mysqli_query($host, "UPDATE productlist SET
        nama_product='$nama_product',
        deskripsi_product='$deskripsi_product',
        harga_product='$hargaKopi' WHERE id = '$id'");
    }

    if ($editProduct) {
        $success    = "Berhasil mengedit produk dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal mengedit produk";
        return 0;
    }
}

function editOrderStatus($data)
{

    global $host, $success, $failed;

    $id                 = $data['order_id'];
    $status             = $data['status'];

    $editOrderStatus    = mysqli_query($host, "UPDATE orderlist SET orderstatus = '$status' WHERE id = '$id'");

    if ($editOrderStatus) {
        $success    = "Berhasil mengubah status Order dengan ID = $id";
        return 1;
    } else {
        $failed     = "Gagal mengedit produk";
        return 0;
    }
}

function upload($id)
{
    $namaFile   = $_FILES['gambar_product']['name'];
    $ukuranFile = $_FILES['gambar_product']['size'];
    $tmpName    = $_FILES['gambar_product']['tmp_name'];
    $errorInfo  = $_FILES['gambar_product']['error'];

    $namaFile   = strtolower($namaFile);

    if ($errorInfo != 0) {
        return false;
    }

    $ekstensiFile   = ['jpg', 'jpeg', 'png'];
    $formatFile     = pathinfo($namaFile, PATHINFO_EXTENSION);

    if (!in_array($formatFile, $ekstensiFile)) {
        return false;
    }

    if ($ukuranFile > 5242880) {
        return false;
    }

    $namaFileBaru = "product_" . $id . "." . $formatFile;

    move_uploaded_file($tmpName, '../../images/products/' . $namaFileBaru);

    return $namaFileBaru;
}

// Akhir Fungsi Edit ----------------------------------------------------------------------------------------------


// Awal Fungsi Add -----------------------------------------------------------------------------------------------
function addProduct($data)
{

    global $host, $success, $failed;

    $nama_product       = $data['nama_product'];
    $deskripsi_product  = $data['deskripsi_product'];
    $hargaKopi      = $data['harga_product'];
    $nama_product       = $data['nama_product'];

    // Mengambil Last ID (Primary Key) -----------------------------
    $query          = mysqli_query($host, "SELECT MAX(id) FROM productlist");
    $row            = mysqli_fetch_assoc($query);
    $id             = (int)$row["MAX(id)"] + 1;

    $gambar_product     = "images/products/" . upload($id);

    mysqli_query($host, "ALTER TABLE productlist AUTO_INCREMENT = $id");

    $addProduct     = mysqli_query($host, "INSERT INTO productlist VALUES (
    '',
    '$nama_product',
    '$deskripsi_product',
    '$hargaKopi',
    '$gambar_product'
    )");

    if ($addProduct) {
        $success    = "Berhasil menambahkan produk baru";
        return 1;
    } else {
        $failed     = "Gagal menambahkan produk baru";
        return 0;
    }
}
// Akhir Fungsi Add ----------------------------------------------------------------------------------------------

// Awal Fungsi Lainnya -------------------------------------------------------------------------------------------
function explode_all($data1)
{
    $data   = explode(",", $data1);
    $count  = count($data);
    $result = array();
    for ($i = 0; $i < $count; $i++) {
        for ($x = 0; $x <= 1; $x++) {
            $indexdata = ($i * 2) + $x;
            if ($indexdata < $count) {
                $result[$i][$x] = $data[$indexdata];
                $indexdata++;
            }
        }
    }
    return $result;
}

function getInfo($typeInfo)
{

    global $host;

    if (isset($_SESSION['login'])) {
        $usernameoremail    = $_SESSION["username"];
        $namadepanquery     = mysqli_query($host, "SELECT * FROM user_account WHERE username = '$usernameoremail' or email = '$usernameoremail'");
        $data               = mysqli_fetch_assoc($namadepanquery);
        $id                 = $data['id'];
        $role               = $data['user_role'];
        $namaDepan          = $data['nama_depan'];
        $namaBelakang       = $data['nama_belakang'];
        $nama               = $namaDepan . " " . $namaBelakang;

        switch ($typeInfo) {
            case 'id':
                return $id;
                break;
            case 'role':
                return $role;
                break;
            case 'nama':
                return $nama;
                break;
            case 'namadepan':
                return $namaDepan;
                break;
            case 'namabelakang':
                return $namaBelakang;
                break;
            default:
                return 'No Data';
                break;
        }
    }
}

function func_loginAdmin($data)
{

    global $host, $success, $failed, $id;

    $usernameoremail    = strtolower(stripslashes($data['usernameoremail']));
    $password           = mysqli_real_escape_string($host, $data['password']);

    // Cek Username
    $check = mysqli_query($host, "SELECT * FROM user_account WHERE username = '$usernameoremail' or email = '$usernameoremail'");
    if (mysqli_num_rows($check)) {
        // Cek Password
        $row = mysqli_fetch_assoc($check);

        // Cek Role Admin
        $checkAdmin = $row['user_role'];

        // Hash Cookies
        $key    = hash("sha256", $row["username"]);
        $value  = hash("ripemd256", $key);
        if (password_verify($password, $row['password'])) {
            if ($checkAdmin == 'Admin') {
                if (isset($data["rememberme"])) {
                    setcookie("id", $row["id"], time() + 36000);
                    setcookie($key, $value, time() + 36000);
                }
                // Variabel Nama Depan
                $_SESSION["login"]    = true;
                $_SESSION["username"] = $usernameoremail;
                return 1;
            } else {
                $failed = "Akun tersebut bukan admin";
                return 0;
            }
        }
    } else {
        $failed = "Username atau password salah";
        return 0;
    }
}
// Akhir Fungsi Lainnya ------------------------------------------------------------------------------------------
