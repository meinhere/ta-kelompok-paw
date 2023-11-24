<?php 
$title = "Detail Pesanan | JapanFoods";
$page = "detpes";
include "templates/header.php";

require_once "data/transaksi.php";
$id = $_GET['id'];
$ordersDetail = getAllOrdersDetail($id);
$no = 1;
?>
<?php include "templates/navbar.php" ?>
<div class="content">
    <div class="detail-pesanan-page">
        <div class="header">
            <h1>Detail Pesanan - <?= $id; ?></h1>
            <a class="back" href="pesanan.php"><-- Kembali</a>
            <div class="report">
                <button onclick="window.print()" type="submit">PDF</button>
                <a href="#">Excel</a>
            </div>
        </div>
        <div class="table-style">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Harga Makanan</th>
                    <th>Jumlah</th>
                </tr>
                <?php foreach ($ordersDetail as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['NAMA_MAKANAN']; ?></td>
                    <td><?= "Rp " . number_format($row["HARGA_MAKANAN"], 0, ',', '.');?></td>
                    <td><?= $row['QTY']; ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
<?php include "templates/footer.php" ?>