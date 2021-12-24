<?php

include '../googleAPI/vendor/autoload.php';

session_start();

// Awal Global Variabel

$dbHost             = 'localhost';
$dbName             = 'gadgetnfo';
$dbUser             = 'root';
$dbPass             = 'muhaya#@123';
$host               = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
$success            = '';
$failed             = '';

$productlistquery   = mysqli_query($host, "SELECT * FROM productlist") or die(mysqli_error($host));

// Akhir Global Variabel

// Awal Variabel Login with Google-----------------------------------------------------------------------------
$clientID       = '367631625256-fvhqlde1jcnmhup4gmfnnvp1oadqqgvb.apps.googleusercontent.com';
$clientSecret   = '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';
$redirectURL    = 'http://localhost/gadgetnfo/index.php';

$google_client = new Google_Client();

// Awal Set Client ID, Secret, dan RedirectURL
$google_client->setClientId($clientID);
$google_client->setClientSecret($clientSecret);
$google_client->setRedirectUri($redirectURL);
// Akhir Set Client ID, Secret, dan RedirectURL

$google_client->addScope('email');
$google_client->addScope('profile');
// Akhir Variabel Login with Google-----------------------------------------------------------------------------

function loginGoogle($data)
{

    global $host;

    $email      = strtolower(stripslashes($data[2]));
    $emailCheck = mysqli_query($host, "SELECT email FROM user_account WHERE email = '$email'");

    if (mysqli_fetch_assoc($emailCheck)) {

        $_SESSION["login"]    = true;
        $_SESSION["username"] = $email;
        return 1;

    } else {


        $namadepan      = $data[0];
        $namabelakang   = $data[1];
        $password       = '';
        $defaultRole    = 'Guest';
        $nomortelepon   = '';
        $nama           = str_replace(" ", "", strtolower($namadepan . $namabelakang));  
        $username       = $nama . uniqid();

        if (isset($data['role'])) {
            $role       = $data['role'];
        } else {
            $role       = $defaultRole;
        }

        $registerByGoogle = mysqli_query(
            $host,
            "INSERT INTO user_account VALUES(
                '',
                '$role',
                '$namadepan',
                '$namabelakang',
                '$nomortelepon',
                '$email',
                '$username',
                '$password')"
        );

        if ($registerByGoogle) {
            $_SESSION["login"]    = true;
            $_SESSION["username"] = $email;
            return 1;
        }
    }

}


function func_register($data)
{

    global $host, $failed;

    $username       = strtolower(stripslashes($data['username']));
    $password       = mysqli_real_escape_string($host, $data['password']);
    $confirm        = mysqli_real_escape_string($host, $data['passwordconfirm']);

    $namadepan      = ucwords($data['namadepan']);
    $namabelakang   = ucwords($data['namabelakang']);
    $email          = strtolower($data['email']);
    $nomortelepon   = $data['notelp'];

    $defaultRole    = 'Guest';

    if (isset($data['role'])) {
        $role       = $data['role'];
    } else {
        $role       = $defaultRole;
    }

    // Cek Jika Password & Konfirmasi Password telah Sesuai
    if ($password !== $confirm) {
        $failed = 'Password yang dimasukkan tidak sesuai';
        return false;
        exit;
    }

    // Cek Jika Username Sudah Ada Dalam Database
    $usernamecheck = mysqli_query($host, "SELECT username FROM user_account WHERE username = '$username'");

    if (mysqli_fetch_assoc($usernamecheck)) {
        $failed = 'Username atau email sudah terdaftar';
        return false;
    }

    // Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Input Data ke Database
    $register = mysqli_query(
        $host,
        "INSERT INTO user_account VALUES(
        '',
        '$role',
        '$namadepan',
        '$namabelakang',
        '$nomortelepon',
        '$email',
        '$username',
        '$password')"
    );

    return mysqli_affected_rows($host);
}

