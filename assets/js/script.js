// ## NAVBAR FIXED ##
// Ketika window/halaman di scroll
window.onscroll = function () {
  const navbar = document.querySelector(".navbar"); // ambil elemen dengan nama class navbar
  const fixedNav = navbar.offsetTop; // ambil jarak dari atas hingga elemen class navbar

  // Apabila jarak navbar bertambah (melebihi fixedNav)
  if (window.pageYOffset > fixedNav) {
    navbar.classList.add("navbar-fixed"); // tambah class navbar-fixed
  } else {
    navbar.classList.remove("navbar-fixed"); // hapus class navbar-fixed
  }
};

