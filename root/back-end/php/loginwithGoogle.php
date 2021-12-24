<?php

use Google\Service\MyBusinessVerifications\Verification;

include 'functions.php';

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google\Service\Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $_SESSION['googleCheck'] = array();

        if (!empty($data['given_name'])) {
            $_SESSION['googleCheck'][0] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['googleCheck'][1] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['googleCheck'][2] = $data['email'];
        }
    }
    if(loginGoogle($_SESSION['googleCheck']) != 1) {
        header('location: php/login.php');
    } else {
        header('location: index.php');
    }
}
