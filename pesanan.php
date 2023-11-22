<?php 
$title = "Daftar Pesanan | JapanFoods";
$page = "dafpes";

include "data/transaksi.php";
$orders = getAllOrders();
?>
<?php include "templates/header.php" ?>  
<?php include "templates/navbar.php" ?>
<div class="content">
    <div class="pesanan-page">
        <div class="header">
            <h1>Daftar Pesanan Anda</h1>
        </div>
        <div class="table-style">
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal Pesan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($orders as $row): ?>
                <tr>
                    <td><?= $row['KODE_TRANSAKSI']; ?></td>
                    <td><?= $row['TANGGAL_PESAN']; ?></td>
                    <td><?= "Rp " . number_format($row["TOTAL"], 0, ',', '.');?></td>
                    <td><?= $row['STATUS'] == 0 ? "Belum Dibayar" : "Sudah Dibayar"; ?></td>
                    <td>
                        <?php if ($row['STATUS'] == 0): ?>
                            <a href="konfirmasi.php?id=<?= $row['KODE_TRANSAKSI']; ?>"><button class="btn btn-blue">Bayar Pesanan</button></a>
                        <?php else: ?>
                            <a href="detail_pesanan.php?id=<?= $row['KODE_TRANSAKSI']; ?>"><button class="btn btn-yellow">Detail Pesanan</button></a>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php include "templates/footer.php" ?>
