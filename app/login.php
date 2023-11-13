<?php include "templates/header.php" ?>
<div class="content middle">
    <div class="login">
        <h2>Login</h2>
        <form action="#" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
            <a href="test.php"><button class="btn btn-yellow">Login</button></a>
            <p>Belum punya akun? <span><a href="register.php">Daftar Sekarang</a></span></p>
        </form>
    </div>
</div>
<?php include "templates/footer.php" ?>