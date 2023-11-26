<?php 
$title = "Customer | Admin Dashboard";
$page = "customer";
include "templates/header.php";

require_once BASEPATH . "/data/pelanggan.php";
$pelanggan = getAllCustomer();
$no = 1;
?>
<!-- Main -->
<main class="main-container">
  <div class="main-title">
    <h2>DATA CUSTOMER</h2>
  </div>

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
<!-- End Main -->
<?php include "templates/footer.php" ?>