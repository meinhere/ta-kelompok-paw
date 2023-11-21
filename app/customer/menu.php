<?php
$title = "Menu | JapanFoods";
$page = "menu";

session_start();

var_dump($_SESSION);
?>
<?php include "templates/header.php" ?>
<nav class="side-nav">
  <ul class="nav-links">
    <li class="active"><a href="#">All</a></li>
    <li><a href="#">Ramen</a></li>
    <li><a href="#">Sushi</a></li>
    <li><a href="#">Onigiri</a></li>
    <li><a href="#">Udon</a></li>
    <li><a href="#">Sashimi</a></li>
  </ul>
</nav>
<div class="content">
  <!-- Navbar Include -->
  <?php include "templates/navbar.php" ?>

  <div class="main-menu">
    <div class="menu-list">
      <div class="description">
        <p>Menyediakan semua jenis makanan jepang</p>
      </div>
      <div class="menu">
        <div class="menu-card">
          <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar" />
          <h3>15000</h3>
          <div class="desc-item">
            <h4>Shoyu Ramen</h4>
            <p>Stok : 12</p>
          </div>
          <button class="menu-btn">+</button>
        </div>
        <div class="menu-card">
          <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="Gambar" />
          <h3>15000</h3>
          <div class="desc-item">
            <h4>Shoyu Ramen</h4>
            <p>Stok : 12</p>
          </div>
          <button class="menu-btn">+</button>
        </div>
        <div class="menu-card">
          <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" />
          <h3>15000</h3>
          <div class="desc-item">
            <h4>Shoyu Ramen</h4>
            <p>Stok : 12</p>
          </div>
          <button class="menu-btn">+</button>
        </div>
        <div class="menu-card">
          <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" />
          <h3>15000</h3>
          <div class="desc-item">
            <h4>Shoyu Ramen</h4>
            <p>Stok : 12</p>
          </div>
          <button class="menu-btn">+</button>
        </div>
        <div class="menu-card">
          <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" />
          <h3>15000</h3>
          <div class="desc-item">
            <h4>Shoyu Ramen</h4>
            <p>Stok : 12</p>
          </div>
          <button class="menu-btn">+</button>
        </div>
      </div>
    </div>
    <div class="carts">
      <div class="carts-detail">
        <h3>Keranjang Belanja</h3>
        <div class="carts-inner">
          <div class="carts-item">
            <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" class="image" />
            <div class="detail">
              <h5>Shoyu Ramen</h5>
              <div class="action">
                <a href="" class="min">-</a>
                <small>1</small>
                <a href="" class="plus">+</a>
                <a href="" class="remove">Hapus</a>
              </div>
            </div>
            <h2 class="price">5000</h2>
          </div>
          <div class="carts-item">
            <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" class="image" />
            <div class="detail">
              <h5>Shoyu Ramen</h5>
              <div class="action">
                <a href="" class="min">-</a>
                <small>1</small>
                <a href="" class="plus">+</a>
                <a href="" class="remove">Hapus</a>
              </div>
            </div>
            <h2 class="price">5000</h2>
          </div>
          <div class="carts-item">
            <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" class="image" />
            <div class="detail">
              <h5>Shoyu Ramen</h5>
              <div class="action">
                <a href="" class="min">-</a>
                <small>1</small>
                <a href="" class="plus">+</a>
                <a href="" class="remove">Hapus</a>
              </div>
            </div>
            <h2 class="price">5000</h2>
          </div>
          <div class="carts-item">
            <img src="<?= BASEURL; ?>/assets/img/burger.png" alt="" class="image" />
            <div class="detail">
              <h5>Shoyu Ramen</h5>
              <div class="action">
                <a href="" class="min">-</a>
                <small>1</small>
                <a href="" class="plus">+</a>
                <a href="" class="remove">Hapus</a>
              </div>
            </div>
            <h2 class="price">5000</h2>
          </div>
        </div>
        <div class="order">
          <div class="order-detail" id="qty">
            <p>0 barang</p>
            <p>Banyak : <span>0</span></p>
          </div>
          <div class="order-detail" id="subtotal">
            <p>Subtotal</p>
            <span>0</span>
          </div>
          <div class="order-detail" id="tax">
            <p>Ongkir</p>
            <span>0</span>
          </div>
          <div class="order-detail" id="total">
            <h3>Total</h3>
            <span>0</span>
          </div>
        </div>
        <div class="order-submit">
          <button class="order-btn reset">Hapus Semua</button>
          <button class="order-btn order">Pesan</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "templates/footer.php" ?>