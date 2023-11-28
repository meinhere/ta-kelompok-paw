<?php 
$title = "Supplier Makanan | Admin Dashboard";
$page = "sup";
include "templates/header.php";

require_once BASEPATH . "/data/supplier.php";

if (isset($_GET['hapus'])) {
  $success = deleteSupplier($_GET['hapus']);
}

$supplier = getAllSupplier();
$no = 1;
?>

<main class="main-container">
  <div class="main-title">
    <h2>DATA SUPPLIER</h2>

    <?php 
        if (isset($success) && $success) {
            echo "<div class='form-success'>Data Berhasil Dihapus</div>";
            header("Refresh: 1; url=supplier.php");
        }
    ?>

    <a href="kelola_supplier.php" class="btn btn-blue">
      <i class="fa fa-plus"></i>
      Tambah
    </a>
  </div>
  
  <div class="table-style">
    <table>
      <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>No Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
      <?php foreach ($supplier as $row): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['NAMA_SUPPLIER']; ?></td>
        <td><?= $row['NO_TELP_SUPPLIER']; ?></td>
        <td><?= $row['ALAMAT_SUPPLIER']; ?></td>
        <td>
          <a href="kelola_supplier.php?ubah=<?= $row['ID_SUPPLIER']; ?>" class="icon btn-yellow">
            <i class="fa fa-edit"></i>
          </a>
          <a href="?hapus=<?= $row['ID_SUPPLIER']; ?>" class="icon btn-red">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</main>
<?php include "templates/footer.php" ?>
