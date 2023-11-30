<?php
$title = "Login | JapanFoods";
$page = "login";

session_start();
require_once "config/url.php";
require_once "libs/validate.php";

// Jika sudah ada session login
if (isset($_SESSION["login"])){
    // apakah session login pelanggan / administrator / manager 
    if ($_SESSION['login'] == 'pelanggan') {
        header("Location: menu.php");
        exit();
    } else {
        header("Location: admin/index.php");
        exit();
    }
}

$error = array();
if (isset($_POST["submit"])){
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    validateLogin($error, $username, $password);
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
    <!-- COntainer Start -->
    <div class="container">
        <!-- Content Start -->
        <div class="content middle">
            <div class="login">
                <h2>Login</h2>
                <!-- Form Start -->
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= $_POST["username"] ?? '' ?>">
                    <span class="errorlogin"><?= $error["username"] ?? '' ?></span>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <span class="errorlogin"><?= $error["password"] ?? ''?></span>
                    <br>
                    <button class="btn btn-yellow submit" type="submit" name="submit">Login</button>
                    <p>Belum punya akun? <span><a href="register.php">Daftar Sekarang</a></span></p>
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Content End -->
    </div>
    <!-- Container End -->
</body>
</html>
