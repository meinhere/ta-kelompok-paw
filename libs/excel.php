<!-- export excel -->
<?php
header("Content-type: application/vnd-ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan Pesanan.xls");
?>

<?php
session_start();
require_once "../config/url.php";
require_once BASEPATH . "/data/transaksi.php";
$orders = getAllOrdersDetail($_GET['id']);
?>

<section id="content-main">
	<div class="content-main-container">
		<h1>DETIL PESANAN - <?= $_GET['id'] ?> </h1>
		<div id="cetak" class="form-add-product">
			<div class="table-style">
				<table>
					<tr>
						<th>NAMA MAKANAN</th>
						<th>HARGA PRODUK</th>
						<th>JUMLAH</th>
					</tr>

					<?php foreach ($orders as $row) : ?>
						<tr>
							<td><?= ucwords($row['NAMA_MAKANAN']) ?></td>
							<td><?= "Rp " . number_format($row['HARGA_MAKANAN'], 0, ',', '.') ?></td>
							<td><?= $row['QTY'] ?></td>
						</tr>
					<?php
					endforeach
					?>
				</table>
			</div>
		</div>
	</div>
</section>