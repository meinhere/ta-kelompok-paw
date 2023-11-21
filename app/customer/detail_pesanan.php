<?php
$title = "Detail Pesanan | JapanFoods";
$page = "detpes";
?>
<?php include "templates/header.php" ?>
<?php include "templates/navbar.php" ?>
<div class="content">
    <div class="detail-pesanan-page">
        <div class="header">
            <h1>Detail Pesanan - <span>001</span></h1>
            <a class="back" href="pesanan.php">
                <-- Kembali</a>
                    <div class="report">
                        <a href="#">PDF</a>
                        <a href="#">Excel</a>
                    </div>
        </div>
        <div class="table-style">
            <table>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Makanan</th>
                    <th>Harga Makanan</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar Makanan"></td>
                    <td>Burger with chesee</td>
                    <td>Rp. <span>30.000</span></td>
                    <td>2</td>
                </tr>

            </table>
        </div>
        <!-- <div class="table-style">
            <table>
                
            </table>
        </div> -->
    </div>
</div>
<?php include "templates/footer.php" ?>