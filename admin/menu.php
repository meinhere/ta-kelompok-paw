<?php 
$title = "Menu Makanan | Admin Dashboard";
$page = "menu";
include "templates/header.php";

require_once BASEPATH . "/data/menu.php";

if (isset($_GET['hapus'])) {
  $success = deleteMenu($_GET['hapus']);
}

$makanan = getAllMenu();
$no = 1;

?>

<main class="main-container">
  <div class="main-title">
    <h2>DATA MAKANAN</h2>
    <a href="kelola_menu.php" class="btn btn-blue">
      <i class="fa fa-plus"></i>
      Tambah
    </a>
    <?php 
        if (isset($success) && $success) {
            echo "<div class='form-success'>Data Berhasil DIhapus</div>";
            header("Refresh: 1; url=menu.php");
        }
    ?>
  </div>
  
  <div class="table-style">
    <table>
      <tr>
        <th>No</th>
        <th>Suplier</th>
        <th>Kategori</th>
        <th>Makanan</th>
        <th>Stok Produk</th>
        <th>Aksi</th>
      </tr>
      <?php foreach ($makanan as $row): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['NAMA_SUPPLIER']; ?></td>
        <td><?= $row['NAMA_KATEGORI']; ?></td>
        <td><?= $row['NAMA_MAKANAN']; ?></td>
        <td><?= $row['STOK_PRODUK']; ?></td>
        <td>
          <a href="kelola_menu.php?ubah=<?= $row['KODE_MAKANAN']; ?>" class="icon btn-yellow">
            <i class="fa fa-edit"></i>
          </a>
          <a href="?hapus=<?= $row['KODE_MAKANAN']; ?>" class="icon btn-red">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</main>