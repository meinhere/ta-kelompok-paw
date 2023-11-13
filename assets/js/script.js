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
const btnPlusOrder = (event) => {
  const countText = event.target.previousElementSibling;
  let count = event.target.previousElementSibling.firstChild.data;
  count = parseInt(count) + 1;
  countText.innerHTML = count;
};

// Button Minus
const btnMinusOrder = (event) => {
  const countText = event.target.nextElementSibling;
  let count = event.target.nextElementSibling.firstChild.data;
  count = parseInt(count);

  if (count > 1) {
    count = count - 1;
  }
  countText.innerHTML = count;
};
