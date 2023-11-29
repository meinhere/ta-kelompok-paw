<?php 
$title = "Home | Dashboard";
$page = "home";
include "templates/header.php";

require_once BASEPATH . "/data/pelanggan.php";
require_once BASEPATH . "/data/transaksi.php";

$pelanggan = getAllCustomer();
$total_pelanggan = count($pelanggan);
$limit = 10;
$total_page = ceil($total_pelanggan / $limit);
$active_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;

$pelanggan = getAllCustomerByLimit($limit, $offset);
$no = ($active_page * $limit) - $limit + 1;

$transaksi = getAllOrders();
$sudah_bayar = 0;
$belum_bayar = 0;
$label_bayar = [];
$label_tunda = [];
foreach ($transaksi as $row) {
  if ($row['STATUS'] == '1') {
    $sudah_bayar += 1;
    $tanggal = explode(" ", $row['TANGGAL_PESAN'])[0];
    if (!in_array($tanggal, $label_bayar)) $label_bayar[] = $tanggal;
  } else {
    $belum_bayar += 1;
    $tanggal = explode(" ", $row['TANGGAL_PESAN'])[0];
    if (!in_array($tanggal, $label_tunda)) $label_tunda[] = $tanggal;
  }
}

$value_bayar = [];
$value_tunda = [];
foreach ($label_bayar as $row) {
  $total = getSumTotalInOrders(1, $row);
  $value_bayar[] = $total['TOTAL'];
}
foreach ($label_tunda as $row) {
  $total = getSumTotalInOrders(0, $row);
  $value_tunda[] = $total['TOTAL'];
}
?>
<!-- Main -->
<?php if ($_SESSION['login'] == "admin"): ?>
<main class="main-container">
  <div class="main-title">
    <h2>DATA CUSTOMER</h2>
  </div>

  <?php pagination($total_page, $active_page) ?>

  <div class="table-style">
    <table>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Nama</th>
        <th>No Telp</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
      </tr>
      <?php foreach ($pelanggan as $row): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['USERNAME_PELANGGAN']; ?></td>
        <td><?= $row['NAMA_PELANGGAN']; ?></td>
        <td><?= $row['NO_TELP_PELANGGAN']; ?></td>
        <td><?= $row['ALAMAT_PELANGGAN']; ?></td>
        <td><?= $row['JENIS_KELAMIN']; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</main>
<?php else : ?>
<main class="main-container">
  <div class="main-title">
    <h2>CATATAN TRANSAKSI</h2>
  </div>

  <div class="main-cards">
    <div class="card">
      <div class="card-inner">
        <h3>SUDAH DIBAYAR</h3>
        <i class="fa fa-archive" aria-hidden="true"></i>
      </div>
      <h1><?= $sudah_bayar; ?></h1>
    </div>

    <div class="card">
      <div class="card-inner">
        <h3>BELUM DIBAYAR</h3>
        <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
      </div>
      <h1><?= $belum_bayar; ?></h1>
    </div>
  </div>


  <div class="charts">
    <div class="charts-card">
      <h3 class="chart-title">Grafik Transaksi yang sudah Dibayar</h3>
      <canvas id="purchase-chart"></canvas>
    </div>
    <div class="charts-card">
      <h3 class="chart-title">Grafik Transaksi yang belum Dibayar</h3>
      <canvas id="pending-chart"></canvas>
    </div>
  </div>
</main>
<script src="<?= BASEURL; ?>/node_modules/chart.js/dist/chart.umd.js"></script>
<script>
  const ctx1 = document.getElementById("purchase-chart").getContext('2d');
  const ctx2 = document.getElementById("pending-chart").getContext('2d');

  let chart1 = new Chart(ctx1, {
      type: 'bar',
      data: {
          labels: <?= json_encode($label_bayar) ?>,
          datasets: [{
              label: 'Total Harga',
              data: <?= json_encode($value_bayar) ?>,
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

  let chart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
          labels: <?= json_encode($label_tunda) ?>,
          datasets: [{
              label: 'Total Harga',
              data: <?= json_encode($value_tunda) ?>,
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
<?php endif; ?>
<!-- End Main -->
<?php include "templates/footer.php" ?>