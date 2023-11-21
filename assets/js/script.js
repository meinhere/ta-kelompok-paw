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

/**** Count Order Button Event ****/
// Button Plus
const btnPlusOrder = (e) => {
  let qty = e.value;
  let sisa_stok = e.parentElement.lastElementChild;
  const stok = e.dataset.stok;
  qty++;
  if (qty < stok && qty <= 10) e.value = qty;
  if (sisa_stok) sisa_stok.value = stok - qty;
};

// Button Minus
const btnMinusOrder = (e) => {
  let qty = e.value;
  let sisa_stok = e.parentElement.lastElementChild;
  const stok = e.dataset.stok;
  qty--;
  if (qty >= 1) e.value = qty;
  if (sisa_stok) sisa_stok.value = stok - qty;
};
