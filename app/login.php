<?php
$title = "Login | JapanFoods";
$page = "login";

require "ceklogin.php";
session_start();

$error = array();

if (isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    validAllin($error, $username, $password);

}

?>
<?php include "templates/header.php" ?>
<div class="content middle">
    <div class="login">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" value="<?php echo $_POST["username"] ?? '' ?>">
            <span class="errorlogin"><?php echo $error["username"] ?? '' ?></span>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" value="<?php echo $_POST["password"] ?? '' ?>">
            <span class="errorlogin"><?php echo $error["password"] ?? ''?></span>
            <br>
            <a href="test.php"><input class="btn btn-yellow" type="submit" name="submit" value="Login"></input></a>
            <p>Belum punya akun? <span><a href="register.php">Daftar Sekarang</a></span></p>
        </form>
    </div>
</div>
<?php include "templates/footer.php" ?>
