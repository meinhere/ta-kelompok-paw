<?php 
$title = "Register | JapanFoods";
$page = "regist";
?>
<?php include "templates/header.php" ?>
<div class="content middle">
    <div class="register">
        <h2>Register</h2>
        <form action="#" method="post">
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama">
            <label for="username">Username : </label>
            <input type="username" name="username" id="username">
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
            <label for="nohp">No Telepon : </label>
            <input type="nohp" name="nohp" id="nohp">
            <a href="test.php"><button class="btn btn-yellow">Daftar</button></a>
            <p>Sudah punya akun? <span><a href="login.php">Login</a></span></p>
        </form>
    </div>
</div>
<?php include "templates/footer.php" ?>