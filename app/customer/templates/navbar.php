<nav class="navbar">
  <a href="#" class="navbar-logo">
    <img src="<?= BASEURL; ?>/assets/img/logo.png" alt="Logo Website" />
  </a>
  <div class="navbar-nav">
    <a href="index.php" class="<?= ($page=="home") ? "active" : ""; ?>">Beranda</a>
    <a href="menu.php" class="<?= ($page=="menu") ? "active" : ""; ?>">Menu</a>
    <a href="pesanan.php" class="<?= ($page=="dafpes" || $page=="detpes" || $page=="konfpem") ? "active" : ""; ?>">Daftar Pesanan</a>
    <a href="edit_profil.php"><img src="<?= BASEURL; ?>/assets/img/user.png" alt="Logo Akun" /></a>
  </div>
</nav>