// ## VALIDATE FORM ##
const formInput = document.querySelectorAll(".form-input"); // ambil semua elemen dengan nama class form-input
var form = document.getElementById("myForm"); // ambil elemen dengan nama id myForm

// Set Default Checked in Radio Button Input
const payment = document.querySelector("#payment-1");
const bed = document.querySelector("#bed-type1");

payment.setAttribute("checked", "checked");
bed.setAttribute("checked", "checked");

// Set Default Value Date
const date = new Date(); // inisialisasi built-in function Date()
var year = date.getFullYear(); // ambil tahun sekarang
var month = date.getMonth() + 1; // ambil bulan sekarang (tambah 1 karena default bernilai = 0)
var day = date.getDate(); // ambil hari sekarang
month = month < 10 ? "0" + month : month; // apabila month < 10 maka tambahi "0" (untuk memenuhi format)
day = day < 10 ? "0" + day : day; // apabila day < 10 maka tambahi "0" (untuk memenuhi format)

var fullDate = `${year}-${month}-${day}`; // gabung tahun-bulan-hari (format input type date)
document.querySelector("#check-in").setAttribute("value", fullDate); // Set value elemen dengan nama id check-in

// Function Validate
function validate() {
  var hasError = false; // set hasError = false

  // ulang semua elemen formInput menjadi variabel input
  formInput.forEach(function (input) {
    var inputName = input.id; // ambil attribute id dari setiap input
    var pesanError = input.nextElementSibling; // ambil elemen selanjutnya dari input (untuk pesanError)

    // Validasi Tanggal
    // Untuk Check-in dan Check-out
    if (inputName == "check-in" || inputName == "check-out") {
      var dateNow = new Date(fullDate).getTime(); // ambil waktu (int) sekarang
      var dateReserved = new Date(input.value).getTime(); // ambil waktu (int) tanggal check-in dan check-out

      // jika inputan tidak kosong
      if (input.value != "") {
        // jika tanggal dari check-in atau checkout < tanggal sekarang
        if (dateReserved < dateNow) {
          pesanError.innerHTML = "Tanggal tidak valid";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Tanggal harus diisi";
      }
    }
    // Untuk Check-out
    if (inputName == "check-out") {
      var dateCheckIn = new Date(
        document.querySelector("#check-in").value
      ).getTime(); // ambil tanggal check-in
      var dateCheckOut = new Date(
        document.querySelector("#check-out").value
      ).getTime(); // ambil tanggal check-out

      // Apabila tanggal check-in lebih dari check-out
      if (dateCheckIn > dateCheckOut) {
        pesanError.innerHTML = "Tanggal check-out tidak valid";
      }
    }

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

    // Validasi Email
    if (inputName == "email") {
      var emailPattern = /^[\S]+@[^\.][\S]+\.[\S]+$/; // format email

      // jika inputan tidak kosong
      if (input.value != "") {
        if (!emailPattern.test(input.value)) {
          pesanError.innerHTML = "Email tidak valid";
        } else if (input.value.length > 50) {
          pesanError.innerHTML = "Email terlalu panjang";
        } else {
          pesanError.innerHTML = "";
        }
      } else {
        pesanError.innerHTML = "Field tidak boleh kosong!!";
      }
    }

    // Validasi Nomor Telepon
    if (inputName == "telepon") {
      var teleponPattern = /^[\d]+$/; // value harus angka

      // jika inputan tidak kosong
      if (input.value != "") {
        if (!teleponPattern.test(input.value)) {
          pesanError.innerHTML = "Nomor telepon harus berupa angka";
        } else if (input.value.length < 10 || input.value.length > 12) {
          pesanError.innerHTML = "Digit nomor terlalu pendek/panjang";
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
    form.submit(); // submit form
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

  // Apabila type input adalah date
  if (type == "date") {
    // maka akan memanggil fungsi validate() ketika event change
    input.addEventListener("change", function () {
      validate();
    });
  }
});
