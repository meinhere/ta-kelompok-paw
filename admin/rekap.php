<?php
$title = isset($_GET['tunda']) ? "Belum Bayar | Manager Dashboard" : "Sudah Bayar | Manager Dashboard";
$page = isset($_GET['tunda']) ? "bb" : "sb";
include "templates/header.php";

require_once BASEPATH . "/data/transaksi.php";

// Untuk filter tanggal
if (isset($_GET['tanggal_mulai'])) {
  $tanggal_mulai = $_GET['tanggal_mulai']; // mengambil tanggal mulai yang diinputkan dalam filter
  $tanggal_akhir = $_GET['tanggal_akhir']; // mengambil tanggal akhir yang diinputkan dalam filter
} else {
  $tanggal_mulai = null;
  $tanggal_akhir = null;
}

$total_harga = 0;
$label_chart = [];
$value_chart = [];

// Rekapan belum dibayar
if (isset($_GET['tunda'])) {
  // Untuk mengambil semua transaksi dengan status 0 sesuai dengan tanggal_mulai dan tanggal_akhir
  $transaksi = getAllOrdersByDate(0, $tanggal_mulai, $tanggal_akhir);

  // Untuk mengambil tanggal transaksi per hari 
  foreach ($transaksi as $row) {
    $tanggal = explode(" ", $row['TANGGAL_PESAN'])[0]; // mengambil tanggal saja (tidak termasuk waktu)
    // jika hari tidak ada pada array label_chart tambahkan (tidak duplikat hari)
    if (!in_array($tanggal, $label_chart)) $label_chart[] = $tanggal; 
  }
  
  // Untuk mengambil total harga penjualan dalam hari tersebut
  foreach ($label_chart as $row) {
    $total = getSumTotalInOrders(0, $row); // mengambil hasil penjumlahan semua transaksi yang belum dibayar
    $total_harga += $total['TOTAL']; // menambahkan total ke dalam total_harga
    $value_chart[] = $total['TOTAL']; // menambah total ke dalam array value_chart
  }
  
  // Mengatur pagination
  $total_transaksi = count($transaksi);
  $limit = 8;
  $total_page = ceil($total_transaksi / $limit);
  $active_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;
  
  $transaksi = getAllOrdersByDateAndLimit(0, $tanggal_mulai, $tanggal_akhir, $limit, $offset);
} else {
  // Untuk mengambil semua transaksi dengan status 1 sesuai dengan tanggal_mulai dan tanggal_akhir
  $transaksi = getAllOrdersByDate(1, $tanggal_mulai, $tanggal_akhir);

  // Untuk mengambil tanggal transaksi per hari 
  foreach ($transaksi as $row) {
    $tanggal = explode(" ", $row['TANGGAL_PESAN'])[0]; // mengambil tanggal saja (tidak termasuk waktu)
    // jika hari tidak ada pada array label_chart tambahkan (tidak duplikat hari)
    if (!in_array($tanggal, $label_chart)) $label_chart[] = $tanggal;
  }

  // Untuk mengambil total harga penjualan dalam hari tersebut
  foreach ($label_chart as $row) {
    $total = getSumTotalInOrders(1, $row); // mengambil hasil penjumlahan semua transaksi yang belum dibayar
    $total_harga += $total['TOTAL']; // menambahkan total ke dalam total_harga
    $value_chart[] = $total['TOTAL']; // menambah total ke dalam array value_chart
  }

  // Mengatur pagination
  $total_transaksi = count($transaksi);
  $limit = 8;
  $total_page = ceil($total_transaksi / $limit);
  $active_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;

  $transaksi = getAllOrdersByDateAndLimit(1, $tanggal_mulai, $tanggal_akhir, $limit, $offset);
}

$no = ($active_page * $limit) - $limit + 1;

// href untuk pagination
if (isset($_GET['tunda'])) {
  $href = isset($_GET['tanggal_akhir']) ? "?tunda=1&tanggal_mulai=" . $_GET['tanggal_mulai'] . "&tanggal_akhir=" . $_GET['tanggal_akhir'] . "&page=" : "?tunda=1&page=";
} else {
  $href = isset($_GET['tanggal_akhir']) ? "?tanggal_mulai=" . $_GET['tanggal_mulai'] . "&tanggal_akhir=" . $_GET['tanggal_akhir'] . "&page=" : "?page=";
}
?>
<main class="main-container">
  <div class="main-title">
    <h2><?= isset($_GET['tunda']) ? "TRANSAKSI BELUM DIBAYAR" : "TRANSAKSI SUDAH DIBAYAR"; ?></h2>
  </div>

  <div class="filter-orders">
    <h3>Filter Transaksi</h3>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
      <input type="hidden" <?= isset($_GET['tunda']) ? "name='tunda' value='1'" : ""; ?>>
      <div class="input-group">
        <label>Dari</label>
        <input type="date" name="tanggal_mulai" value="<?= $_GET['tanggal_mulai'] ?? ''; ?>">
        </select>
      </div>
      <div class="input-group">
        <label>Sampai</label>
        <input type="date" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">
      </div>
      
      <div class="input-group">
        <button class="btn btn-blue" type="submit">Filter</button>
      </div>
    </form>
  </div>

  <div class="charts">
    <div class="charts-card">
      <h3 class="chart-title"><?= "Grafik Transaksi"?></h3>
      <canvas id="purchase-chart"></canvas>
    </div>

    <div class="table-style">
      <table>
        <tr>
          <th>No</th>
          <th>Pemesan</th>
          <th>Tanggal Pesan</th>
          <th>Total</th>
        </tr>

        <?php foreach ($transaksi as $row): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['NAMA_PELANGGAN']; ?></td>
          <td><?= $row['TANGGAL_PESAN']; ?></td>
          <td><?= "Rp " . number_format($row["TOTAL"], 0, ',', '.');?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <?php pagination($total_page, $active_page, $href) ?>
    </div>
  </div>
  
  <div class="table-style">
      <table>
        <tr>
          <th>Jumlah Transaksi</th>
          <th>Total Pendapatan</th>
        </tr>

        <tr>
          <td><?= $total_transaksi; ?></td>
          <td><?= "Rp " . number_format($total_harga, 0, ',', '.');?></td>
        </tr>
      </table>
    </div>
</main>
<script src="<?= BASEASSET; ?>/chart/dist/chart.umd.js"></script>

<script>
  const ctx1 = document.getElementById("purchase-chart").getContext('2d');

  let chart1 = new Chart(ctx1, {
      type: 'bar',
      data: {
          labels: <?= json_encode($label_chart) ?>,
          datasets: [{
              label: 'Total Harga',
              data: <?= json_encode($value_chart) ?>,
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
        }
      }
  });
</script>
<?php include "templates/footer.php" ?>
