<?php 
$title = "Edit Profil | JapanFoods";
$page = "edprof";
include "templates/header.php";

require_once "data/pelanggan.php";
require_once "data/pembayaran.php";
require_once "libs/validate.php";
$pelanggan = getCustomerById();

$errors = array();
if (isset($_POST["edit"])) {
    $errors = validateEdit($errors, $_POST);

    if (empty($errors)) $edit = editCustomer($_POST);
}

if (isset($_POST["bri"])) {
    $errors = validatePayment($errors, $_POST);

    if (empty($errors)) $add = editPayment($_POST);
}
?>
<?php include "templates/navbar.php"; ?>
<div class="form-edit">    
    <form action="" method="post">
        <?php 
            if (isset($edit) && $edit) {
                echo "<div class='form-success'>Data Berhasil Diubah</div>";
                header("Refresh: 1");
            }
        ?>
        
        <div class="input-group">
            <label for="username">Username</label>
            <div class="err-group">
                <input type="text" id="username" name="username" value="<?= $pelanggan['USERNAME_PELANGGAN']; ?>" readonly>
            </div>
        </div>
        <div class="input-group">
            <label for="nama">Nama</label>
            <div class="err-group">
                <input type="text" id="nama" name="nama" value="<?= $_POST['nama'] ?? $pelanggan['NAMA_PELANGGAN']; ?>">
                <span class="errForm"><?= ($errors['nameErr'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="nohp">Nomor Telepon</label>
            <div class="err-group">
                <input type="text"  id="nohp" name="nohp" value="<?= $_POST['nohp'] ?? $pelanggan['NO_TELP_PELANGGAN']; ?>">
                <span class="errForm"><?= ($errors['nohpErr'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="alamat">Alamat</label>
            <div class="err-group">
                <input type="text"  id="alamat" name="alamat" value="<?= $_POST['alamat'] ?? $pelanggan['ALAMAT_PELANGGAN']; ?>"> 
                <span class="errForm"><?= ($errors['alamatErr'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label>Jenis Kelamin</label>
            <div id="jenis_kelamin">
                <input type="radio" name="jenis_kelamin" id="jk1" value="L" <?= $pelanggan['JENIS_KELAMIN'] == "L" || (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == "L") ? "checked" : "" ; ?> /> 
                <label for="jk1">Laki-Laki</label>
                <input type="radio" name="jenis_kelamin" id="jk2" value="P" <?= $pelanggan['JENIS_KELAMIN'] == "P" || (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == "P") ? "checked" : "" ; ?> /> 
                <label for="jk2">Perempuan</label> 
            </div>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <div class="err-group">
                <input type="password" id="password" name="password" value="<?= $_POST['password'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['passwordErr'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="password2">Konfirmasi Password</label>
            <div class="err-group">
                <input type="password" id="password2" name="password2" value="<?= $_POST['password2'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['password2Err'] ?? ''); ?></span>
            </div>
        </div>

        <button type="submit" name="edit" class="btn btn-blue">Simpan Perubahan</button>
    </form>

    <form action="" method="post">
        <h3>Tambahkan Metode Pembayaran</h3>
        <?php 
            if (isset($add) && $add) {
                echo "<div class='form-success'>Data Berhasil Ditambah</div>";
                header("Refresh: 1");
            }
        ?>
        <div class="input-group">
            <label for="bri">Rekening BRI</label>
            <div class="err-group">
                <input type="text" id="bri" name="bri" value="<?= $_POST['bri'] ?? getPaymentById("1")['NO_REKENING'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['bri'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="bca">Rekening BCA</label>
            <div class="err-group">
                <input type="text" id="bca" name="bca" value="<?= $_POST['bca'] ?? getPaymentById("2")['NO_REKENING'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['bca'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="dana">Digital DANA</label>
            <div class="err-group">
                <input type="text" id="dana" name="dana" value="<?= $_POST['dana'] ?? getPaymentById("3")['NO_REKENING'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['dana'] ?? ''); ?></span>
            </div>
        </div>
        <div class="input-group">
            <label for="ovo">Digital OVO</label>
            <div class="err-group">
                <input type="text" id="ovo" name="ovo" value="<?= $_POST['ovo'] ?? getPaymentById("4")['NO_REKENING'] ?? ""; ?>">
                <span class="errForm"><?= ($errors['ovo'] ?? ''); ?></span>
            </div>
        </div>

        <button type="submit" class="btn btn-green">Tambah Metode</button>
    </form>
</div>
<?php include "templates/footer.php" ?>