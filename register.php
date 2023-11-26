<?php
$title = "Register | JapanFoods";
$page = "regist";

require_once "config/url.php";
require_once "libs/validate.php";
require_once "data/pelanggan.php";

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
   validateRegister($errors, $_POST);

    if (empty($errors)) {
      $success = insertCustomer($_POST);
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
          <h2>Register</h2>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <?php 
                if (isset($success) && $success) {
                    echo "<div class='form-success'>Data Berhasil Ditambah</div>";
                    header("Refresh: 1; url=login.php");
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
            <input type="password" name="password2" id="password2"
                value="<?= $_POST['password2'] ?? "" ?>">
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
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat"
                value="<?= $_POST['alamat'] ?? "" ?>">
            <span class="errForm">
                <?= ($errors['alamatErr'] ?? ''); ?>
            </span>
            <label for="jenis_kelamin">Jenis-Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <span class="errForm">
                <?php echo $attention ?? '' ?>
            </span>
            <button type="submit" class="btn btn-yellow submit" name="submit">Daftar</button>
            <p>Sudah punya akun? <span><a href="login.php">Login</a></span></p>
          </form>
      </div>
  </div>
</body>
</html>