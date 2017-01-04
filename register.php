<?php
include 'application.php';
session_start();

if (isset($_POST['register'])) {

    try {
        $userLifecycle->register($_POST);
    } catch (Exception $e) {
        echo ($e);
    }
    if ($userLifecycle->register($_POST)) {
        header("Location: login.php");
        exit;
    }
}


include 'register_frontend.php';
