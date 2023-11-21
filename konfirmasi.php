<?php 
$title = "Konfirmasi Pembayaran | JapanFoods";
$page = "konfpem";

include "data/transaksi.php";
$id = $_GET['id'];
if (isset($_POST['pay'])) editOrders($id, $_POST);

$ordersDetail = getAllOrdersDetail($id);
$no = 1;
$subTotal = 0;
?>
<?php include "templates/header.php" ?>
<?php include "templates/navbar.php" ?>
<div class="content">
  <div class="konfirmasi-bayar-page">
    <form action="" method="post">
      <div class="header">
        <h1>Konfirmasi Pembayaran - <?= $id; ?></h1>
        <div class="action">
          <div>
            <a class="back" href="pesanan.php"><-- Kembali</a>
          </div>
          <div>
            <h3>Pilih metode Pembayaran</h3>
            <select name="metode_bayar" id="metode_bayar">
              <option value="Cash">Cash</option>
              <option value="Transfer BRI">Transfer BRI</option>
              <option value="Transfer BCA">Transfer BCA</option>
            </select>
            <button class="btn btn-yellow bayar" type="submit" name="pay">Bayar</button>
          </div>
        </div>
      </div>
      <div class="table-style konfirmasi-bayar">
        <table>
          <tr>
            <th>No</th>
            <th>Nama Makanan</th>
            <th>Edit Pesanan</th>
            <th>Harga Makanan</th>
            <th>SubTotal</th>
          </tr>
          <?php if(empty($ordersDetail)): ?>
            <tr>
              <td colspan="5" class="empty-orders">Tidak ada Pesanan</td>
            </tr>
          <?php else: ?>
            <?php foreach ($ordersDetail as $row): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['NAMA_MAKANAN']; ?></td>
              <td class="action" id="konfirmasi-action">
                <input type="text" value="<?= $row['QTY']; ?>" data-stok="<?= $row['STOK_PRODUK']; ?>" name="qty[]" class="qty" readonly>
                <input type="hidden" name="kode_makanan[]" value="<?= $row['KODE_MAKANAN']; ?>">
                <input type="hidden" name="sisa_stok[]" value="<?= $row['STOK_PRODUK'] - $row['QTY']; ?>">
              </td>
              <td><?= "Rp " . number_format($row["HARGA_MAKANAN"], 0, ',', '.');?></td>
              <?php $hargaBaru = $row['QTY'] * $row['HARGA_MAKANAN']; $subTotal += $hargaBaru; ?>
              <td><?= "Rp " . number_format($hargaBaru, 0, ',', '.');?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php 
            $ongkir = 5 / 100 * $subTotal;
            $total = $subTotal + $ongkir;
          ?>
          <tr>
            <th colspan="4">Ongkos Kirim</th>
            <td><?= "Rp " . number_format($ongkir, 0, ',', '.');?></td>
          </tr>
          <tr>
            <th colspan="4">Total Bayar</th>
            <td><b><?= "Rp " . number_format($total, 0, ',', '.');?></b></td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</div>
<?php include "templates/footer.php" ?>