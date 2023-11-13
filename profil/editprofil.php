<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Profile</h1>
    </div>
    <div class="allin">
        <div id="navbar">
            <div class="dalamnav">
                <div id="logo">
                    <img src="assets/user.png" alt="Logo">
                </div>
                <a href="#">Beranda</a>
                <a href="editprofil.php">Profile</a>
                <a class="logout" href="#">Logout</a>
            </div>
        </div>
        <div id="content">
            <div class="form">
                <form action="editprofil.php" method="post">
                    <label for="username">Username :</label>
                    <input type="text" id="username" name="username" value="" readonly> <br><br>

                    <label for="nama">Nama :</label>
                    <input type="text" id="nama" name="nama" value=""> <img src="assets/editing.png" alt=""> <br><br>

                    <label for="telepon">Nomor Telepon :</label>
                    <input type="text"  id="telepon" name="telepon" value=""> <img src="assets/editing.png" alt=""> <br><br>

                    <label for="alamat">Alamat :</label>
                    <input type="text"  id="alamat" name="alamat" value=""> <img src="assets/editing.png" alt=""> <br><br>

                    <label for="jenis_kelamin">Jenis Kelamin :</label>
                    <input type="radio" name="jenis_kelamin" value="laki-laki" /> Laki-laki</label>
                    <input type="radio" name="jenis_kelamin" value="perempuan" /> Perempuan</label> <br><br>

                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" value=""> <img src="assets/editing.png" alt=""> <br><br>

                    <label for="konpassword">Konfirmasi Password :</label>
                    <input type="password" id="konpassword" name="konpassword" value=""> <img src="assets/editing.png" alt=""> <br><br>

                    <input type="submit" value="Simpan Perubahan" onclick="konfirmasi()">
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
