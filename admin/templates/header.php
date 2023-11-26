<?php include "../config/url.php" ?>
<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");

require_once BASEPATH . "/data/karyawan.php";

$karyawan = getEmployeeById();
if(!isset($_SESSION['login']) && $_SESSION['login'] == "pelanggan") {
    header("Location: " . BASEURL . "/login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <link rel="website icon" href="<?= BASEASSET; ?>/img/logo/icon.png">
  <link rel="stylesheet" href="<?= BASEASSET;?>/css/base.css">
  <link rel="stylesheet" href="<?= BASEASSET; ?>/css/admin/styles.css" />
  <link rel="stylesheet" href="<?= BASEASSET; ?>/icon/css/font-awesome.min.css" />

  <title><?= $title; ?></title>
</head>
<body>
  <div class="grid-container">
    <!-- Header -->
    <header class="header">
      <div class="menu-icon" onclick="openSidebar()">
        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
      </div>
      <div class="header-left"></div>
      <div class="header-right">
        <span><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
        <span>Selamat Datang, <strong><?= $karyawan['NAMA_KARYAWAN']; ?></strong></span>
      </div>
    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <?php include "templates/sidebar.php" ?>
    <!-- End Sidebar -->