function func_login($data)
{

    global $host, $success, $failed, $id;

    $usernameoremail    = strtolower(stripslashes($data['usernameoremail']));
    $password           = mysqli_real_escape_string($host, $data['password']);

    // Cek Username
    $check = mysqli_query($host, "SELECT * FROM user_account WHERE username = '$usernameoremail' or email = '$usernameoremail'");
    if (mysqli_num_rows($check)) {
        // Cek Password
        $row = mysqli_fetch_assoc($check);

        // Hash Cookies
        $key    = hash("sha256", $row["username"]);
        $value  = hash("ripemd256", $key);
        if (password_verify($password, $row['password'])) {
            if (isset($data["rememberme"])) {
                setcookie("id", $row["id"], time() + 36000);
                setcookie($key, $value, time() + 36000);
            }
            // Variabel Nama Depan
            $_SESSION["login"]    = true;
            $_SESSION["username"] = $usernameoremail;
            return 1;
        }
    } else {
        $failed = "Username atau email belum terdaftar";
    }
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

function func_checkout($data)
{

    $user_id                    = $data['user_id'];
    $namadepan                  = $data['namadepan'];
    $namabelakang               = $data['namabelakang'];
    $total                      = $data['total'];
    $provinsi                   = $data['provinsi'];
    $alamat                     = $data['alamat'];
    $kota                       = $data['kota'];
    $kodepos                    = $data['kodepos'];
    $nomortelepon               = $data['nomortelepon'];
    $email                      = $data['email'];
    // $buktibayar                 = $data['buktibayar'];
    // $atasnama                   = $data['atasnama'];
    $status                     = $data['status'];

    $nama = $namadepan . " " . $namabelakang;
    $alamat .= ", $kota, $kodepos";

    $setsession = $_SESSION['checkoutform'] = array(
        $user_id,
        $nama,
        $total,
        $provinsi,
        $alamat,
        $nomortelepon,
        $email
    );

    if ($setsession === $_SESSION['checkoutform']) {
        return 1;
    }
}

function implode_all($glue, $arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        if (@is_array($arr[$i]))
            $arr[$i] = implode_all($glue, $arr[$i]);
    }
    return implode($glue, $arr);
}

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

function func_checkoutConfirm($data)
{

    global $host;

    $user_id        = $_SESSION['checkoutform'][0];
    $nama           = $_SESSION['checkoutform'][1];
    $total          = $_SESSION['checkoutform'][2];
    $provinsi       = $_SESSION['checkoutform'][3];
    $alamat         = $_SESSION['checkoutform'][4];
    $nomortelepon   = $_SESSION['checkoutform'][5];
    $email          = $_SESSION['checkoutform'][6];

    $orderlist      = implode_all(",", $_SESSION['cart']);
    $atasnama       = $data['atasnama'];
    $status         = $data['status'];

    // Mengambil Last ID (Primary Key) -----------------------------
    $query  = mysqli_query($host, "SELECT MAX(id) FROM orderlist");
    $row    = mysqli_fetch_assoc($query);
    $id     = (int)$row["MAX(id)"] + 1;

    $buktibayar = 'images/orderpayment/' . upload($id);

    if (!$buktibayar) {
        return false;
    }
    // Mengambil Last ID (Primary Key) -----------------------------

    // INSERT ke database jika status berubah ----------------------
    if ($status == 'Pending') {
        mysqli_query($host, "INSERT INTO orderlist VALUES (
        '',
        '$user_id',
        '$nama',
        '$orderlist',
        '$total',
        '$provinsi',
        '$alamat',
        '$nomortelepon',
        '$email',
        '$buktibayar',
        '$atasnama',
        '$status')");
        $_SESSION['cart'] = array();
        return mysqli_affected_rows($host);
    }
    // INSERT ke database jika status berubah ----------------------
}

function upload($id)
{
    $namaFile   = $_FILES['buktipembayaran']['name'];
    $ukuranFile = $_FILES['buktipembayaran']['size'];
    $tmpName    = $_FILES['buktipembayaran']['tmp_name'];
    $errorInfo  = $_FILES['buktipembayaran']['error'];

    $namaFile   = strtolower($namaFile);

    if ($errorInfo != 0) {
        return false;
    }

    $ekstensiFile   = ['jpg', 'jpeg', 'png', 'jfif'];
    $formatFile     = pathinfo($namaFile, PATHINFO_EXTENSION);

    if (!in_array($formatFile, $ekstensiFile)) {
        return false;
    }

    if ($ukuranFile > 5242880) {
        return false;
    }

    $namaFileBaru = "order_" . $id . "." . $formatFile;

    move_uploaded_file($tmpName, 'images/orderpayment/' . $namaFileBaru);

    return $namaFileBaru;
}

function func_paymentMethod($data)
{

    $metode         = '';
    $metodenomor    = '';
    $nomor          = '';
    $atasnama       = '';
    switch ($data) {
        case 'bankmethod':
            $metode         = 'Bank Transfer (BCA)';
            $metodenomor    = 'Rekening';
            $nomor          = '2302557170';
            $atasnama       = 'Chiko Tridipa';
            break;
        case 'emoneymethod':
            $metode         = 'E-Money (DANA, OVO, GoPay, ShopeePay)';
            $metodenomor    = 'Tujuan';
            $nomor          = '087887152770';
            $atasnama       = 'Chiko Tridipa';
            break;
        default:
            $metode         = 'Not Available';
            $metodenomor    = 'Not Available';
            $nomor          = 'Not Available';
            $atasnama       = 'Not Available';
            break;
    }

    $result = array($metode, $metodenomor, $nomor, $atasnama);

    return $result;
}
