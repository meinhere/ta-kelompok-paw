<?php include "config/url.php" ?>
<?php 
date_default_timezone_set("Asia/Jakarta");
// session_start();
// if(!isset($_SESSION['login']) && $_SESSION['login'] != "customer") {
//     header("Location: " . BASEURL . "/app/login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= BASEASSET;?>/css/base.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/login.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/customer/navbar.css">
    <link rel="stylesheet" href="<?= BASEASSET;?>/css/customer/styles.css">
    
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container">