<?php require_once "../base.php" ?>
<?php 
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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL;?>/assets/css/base.css">
    <link rel="stylesheet" href="<?= BASEURL;?>/assets/css/customer/navbar.css">
    <link rel="stylesheet" href="<?= BASEURL;?>/assets/css/customer/styles.css">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container">