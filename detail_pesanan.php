<?php 
$title = "Detail Pesanan | JapanFoods";
$page = "detpes";
include "templates/header.php";

require_once "data/transaksi.php";
$id = $_GET['id'];
$ordersDetail = getAllOrdersDetail($id);

// Mengatur Pagination
$total_transaksi = count($ordersDetail);
$limit = 8;
$total_page = ceil($total_transaksi / $limit);
$active_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;
$ordersDetail = getAllOrdersDetailByLimit($id, $limit, $offset);
$no = ($active_page * $limit) - $limit + 1;

?>
<?php include "templates/navbar.php" ?>
<div class="content">
    <div class="detail-pesanan-page">
        <div class="header">
            <h1>Detail Pesanan - <?= $id; ?></h1>
            <a class="back" href="pesanan.php">&laquo; Kembali</a>
            <div class="report">
                <button onclick="window.print()" type="submit">PDF</button>
                <a href="<?= BASEURL . "/libs/excel.php?id=" . $_GET['id']; ?>">Excel</a>
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
        <div class="pagination">
            <ul>
                <li>
                    <a class="primary-btn" href="?id=<?= $id; ?>&page=<?= ($active_page > 1) ? $active_page - 1 : $active_page ?>">Prev</a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                    <?php if ($i == $active_page) : ?>
                        <li>    
                            <a class="primary-btn active"><?= $i ?></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a class="primary-btn" href="?id=<?= $id; ?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <li>
                    <a class="primary-btn" href="?id=<?= $id; ?>&page=<?= $active_page < $total_page ? $active_page + 1 : $active_page ?>">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php include "templates/footer.php" ?>