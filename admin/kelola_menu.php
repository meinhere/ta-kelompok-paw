<?php 
$title = isset($_GET['ubah']) ? "Ubah Makanan" : "Tambah Makanan";
$title .= " | Admin Dashboard";
$page = "km";
include "templates/header.php";

require_once BASEPATH . "/libs/validate.php";
require_once BASEPATH . "/data/menu.php";
require_once BASEPATH . "/data/kategori.php";
require_once BASEPATH . "/data/supplier.php";

if (isset($_GET['ubah'])) {
  $makanan = getMenuByKode($_GET['ubah']);
} else {
  $makanan = [
    'KODE_MAKANAN' => '',
    'NAMA_MAKANAN' => '',
    'HARGA_MAKANAN' => '',
    'STOK_PRODUK' => '',
    'GAMBAR_MAKANAN' => '',
    'KODE_KATEGORI' => '',
    'NAMA_KATEGORI' => '',
    'ID_SUPPLIER' => '',
  ];
}
$kategori = getAllCategory();
$supplier = getAllSupplier();

if (isset($_POST['ubah'])) {
  $errors = validateMenu($errors, $_POST, $_FILES);

  if (empty($errors)) $success = editMenu($_POST, $_FILES);
} else if (isset($_POST['tambah'])){
  $errors = validateMenu($errors, $_POST, $_FILES);

  if (empty($errors)) $success = insertMenu($_POST, $_FILES);
}
?>

<!-- Main -->
<main class="main-container">
  <div class="main-title">
    <h2><?= isset($_GET['ubah']) ? "Ubah Data Makanan" : "Tambah Data Makanan"; ?></h2>
    <?php 
        if (isset($success) && $success) {
            echo "<div class='form-success'>Data Berhasil $success</div>";
            header("Refresh: 1; url=menu.php");
        }
    ?>
  </div>

  <div class="form-content">
    <form action="<?= $_SERVER['PHP_SELF'] . (isset($_GET['ubah']) ? '?ubah=' . $_GET['ubah'] : '') ; ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="gambarLama" value="<?= $makanan['GAMBAR_MAKANAN']; ?>">
      <input type="hidden" name="kodeMakanan" value="<?= $makanan['KODE_MAKANAN']; ?>">
      <div class="input-group">
          <label for="nama">Nama Makanan</label>
          <div class="err-group">
              <input type="text" id="nama" name="nama" value="<?= $_POST['nama'] ?? $makanan['NAMA_MAKANAN']; ?>">
              <span class="errForm"><?= ($errors['nameErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="harga">Harga Makanan</label>
          <div class="err-group">
              <input type="text" id="harga" name="harga" value="<?= $_POST['harga'] ?? $makanan['HARGA_MAKANAN']; ?>">
              <span class="errForm"><?= ($errors['hargaErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="stok">Stok Produk</label>
          <div class="err-group">
              <input type="text" id="stok" name="stok" value="<?= $_POST['stok'] ?? $makanan['STOK_PRODUK']; ?>">
              <span class="errForm"><?= ($errors['stokErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="gambar">Gambar Produk</label>
          <div class="err-group">
              <input type="file" id="gambar" name="gambar" data-path="<?= $makanan['NAMA_KATEGORI'] . "/" . $makanan['GAMBAR_MAKANAN']; ?>" onchange="previewImg()">
              <span class="errForm"><?= ($errors['gambarErr'] ?? ''); ?></span>
          </div>
      </div>
      <div class="input-group">
          <label for="kategori">Kategori Makanan</label>
          <div class="err-group">
            <select name="kategori" id="kategori">
              <?php foreach ($kategori as $row): ?>
                <option value="<?= $row['KODE_KATEGORI']; ?>" <?= ($_POST['kategori'] ?? $makanan['KODE_KATEGORI']) == $row['KODE_KATEGORI'] ? "selected" : ""; ?>><?= $row['NAMA_KATEGORI']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>
      <div class="input-group">
          <label for="supplier">Supplier Makanan</label>
          <div class="err-group">
            <select name="supplier" id="supplier">
            <?php foreach ($supplier as $row): ?>
                <option value="<?= $row['ID_SUPPLIER']; ?>" <?= ($_POST['supplier'] ?? $makanan['ID_SUPPLIER']) == $row['ID_SUPPLIER'] ? "selected" : ""; ?>><?= $row['NAMA_SUPPLIER']; ?></option>
              <?php endforeach; ?>
            </select>
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
        <a href="menu.php" class="btn btn-red"> 
          <i class="fa fa-times"></i>
          Batal
        </a>
      </div>
    </form>

    <div class="file-prev">
      <?php $path = $makanan['GAMBAR_MAKANAN'] ? BASEASSET . '/img/menu/' . $makanan['NAMA_KATEGORI'] . '/' . $makanan['GAMBAR_MAKANAN'] : BASEASSET . '/img/menu/no-image.png' ?>
      <h3>Tampilan Gambar</h3>
      <img src="<?= $path ?>" class="img-prev" alt="Gambar Makanan" style="width: 200px;">
    </div>
  </div>
</main>
<!-- End Main -->

<script>
  function previewImg() {
    const gambar = document.querySelector('#gambar');
    const gambarMakanan = document.querySelector('.img-prev');

    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);

    fileGambar.onload = function(e) {
      gambarMakanan.src = e.target.result;
    }
  }
</script>
<?php include "templates/footer.php" ?>