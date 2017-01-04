<?php
session_start();
include 'application.php';


if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($userLifecycle->login($username, $password)) {
        $_SESSION['user'] = $username;
        header("Location: profile.php");
        exit;
    }

    header("Location: login.php?error=Invalid username/password");
    exit;
}
$error = isset($_GET['error']) ? $_GET['error'] : null;

include 'login_frontend.php';