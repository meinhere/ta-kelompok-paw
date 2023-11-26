<aside id="sidebar">
  <div class="sidebar-title">
    <div class="sidebar-brand">
      <img src="<?= BASEASSET; ?>/img/logo/white.png" alt="Logo Website" />
    </div>
    <span onclick="closeSidebar()"
      ><i class="fa fa-times"></i
    ></span>
  </div>

  <ul class="sidebar-list">
    <li class="sidebar-list-item <?= ($page=="customer") ? "active" : ""; ?>">
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
</aside>