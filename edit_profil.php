<?php 
$title = "Edit Profil | JapanFoods";
$page = "edprof";
?>
<?php include "templates/header.php" ?>
<div class="side-profile">
    <div class="logo">
        <img src="<?= BASEURL; ?>/assets/img/profil.png" alt="Logo">
    </div>
    <a href="index.php">Beranda</a>
    <a href="edit_profil.php">Profile</a>
    <a class="logout" href="#">Logout</a>
</div>
<div class="content">
    <div class="edit-form">    
        <div class="header">
            <h1>Profile</h1>
        </div>
        <form action="editprofil.php" method="post">
            <div class="input-group">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" value="" readonly>
            </div>
            <div class="input-group">
                <label for="nama">Nama :</label>
                <input type="text" id="nama" name="nama" value="">
            </div>
            <div class="input-group">
                <label for="telepon">Nomor Telepon :</label>
                <input type="text"  id="telepon" name="telepon" value="">
            </div>
            <div class="input-group">
                <label for="alamat">Alamat :</label>
                <input type="text"  id="alamat" name="alamat" value=""> 
            </div>
            <div class="input-group">
                <label>Jenis Kelamin :</label>
                <div id="jenis_kelamin">
                    <input type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki" /> 
                    <label for="jk1">Laki-Laki</label>
                    <input type="radio" name="jenis_kelamin" value="Perempuan" /> 
                    <label for="">Perempuan</label> 
                </div>
            </div>
            <div class="input-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" value="">
            </div>
            <div class="input-group">
                <label for="konpassword">Konfirmasi Password :</label>
                <input type="password" id="konpassword" name="konpassword" value=""> <img src="assets/editing.png" alt="">
            </div>

            <input type="submit" value="Simpan Perubahan" onclick="konfirmasi()">
        </form>
    </div>
</div>
<?php include "templates/footer.php" ?>