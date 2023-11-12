<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <title>Daftar Pesanan</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="main-header">
            <h1>Detail Pesanan - <span>001</span></h1>
            <div class="search-bar">
                <input type="text" placeholder="Search products...">
            </div>
        </div>
        <h5>
            <a class="back" href="index.php">
                <-- Kembali</a>
        </h5>
        <div class="cetak">
            <a href="#">PDF</a>
            <a href="#">Excel</a>
        </div>

        <div class="main-menu">
            <div class="menu-edit">
                <div class="table-style">
                    <table>
                        <tr>
                            <th>Nama Makanan</th>
                            <th>Harga Makanan</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger with chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger without chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger with Extra chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger with Extra chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger with Extra chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="./assets/burger.png" width="50px" alt="Gambar Makanan">
                                Burger with Extra chesee
                            </td>
                            <td>Rp. <span>30.000</span></td>
                            <td>2</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>