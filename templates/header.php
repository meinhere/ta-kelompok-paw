<?php include "config/url.php" ?>
<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");

if ($page != "home") {
    if(!isset($_SESSION['login']) || $_SESSION['login'] != "pelanggan") {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="website icon" href="<?= BASEASSET; ?>/img/logo/icon.png">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/base.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/login.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/customer/navbar.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/customer/styles.css">
    
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container">