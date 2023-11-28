<aside id="sidebar">
  <div class="sidebar-title">
    <div class="sidebar-brand">
      <img src="<?= BASEASSET; ?>/img/logo/white.png" alt="Logo Website" />
    </div>
    <span onclick="closeSidebar()"
      ><i class="fa fa-times"></i
    ></span>
  </div>

  <?php if ($_SESSION['login'] == "admin"): ?>
  <ul class="sidebar-list">
    <li class="sidebar-list-item <?= ($page=="home") ? "active" : ""; ?>">
      <a href="index.php">
        <span><i class="fa fa-address-book"></i></span>
        Customer
      </a>
    </li>
    <li class="sidebar-list-item <?= ($page=="menu" || $page=="km") ? "active" : ""; ?>">
      <a href="menu.php">
        <span><i class="fa fa-cutlery"></i></span>
        Foods
      </a>
    </li>
    <li class="sidebar-list-item <?= ($page=="sup" || $page=="ks") ? "active" : ""; ?>">
      <a href="supplier.php">
        <span><i class="fa fa-archive"></i></span>
        Supplier
      </a>
    </li>
    <li class="sidebar-list-item">
      <a href="<?= BASEURL . "/logout.php"; ?>">
        <span><i class="fa fa-sign-out"></i></span>
        Logout
      </a>
    </li>
  </ul>
  <?php else : ?>
  <ul class="sidebar-list">
    <li class="sidebar-list-item <?= ($page=="home") ? "active" : ""; ?>">
      <a href="index.php">
        <span><i class="fa fa-server"></i></span>
        Transaksi
      </a>
    </li>
    <li class="sidebar-list-item <?= ($page=="sb") ? "active" : ""; ?>">
      <a href="rekap.php">
        <span><i class="fa fa-money"></i></span>
        Sudah Bayar
      </a>
    </li>
    <li class="sidebar-list-item <?= ($page=="bb") ? "active" : ""; ?>">
      <a href="rekap.php?tunda">
        <span><i class="fa fa-clock-o"></i></span>
        Belum Bayar
      </a>
    </li>
    <li class="sidebar-list-item">
      <a href="<?= BASEURL . "/logout.php"; ?>">
        <span><i class="fa fa-sign-out"></i></span>
        Logout
      </a>
    </li>
  </ul>
  <?php endif; ?>
</aside>