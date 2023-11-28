<?php 
$title = "Daftar Pesanan | JapanFoods";
$page = "dafpes";
include "templates/header.php";

require_once "data/transaksi.php";
$orders = getAllOrdersById();

$total_transaksi = count($orders);
$limit = 10;
$total_page = ceil($total_transaksi / $limit);
$active_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;

$orders = getAllOrdersByIdAndLimit($limit, $offset);
$no = ($active_page * $limit) - $limit + 1;
?>
<?php include "templates/navbar.php" ?>
<div class="content">
    <div class="pesanan-page">
        <div class="header">
            <h1>Daftar Pesanan Anda</h1>
        </div>
        <div class="table-style">
            <table>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pesan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($orders as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
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
        <div class="pagination">
            <ul>
                <li>
                    <a class="primary-btn" href="?page=<?= ($active_page > 1) ? $active_page - 1 : $active_page ?>">Prev</a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                    <?php if ($i == $active_page) : ?>
                        <li>    
                            <a class="primary-btn active"><?= $i ?></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a class="primary-btn" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <li>
                    <a class="primary-btn" href="?page=<?= $active_page < $total_page ? $active_page + 1 : $active_page ?>">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php include "templates/footer.php" ?>
