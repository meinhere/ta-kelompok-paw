<?php
$title = isset($_GET['tunda']) ? "Belum Bayar | Manager Dashboard" : "Sudah Bayar | Manager Dashboard";
$page = isset($_GET['tunda']) ? "bb" : "sb";
include "templates/header.php";

require_once BASEPATH . "/data/transaksi.php";

// Untuk filter 
if (isset($_POST['tahun'])) {
  $year = $_POST['tahun']; // mengambil tahun yang diinputkan dalam filter
  $month = $_POST['bulan']; // mengambil bulang yang diinputkan dalam filter
} else {
  $year = date("Y"); // mengambil tahun sekarang
  $month = date("m"); // mengambil bulan sekarang
}

$last_date = cal_days_in_month(CAL_GREGORIAN, $month, $year); // mengambil hari terakhir dalam bulan tsb
$total_harga = 0;
$label_chart = [];
$value_chart = [];

// Rekapan belum dibayar
if (isset($_GET['tunda'])) {
  // Untuk mengambil semua transaksi dalam satu bulan
  $transaksi = getAllOrdersByDate(0, "$year-$month-1", "$year-$month-$last_date");

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
  
  $transaksi = getAllOrdersByDateAndLimit(0, "$year-$month-1", "$year-$month-$last_date", $limit, $offset);
} else {
  $transaksi = getAllOrdersByDate(1, "$year-$month-1", "$year-$month-$last_date");

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

  $transaksi = getAllOrdersByDateAndLimit(1, "$year-$month-1", "$year-$month-$last_date", $limit, $offset);
}

$no = ($active_page * $limit) - $limit + 1;
$href = isset($_GET['tunda']) ? "?tunda&page=" : "?page="; // href untuk pagination
?>
<main class="main-container">
  <div class="main-title">
    <h2><?= isset($_GET['tunda']) ? "TRANSAKSI BELUM DIBAYAR" : "TRANSAKSI SUDAH DIBAYAR"; ?></h2>
  </div>

  <div class="filter-orders">
    <h3>Filter Transaksi</h3>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
      <div class="input-group">
        <label for="bulan">Bulan</label>
        <select class="select-box" name="bulan" id="bulan">
          <?php for($i = 1; $i <= 12; $i++) : ?>
          <?php $text = $i < 10 ? "0" . (string)$i : $i ?>
          <option value="<?= $text; ?>" <?= ($month == $text) ? "selected" : ""; ?>><?= date('F', mktime(0, 0, 0, $i, 1)); ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="input-group">
        <label for="tahun">Tahun</label>
        <select class="select-box" name="tahun" id="tahun">
            <?php for ($i = 0; $i < 4; $i++): ?>
              <?php $text = date('Y', strtotime("-$i year")); ?>
              <option value="<?= $text; ?>" <?= ($year == $text) ? "selected" : ""; ?> ><?= $text; ?></option>
            <?php endfor ?>
          </select>
      </div>
      
      <div class="input-group">
        <button class="btn btn-yellow" type="submit">Filter</button>
      </div>
    </form>
  </div>

  <div class="charts">
    <div class="charts-card">
      <h3 class="chart-title"><?= "Grafik Transaksi Bulan " . date('F', mktime(0, 0, 0, $month, 1)) ?></h3>
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
          <td><?= --$no; ?></td>
          <td><?= "Rp " . number_format($total_harga, 0, ',', '.');?></td>
        </tr>
      </table>
    </div>
</main>
<script src="<?= BASEURL; ?>/node_modules/chart.js/dist/chart.umd.js"></script>

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
