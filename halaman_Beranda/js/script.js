// ## NAVBAR FIXED ##
// Ketika window/halaman di scroll
window.onscroll = function () {
  const menu = document.querySelector(".menu"); // ambil elemen dengan nama class menu
  const fixedNav = menu.offsetTop; // ambil jarak dari atas hingga elemen class menu

  // Apabila jarak menu bertambah (melebihi fixedNav)
  if (window.pageYOffset > fixedNav) {
    menu.classList.add("menu-fixed"); // tambah class menu-fixed
  } else {
    menu.classList.remove("menu-fixed"); // hapus class menu-fixed
  }
};

// ## SIDEBAR ##
const sidebarBtn = document.querySelector(".sidebar-btn span"); // ambil elemen span yang berada di child elemen class sidebar-btn
const sidebarContent = document.querySelector(".sidebar-content"); // ambil elemen dengan nama class sidebar-content

// Ketika tombol sidebar diclick
sidebarBtn.onclick = function () {
  // toggle = ketika ada -> hapus, ketika tidak ada -> tambah
  sidebarContent.classList.toggle("active"); // toggle class active
};

// Ketika sebuah document/halaman saat ini diclick
document.onclick = function (e) {
  // Apabila yang diclick bukan tombol sidebar dan content dari sidebar
  if (!sidebarBtn.contains(e.target) && !sidebarContent.contains(e.target)) {
    sidebarContent.classList.remove("active"); // hapus class active
  }
};

// ## HERO BACKGROUND CHANGE ##
var bg = document.querySelector(".hero"); // ambil elemen dengan nama class hero
var url = window.location.href; // ambil url dari halaman saat ini
var fileName = url.split(/(\\|\/)/g).pop(); // lakukan split sehingga mendapatkan nama file nya saja

// Apabila fileName nya form.html
if (fileName == "form.html") {
  bg.style.backgroundImage = "url(img/header2.jpg)"; // ubah style backgroundImage
} else if (fileName == "evaluation.html") {
  bg.style.backgroundImage = "url(img/header3.jpg)";
} else if (fileName == "about.html") {
  bg.style.backgroundImage = "url(img/header4.jpg)";
}

// ## MENU IN ACTIVE ##
const homeLink = document.querySelector(".home-link"); // ambil elemen dengan nama class home-link
const accomodationLink = document.querySelector(".accomodation-link"); // ambil elemen dengan nama class accomodation-link

// Apabila fileName index.html
if (fileName == "index.html") {
  homeLink.classList.add("active"); // tambah class active pada elemen homeLink
  accomodationLink.classList.remove("active"); // hapus class active pada elemen accomodationLink
} else if (fileName == "index.html#accomodation") {
  homeLink.classList.remove("active"); // hapus class active pada elemen homeLink
  accomodationLink.classList.add("active"); // tambah class active pada elemen accomodationLink
}

// Ketika homeLink diclick
homeLink.onclick = function () {
  homeLink.classList.add("active"); // tambah class active pada elemen homeLink
  accomodationLink.classList.remove("active"); // hapus class active pada elemen accomodationLink
};

// Ketika accomodationLink diclick
accomodationLink.onclick = function () {
  homeLink.classList.remove("active"); // hapus class active pada elemen homeLink
  accomodationLink.classList.add("active"); // tambah class active pada elemen accomodationLink
};
