<?php 
$title = isset($_GET['ubah']) ? "Ubah Supplier" : "Tambah Supplier";
$title .= " | Admin Dashboard";
$page = "ks";
include "templates/header.php";

require_once BASEPATH . "/libs/validate.php";
require_once BASEPATH . "/data/supplier.php";
if (isset($_GET['ubah'])) {
  $supplier = getSupplierById($_GET['ubah']);
} else {
  $supplier = [
    'NAMA_SUPPLIER' => '',
    'NO_TELP_SUPPLIER' => '',
    'ALAMAT_SUPPLIER' => '',
  ];
}

if (isset($_POST['ubah'])) {
  $errors = validateSupplier($errors, $_POST);
  if (empty($errors)) $success = editSupplier($_POST);
} else if (isset($_POST['tambah'])){
  $errors = validateSupplier($errors, $_POST);
  
  if (empty($errors)) $success = insertSupplier($_POST);
} 
?>
<!-- Main -->
<main class="main-container">
  <div class="main-title">
    <h2><?= isset($_GET['ubah']) ? "Ubah Data Supplier" : "Tambah Data Supplier"; ?></h2>
  </div>

  <div class="form-content">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <?php 
          if (isset($success) && $success) {
              echo "<div class='form-success'>Data Berhasil Diubah</div>";
              header("Refresh: 1; url=supplier.php");
          }
      ?>
      <input type="hidden" name="id_supplier" value="<?= $_GET['ubah'] ?? ""; ?>">
      <div class="input-group">
          <label for="nama">Nama Supplier</label>
          <div class="err-group">
              <input type="text" id="nama" name="nama" value="<?= $_POST['nama'] ?? $supplier['NAMA_SUPPLIER']; ?>">
              <span class="errForm"><?= ($errors['nameErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="nohp">No Telepon</label>
          <div class="err-group">
              <input type="text" id="nohp" name="nohp" value="<?= $_POST['nohp'] ?? $supplier['NO_TELP_SUPPLIER']; ?>">
              <span class="errForm"><?= ($errors['nohpErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="alamat">Alamat</label>
          <div class="err-group">
              <input type="text" id="alamat" name="alamat" value="<?= $_POST['alamat'] ?? $supplier['ALAMAT_SUPPLIER']; ?>">
              <span class="errForm"><?= ($errors['alamatErr'] ?? ''); ?></span>
          </div>
      </div>

      <div class="input-action">
        <?php if(isset($_GET['ubah'])): ?>
        <button type="submit" name="ubah" class="btn btn-blue"> 
          <i class="fa fa-floppy-o"></i>
          Simpan Perubahan
        </button>
        <?php else: ?>
        <button type="submit" name="tambah" class="btn btn-green"> 
          <i class="fa fa-send"></i>
          Tambah
        </button>
        <?php endif; ?>
        <a href="supplier.php" class="btn btn-red"> 
          <i class="fa fa-times"></i>
          Batal
        </a>
      </div>
    </form>
  </div>
</main>
<!-- End Main -->
<?php include "templates/footer.php" ?>