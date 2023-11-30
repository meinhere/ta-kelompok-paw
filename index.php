<?php 
$title = "Beranda | JapanFoods";
$page = "home";
include "templates/header.php";
?>
<div class="home-page">
  <!-- Header Start -->
  <header id="home">
    <!-- Navbar Include -->
    <?php include "templates/navbar.php" ?>

    <!-- Hero Start -->
    <div class="hero">
      <div class="content">
        <span class="title"> - Selamat Datang - </span>
        <h1>JapanFoods</h1>
        <p>Menyediakan makan-makan khas jepang</p>
      </div>
    </div>
    <!-- Hero End -->
  </header>
  <!-- Header End -->

  <!-- Description Content Start -->
  <div class="restorant">
    <div class="restorant-content">
      <div class="restorant-content-head">
        <img src="<?= BASEURL; ?>/assets/img/home/gambar1.jpg" alt="gambar 1" />
      </div>
      <div class="description-content-desc">
        <p>
          Selamat datang di tempat makan yang menghadirkan cita rasa otentik
          Jepang di setiap hidangan. Nikmati pengalaman kuliner yang memikat
          dan autentik dengan menu pilihan kami yang terinspirasi oleh tradisi
          masakan Jepang.
        </p>
        <p>
          Dengan bahan-bahan segar terbaik dan koki berbakat yang ahli dalam
          seni memasak Jepang, Restoran Sakura menawarkan hidangan sushi
          berkualitas tinggi, ramen lezat, dan berbagai hidangan khas Jepang
          lainnya yang memanjakan lidah Anda.
        </p>
        <p>
          Setiap suapannya membawa Anda dalam perjalanan kuliner ke Jepang,
          dengan sentuhan modern yang tetap mempertahankan esensi tradisional.
          Keindahan sajian kami mencerminkan kekayaan budaya dan kearifan
          kuliner Jepang.
        </p>
        <p>
          Kami memastikan cita rasa yang otentik dan kualitas yang tak
          tertandingi. Sushi sashimi kami disiapkan dengan hati-hati oleh koki
          berpengalaman, memastikan pengalaman makan yang tak terlupakan
          setiap kali Anda mengunjungi kami.
        </p>
        <p>
          Selain itu, nikmati hidangan ramen yang hangat dan lezat, dengan
          kuah yang kental dan mie yang kenyal. Penggunaan bumbu tradisional
          Jepang memberikan hidangan ini sentuhan istimewa yang membuatnya
          istimewa.
        </p>
        <p>
          Restoran kami juga menawarkan ruang santai dan atmosfer yang ramah,
          menciptakan suasana yang sempurna untuk berkumpul bersama keluarga
          dan teman. Staf kami yang ramah dan profesional siap melayani Anda
          dengan senyum hangat dan layanan terbaik. Dengan lokasi yang
          strategis dan jam operasional yang fleksibel, Restoran Sakura
          menjadi pilihan ideal untuk makan siang bersama rekan kerja, makan
          malam romantis, atau acara spesial lainnya.
        </p>
      </div>
    </div>
  </div>
  <!-- Description End  -->

  <!-- Kategori Start -->
  <div class="menu-selection" id="menu">
    <h1>Kategori Makanan</h1>

    <div class="category-menu">
      <a href="menu.php?kat=ramen">
        <div class="category-menu-list">
          <div class="category-menu-list-head">
            <img src="<?= BASEURL; ?>/assets/img/home/kategori1.jpg" alt="Kategori Ramen" />
          </div>
          <div class="category-menu-list-desc">
            <h3>Ramen</h3>
          </div>
        </div>
      </a>

      <a href="menu.php?kat=sushi">
        <div class="category-menu-list">
          <div class="category-menu-list-head">
            <img src="<?= BASEURL; ?>/assets/img/home/kategori2.jpg" alt="Kategori Sushi" />
          </div>
          <div class="category-menu-list-desc">
            <h3>Sushi</h3>
          </div>
        </div>
      </a>

      <a href="menu.php?kat=onigiri">
        <div class="category-menu-list">
          <div class="category-menu-list-head">
            <img src="<?= BASEURL; ?>/assets/img/home/kategori3.jpg" alt="Kategori Onigiri" />
          </div>
          <div class="category-menu-list-desc">
            <h3>Onigiri</h3>
          </div>
        </div>
      </a>

      <a href="menu.php?kat=udon">
        <div class="category-menu-list">
          <div class="category-menu-list-head">
            <img src="<?= BASEURL; ?>/assets/img/home/kategori4.jpg" alt="Kategori Udon" />
          </div>
          <div class="category-menu-list-desc">
            <h3>Udon</h3>
          </div>
        </div>
      </a>

      <a href="menu.php?kat=sashimi">
        <div class="category-menu-list">
          <div class="category-menu-list-head">
            <img src="<?= BASEURL; ?>/assets/img/home/kategori5.jpg" alt="Kategori Sashimi" />
          </div>
          <div class="category-menu-list-desc">
            <h3>Sashimi</h3>
          </div>
        </div>
      </a>
    </div>
  </div>
  <!-- Kategori End -->

  <!-- Footer Start -->
  <footer>
    <p>Kelompok E02 TA - Pemrograman Aplikasi Web</p>
    <p>Copyright &copy; 2023 - Dikembangkan oleh: Tim JapanFoods.</p>
  </footer>
  <!-- Footer End -->
</div>
<?php include "templates/footer.php" ?>