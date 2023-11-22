<?php
$title = "Register | JapanFoods";
$page = "regist";
?>
<?php include "templates/header.php" ?>
<?php include "functions.php" ?>

<?php

if (isset($_POST["submit"])) {
    $validate = validateAll($_POST);

    // var_dump($validate);

    // Check if there are no errors in the validation
    if (empty($validate['nameErr']) && empty($validate['usernameErr']) && empty($validate['passwordErr']) && empty($validate["password2Err"]) && empty($validate['nohpErr']) && empty($validate['alamatErr'])) {
        $user = register($_POST);

        if ($user) {
            echo "<div>Data Berhasil Ditambahkan</div>";
            header("Refresh: 1; url=login.php");
            exit();
        }
    } else {
        $attention = "Perbaiki inputan anda sesuai dengan pesan!";
    }
}
?>

<div class="content middle">
    <div class="register">
        <h2>Register</h2>
        <form action="" method="post">
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" value="<?= !isset($_POST['nama']) ? "" : $_POST['nama'] ?>">
            <span class="errForm">
                <?= ($validate['nameErr'] ?? ''); ?>
            </span>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username"
                value="<?= !isset($_POST['username']) ? "" : $_POST['username'] ?>">
            <span class="errForm">
                <?= ($validate['usernameErr'] ?? ''); ?>
            </span>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password"
                value="<?= !isset($_POST['password']) ? "" : $_POST['password'] ?>">
            <span class="errForm">
                <?= ($validate['passwordErr'] ?? ''); ?>
            </span>
            <label for="password2">Confirm Password : </label>
            <input type="password" name="password2" id="password2"
                value="<?= !isset($_POST['password2']) ? "" : $_POST['password2'] ?>">
            <span class="errForm">
                <?= ($validate['password2Err'] ?? ''); ?>
            </span>
            <label for="nohp">No Telepon : </label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input class="input-group-input" type="text" name="nohp" id="nohp" placeholder="8XXXXXXXXXXXX"
                    value="<?= !isset($_POST['nohp']) ? "" : $_POST['nohp'] ?>">
            </div>
            <span class="errForm">
                <?= ($validate['nohpErr'] ?? ''); ?>
            </span>
            <label for="alamat">Alamat : </label>
            <input type="text" name="alamat" id="alamat"
                value="<?= !isset($_POST['alamat']) ? "" : $_POST['alamat'] ?>">
            <span class="errForm">
                <?= ($validate['alamatErr'] ?? ''); ?>
            </span>
            <label for="jenis_kelamin">Jenis-Kelamin : </label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <span class="errForm">
                <?php echo $attention ?? '' ?>
            </span>
            <button type="submit" class="btn btn-yellow" name="submit">Daftar</button>
            <p>Sudah punya akun? <span><a href="login.php">Login</a></span></p>
        </form>
    </div>
</div>

<?php include "templates/footer.php" ?>