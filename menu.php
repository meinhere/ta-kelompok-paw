<?php 
$title = "Menu | JapanFoods";
$page = "menu";
include "templates/header.php";

require_once "data/menu.php";
if (isset($_POST['tambah'])) insertCarts($_POST['kode_makanan']); // tambah makanan pada keranjang
if (isset($_GET['del'])) deleteCartsByKode($_GET['del']); // hapus makanan berdasarkan kode 
if (isset($_POST['reset'])) deleteAllCarts(); // hapus semua makanan pada keranjang
if (isset($_POST['min'])) editCarts($_POST); // edit makanan pada keranjang
if (isset($_POST['plus'])) editCarts($_POST); // edit makanan pada keranjang
if (isset($_POST['order'])) insertOrders($_POST); // tambah makanan pada pesanan

$makanan = isset($_GET['kat']) ? getAllMenuByCategory($_GET['kat']) : getAllMenu();
$keranjang = getAllCarts();
$kolom = array_column($keranjang, "KODE_MAKANAN");
$subTotal = 0;
$banyakBarang = 0;
?>
<!-- Menu Page Start -->
<div class="menu-page">
  <!--  Side Nav Start -->
  <nav class="side-nav">
    <ul class="nav-links">
      <li class="<?= isset($_GET['kat']) ? "" : "active"; ?>"><a href="menu.php">All</a></li>
      <li class="<?= isset($_GET['kat']) && $_GET['kat'] == "ramen" ? "active" : ""; ?>"><a href="menu.php?kat=ramen">Ramen</a></li>
      <li class="<?= isset($_GET['kat']) && $_GET['kat'] == "sushi" ? "active" : ""; ?>"><a href="menu.php?kat=sushi">Sushi</a></li>
      <li class="<?= isset($_GET['kat']) && $_GET['kat'] == "onigiri" ? "active" : ""; ?>"><a href="menu.php?kat=onigiri">Onigiri</a></li>
      <li class="<?= isset($_GET['kat']) && $_GET['kat'] == "udon" ? "active" : ""; ?>"><a href="menu.php?kat=udon">Udon</a></li>
      <li class="<?= isset($_GET['kat']) && $_GET['kat'] == "sashimi" ? "active" : ""; ?>"><a href="menu.php?kat=sashimi">Sashimi</a></li>
    </ul>
  </nav>
  <!-- Side Nav End -->

  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Include -->
    <?php include "templates/navbar.php" ?>

    <!-- Main Menu Start -->
    <div class="main-menu">
      <!-- Menu List Start -->
      <div class="menu-list">
        <div class="description">
          <p>Menyediakan semua jenis makanan jepang</p>
        </div>
        <!-- Menu Start -->
        <div class="menu">
          <?php foreach($makanan as $row) : ?>
          <div class="menu-card">
            <img src="<?= BASEASSET . "/img/menu/" . $row['NAMA_KATEGORI'] . "/" . $row['GAMBAR_MAKANAN']; ?>" alt="<?= $row['NAMA_MAKANAN']; ?>" />
            <h3><?= "Rp " . number_format($row["HARGA_MAKANAN"], 0, ',', '.');?></h3>
            <div class="desc-item">
              <h4><?= $row['NAMA_MAKANAN']; ?></h4>
              <p>Stok : <?= $row['STOK_PRODUK']; ?></p>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
              <input type="hidden" name="kode_makanan" value="<?= $row['KODE_MAKANAN']; ?>">

              <?php if(!in_array($row['KODE_MAKANAN'], $kolom)) : ?>
              <button class="menu-btn" type="submit" name="tambah">+</button>
              <?php else: ?>
              <span class="menu-btn check"><i class="fa fa-check"></i></span>
              <?php endif ?>
            </form>
          </div>
          <?php endforeach; ?>
        </div>
        <!-- Menu End -->
      </div>
      <!-- Menu List End -->
      
      <!-- Carts Start -->
      <div class="carts">
        <div class="carts-detail">
          <h3>Keranjang Belanja</h3>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <!-- Carts Inner Start  -->
            <div class="carts-inner">
              <?php if(empty($keranjang)): ?>
                <h4 class="empty-carts">Keranjang Masih Kosong</h4>
              <?php else: ?>
                <?php foreach ($keranjang as $row) : ?>
                <div class="carts-item">
                  <input type="hidden" name="kode_makanan[]" value="<?= $row['KODE_MAKANAN']; ?>">
                  <input type="hidden" name="qty[]" value="<?= $row['QTY']; ?>">
                  <input type="hidden" name="harga_makanan[]" value="<?= $row['HARGA_MAKANAN']; ?>">

                  <img src="<?= BASEASSET . "/img/menu/" . $row['NAMA_KATEGORI'] . "/" . $row['GAMBAR_MAKANAN']; ?>" alt="<?= $row['NAMA_MAKANAN']; ?>" class="image" />
                  <div class="detail">
                    <h5><?= $row['NAMA_MAKANAN']; ?></h5>
                    <div class="action">
                      <button class="min" type="submit" name="min" value="<?= $row['KODE_MAKANAN']; ?>">-</button>
                      <span class="qty"><?= $row['QTY']; ?></span>
                      <button class="plus" type="submit" name="plus" value="<?= $row['KODE_MAKANAN']; ?>">+</button>
                      <a href="menu.php?del=<?= $row['KODE_MAKANAN']; ?>" class="remove">Hapus</a>
                    </div>
                  </div>
                  <h2 class="price"><?= "Rp " . number_format($row["HARGA_MAKANAN"], 0, ',', '.');?></h2>
                </div>
                <?php $banyakBarang += $row['QTY']; $subTotal += $row['QTY'] * $row['HARGA_MAKANAN']; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
            <!-- Carts Inner End -->

            <!-- Orders Start -->
            <div class="orders">
              <?php 
              $ongkir = 5 / 100 * $subTotal;
              $total = $subTotal + $ongkir;
              ?>
              <div class="orders-detail" id="qty">
                <p><?= count($keranjang); ?> barang</p>
                <p>Banyak : <span><?= $banyakBarang; ?></span></p>
              </div>
              <div class="orders-detail" id="subtotal">
                <p>Subtotal</p>
                <span><?= "Rp " . number_format($subTotal, 0, ',', '.');?></span>
              </div>
              <div class="orders-detail" id="tax">
                <p>Ongkir</p>
                <span><?= "Rp " . number_format($ongkir, 0, ',', '.');?></span>
              </div>
              <div class="orders-detail" id="total">
                <h3>Total</h3>
                <b><?= "Rp " . number_format($total, 0, ',', '.');?></b>
              </div>
            </div>
            <!-- Orders End -->

            <!-- Orders Submit Start -->
            <div class="orders-submit">
              <?php if($keranjang) : ?>
              <input type="hidden" name="total" value="<?= $total; ?>">
              <button class="btn btn-yellow-secondary reset" name="reset" type="submit">Hapus Semua</button>
              <button class="btn btn-yellow order" name="order" type="submit">Pesan</button>
              <?php endif; ?>
            </div>
            <!-- Orders Submit End -->
          </form>
        </div>
      </div>
      <!-- Carts End -->
    </div>
    <!-- Main Menu Start -->
  </div>
  <!-- Content End -->
</div>
<!-- Menu Page End -->
<?php include "templates/footer.php" ?>