<?php 
$title = "Supplier Makanan | Admin Dashboard";
$page = "sup";
include "templates/header.php";

require_once BASEPATH . "/data/supplier.php";

if (isset($_GET['hapus'])) {
  $success = deleteSupplier($_GET['hapus']);
}

// Mengatur Pagination
$supplier = getAllSupplier();
$total_supplier = count($supplier);
$limit = 10;
$total_page = ceil($total_supplier / $limit);
$active_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($active_page > 1) ? ($active_page * $limit) - $limit : 0;

$supplier = getAllSupplierByLimit($limit, $offset);
$no = ($active_page * $limit) - $limit + 1;
?>
<!-- Main Start -->
<main class="main-container">
  <div class="main-title">
    <h2>DATA SUPPLIER</h2>

    <!-- Success Alert -->
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

  <!-- Pagination View -->
  <?php pagination($total_page, $active_page) ?>
  
  <!-- Table Start -->
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
  <!-- Table End -->
</main>
<!-- Main End -->
<?php include "templates/footer.php" ?>
