// ## VALIDATE FORM ##
const formInput = document.querySelectorAll(".form-input"); // ambil semua elemen dengan nama class form-input
var form = document.getElementById("myForm"); // ambil elemen dengan nama id myForm

// Function Validate
function validate() {
  var hasError = false; // set hasError = false

  // ulang semua elemen formInput menjadi variabel input
  formInput.forEach(function (input) {
    var inputName = input.id; // ambil attribute id dari setiap input
    var pesanError = input.nextElementSibling; // ambil elemen selanjutnya dari input (untuk pesanError)

    // Validasi Nama Lengkap
    if (inputName == "nama") {
      var namaPattern = /^[\D]+$/; // value tidak boleh angka

      // jika inputan tidak kosong
      if (input.value != "") {
        // jika panjang inputan < 3 atau panjang inputan > 50
        if (input.value.length < 3 || input.value.length > 50) {
          pesanError.innerHTML = "Nama terlalu pendek/panjang";
        } else if (!namaPattern.test(input.value)) {
          pesanError.innerHTML = "Nama harus berisi huruf";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    // Validasi Nomom induk mahasiswa
    if (inputName == "nim") {
      var teleponPattern = /^[\d]+$/; // value harus angka

      // jika inputan tidak kosong
      if (input.value != "") {
        if (!teleponPattern.test(input.value)) {
          pesanError.innerHTML = "NIM harus berupa angka";
        } else if (input.value.length < 10 || input.value.length > 12) {
          pesanError.innerHTML = "Digit nomor terlalu pendek/panjang";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    // Validasi Nama kelompok
    if (inputName == "kelompok") {
      var namaPattern = /^[\D]+$/; // value tidak boleh angka

      // jika inputan tidak kosong
      if (input.value != "") {
        // jika panjang inputan < 3 atau panjang inputan > 50
        if (input.value.length < 3 || input.value.length > 50) {
          pesanError.innerHTML = "Nama kelompok terlalu pendek/panjang";
        } else if (!namaPattern.test(input.value)) {
          pesanError.innerHTML = "Nama kelompok harus berisi huruf";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    // Validasi Nama kelompok
    if (inputName == "judul") {
      var namaPattern = /^[\D]+$/; // value tidak boleh angka

      // jika inputan tidak kosong
      if (input.value != "") {
        // jika panjang inputan < 3 atau panjang inputan > 50
        if (input.value.length < 3 || input.value.length > 50) {
          pesanError.innerHTML = "Nama terlalu pendek/panjang";
        } else if (!namaPattern.test(input.value)) {
          pesanError.innerHTML = "Nama harus berisi huruf";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    // Validasi identitas kelompok
    if (inputName == "extra-service") {
      var namaPattern = /^[\D]+$/; // value tidak boleh angka

      // jika inputan tidak kosong
      if (input.value != "") {
        if (!namaPattern.test(input.value)) {
          pesanError.innerHTML = "Nama harus berisi huruf";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    if (pesanError.tagName == "SPAN") {
      if (pesanError.innerHTML == "") {
        input.style.border = "2px solid green";
      } else {
        hasError = true;
        input.style.border = "2px solid red";
      }
    }
  });

  return hasError;
}

// Form pada saat di submit
form.addEventListener("submit", function (e) {
  e.preventDefault(); // matikan fungsi default dari form (ketika submit tidak terjadi apa-apa)
  var hasError = validate(); // panggil fungsi validate()

  // apabila tidak ada error
  if (hasError == false) {
    form.submit(index.html); // submit form
  }
});

// Ketika inputan berubah
formInput.forEach(function (input) {
  var type = input.getAttribute("type"); // Ambil attribute type dari setiap elemen input

  // Apabila type input adalah text
  if (type == "text") {
    // maka akan memanggil fungsi validate() ketika event keyup
    input.addEventListener("keyup", function () {
      validate();
    });
  }
});
