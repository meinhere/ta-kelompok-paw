<?php
$title = "Register Karyawan | JapanFoods";
$page = "regist";

ob_start();

require_once "../config/url.php";
require_once BASEPATH . "/libs/validate.php";
require_once BASEPATH . "/data/karyawan.php";

if (isset($_SESSION["login"])){
    if ($_SESSION['login'] == 'pelanggan') {
        header("Location: menu.php");
        exit();
    } else {
        header("Location: admin/index.php");
        exit();
    }
}

$errors = array();
if (isset($_POST["submit"])) {
   validateRegisterEmployee($errors, $_POST);

  if (empty($errors)) {
    $success = insertEmployee($_POST);
  } else {
    $attention = "Perbaiki inputan anda sesuai dengan pesan!";
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
    
    <title><?= $title; ?></title>
</head>
<body>
  <div class="content middle">
      <div class="register">
          <h2>Register Karyawan</h2>
          <form action="" method="post">
            <?php 
                if (isset($success) && $success) {
                    echo "<div class='form-success'>Data Berhasil Ditambah</div>";
                    header("Refresh: 1; url=" . BASEURL .  "/login.php");
                }
            ?>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $_POST['nama'] ?? "" ?>" autofocus>
            <span class="errForm">
                <?= ($errors['nameErr'] ?? ''); ?>
            </span>
            <label for="username">Username</label>
            <input type="text" name="username" id="username"
                value="<?= $_POST['username'] ?? "" ?>">
            <span class="errForm">
                <?= ($errors['usernameErr'] ?? ''); ?>
            </span>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                value="<?= $_POST['password'] ?? "" ?>">
            <span class="errForm">
                <?= ($errors['passwordErr'] ?? ''); ?>
            </span>
            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2">
            <span class="errForm">
                <?= ($errors['password2Err'] ?? ''); ?>
            </span>
            <label for="nohp">No Telepon</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input class="input-group-input" type="text" name="nohp" id="nohp" placeholder="8XXXXXXXXXXXX"
                    value="<?= $_POST['nohp'] ?? "" ?>">
            </div>
            <span class="errForm">
                <?= ($errors['nohpErr'] ?? ''); ?>
            </span>
            <label for="role">Daftar Sebagai</label>
            <select name="role" id="role">
                <option value="1">Admin</option>
                <option value="2">Manager</option>
            </select>
            <button type="submit" class="btn btn-yellow" name="submit">Daftar</button>
            <p>Sudah punya akun? <span><a href="../login.php">Login</a></span></p>
          </form>
      </div>
  </div>
</body>
</html>