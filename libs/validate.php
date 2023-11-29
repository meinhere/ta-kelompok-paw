<?php 
require_once BASEPATH . "/data/connection.php";

// ----- Pengecekan isi inputan saat Login -----
// cek username pelanggan
function checkUsernameCustomer($username) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    // cek baris yang dikembalikan > 0 dan sesuai regex untuk username tidak
    return $statement->rowCount() > 0 && preg_match("/^[a-z0-9_]+$/", $username); 
}
// cek username karyawan
function checkUsernameEmployee($username) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    // cek baris yang dikembalikan > 0 dan sesuai regex untuk username tidak
    return $statement->rowCount() > 0 && preg_match("/^[a-z0-9_]+$/", $username);
}
// cek password pelanggan
function checkPasswordCustomer($username, $password) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username AND PASSWORD_PELANGGAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_pelanggan'] = $data['ID_PELANGGAN']; // jika data tidak kosong buat session untuk id_pelanggan
    return $statement->rowCount() > 0;
}
// cek password karyawan
function checkPasswordEmployee($username, $password) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username AND PASSWORD_KARYAWAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_karyawan'] = $data['ID_KARYAWAN']; // jika data tidak kosong buat session untuk id_karyawan
    return $statement->rowCount() > 0;
}
// cek role apabila admin
function checkRoleAdministrator($username) {
    $statement = DB->prepare("SELECT ID_ROLE FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    return ($data && $data['ID_ROLE'] == 1); // cek apakah data yang dikembalikan ada dan memiliki role 1 (admin) 
}
// cek nama supplier
function checkNameSupplier($nama) {
    $statement = DB->prepare("SELECT * FROM supplier WHERE NAMA_SUPPLIER = :nama");
    $statement->bindValue(':nama', $nama);
    $statement->execute();
    return $statement->rowCount() > 0;
}
// cek nama menu dan nama supplier
function checkNameMenu($nama, $supplier) {
    $statement = DB->prepare("SELECT * FROM makanan WHERE NAMA_MAKANAN = :nama AND ID_SUPPLIER = :supplier");
    $statement->bindValue(':nama', $nama);
    $statement->bindValue(':supplier', $supplier);
    $statement->execute();
    return $statement->rowCount() > 0;
}

// ----- Validasi untuk Login -----
function validateLogin(&$errors, $username, $password){
    // jika username tidak kosong
    if (!empty($username)){
        // jika password tidak kosong
        if (!empty($password)){
            // panggil fungsi untuk cek username apakah ada di pelanggan
            if (checkUsernameCustomer($username)){
                // panggil fungsi apakah password sama dengan yang ada di tb pelanggan
                if (checkPasswordCustomer($username, $password)){
                    $_SESSION['login'] = 'pelanggan'; // set session login = 'pelanggan'
                    header("Location: menu.php");
                    exit();
                }
                return $errors["password"] = "Password salah"; // set errors untuk password salah
            } 
            // panggil fungsi untuk cek username apakah ada di karyawan
            else if (checkUsernameEmployee($username)){
                // panggil fungsi apakah password sama dengan yang ada di tb karyawan
                if (checkPasswordEmployee($username, $password)){
                    $_SESSION['login'] = checkRoleAdministrator($username) ? "admin" : "manager"; // set session sesuai dengan role
                    header("Location: admin/index.php");
                    exit();
                }
                return $errors["password"] = "Password salah"; // set errors untuk password salah
            }
            return $errors['username'] = "Username belum terdaftar"; // set errors untuk username belum terdaftar
        }
        return $errors["password"] = "Password wajib terisi"; // set errors untuk password wajib diisi
    }
    $errors["username"] = "Username wajib terisi"; // set errors untuk password wajib diisi
    $errors["password"] = "Password wajib terisi"; // set errors untuk password wajib diisi
}

// ----- Pengecekan isi inputan saat Register -----
// validasi untuk no HP
function validateNoHp(&$errors, $data) {
    if (empty($data)) { 
        $errors['nohpErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        $errors['nohpErr'] = "Input harus berupa angka saja";
    } elseif (strlen($data) < 9) {
        $errors['nohpErr'] = "minimal 10 digit";
    } elseif (strlen($data) > 13) {
        $errors['nohpErr'] = "maksimal panjang 13 digit";
    }
}
// validasi untuk nama
function validateName(&$errors, $data) {
    if (empty($data)) {
        $errors['nameErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data)) {
        $errors['nameErr'] = "Input harus berupa alphabet saja";
    } elseif (strlen($data) < 3) {
        $errors['nameErr'] = "Minimal karakter 3 ";
    } elseif (strlen($data) > 50) {
        $errors['nameErr'] = "Maksimal karakter 50 ";
    }
}
// validasi untuk username
function validateUsername(&$errors, $data) {
    if (empty($data)) {
        $errors['usernameErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[a-z0-9_]+$/", $data)) {
        $errors['usernameErr'] = "Input harus berupa alphabet kecil dan angka saja";
    } elseif (strlen($data) < 3) {
        $errors['usernameErr'] = "Minimal karakter 3 ";
    } elseif (strlen($data) > 50) {
        $errors['usernameErr'] = "Maksimal karakter 50 ";
    }
}
// validasi untuk password
function validatePass(&$errors, $data) {
    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/   -- didalamnya harus ada huruf kapital kecil dan angka
    // /^[A-Z]{1,}[a-z]{1,}[0-9]{1,}/         -- huruf awal harus kapital min 1 -> huruf kecil min 1 -> angka min 1
    if (empty($data)) {
        $errors['passwordErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[A-Z]{1,}[a-z]{1,}[0-9]{1,}/", $data)) {
        $errors['passwordErr'] = "Password harus diawali huruf kapital diikuti kombinasi alphabet dan angka";
    } elseif (!preg_match("/[!@#$%^&*,._?:{}|<>]{2,}/", $data)) {
        $errors['passwordErr'] = "Password harus mengandung setidaknya dua karakter khusus";
    } elseif (strlen($data) < 8) {
        $errors['passwordErr'] = "Minimal karakter 8 ";
    } elseif (strlen($data) > 50) {
        $errors['passwordErr'] = "Maksimal karakter 50 ";
    }
}
// validasi untuk konfirmasi password
function validatePass2(&$errors, $password, $password2) {
    if (!empty($password2)) {
        if ($password != $password2) $errors['password2Err'] = "Password tidak sama";
    } else {
        $errors['password2Err'] = "Input tidak boleh kosong";
    }
}
// validasi untuk alamat
function validateAddress(&$errors, $data) {
    if (empty($data)) $errors['alamatErr'] = "Input tidak boleh kosong";
}

// ----- Validasi untuk Register -----
function validateRegister(&$errors, $data) {
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);

    validateName($errors, $nama);
    validateUsername($errors, $username);
    validatePass($errors, $password);
    validatePass2($errors, $password, $password2);
    validateNoHp($errors, $nohp);
    validateAddress($errors, $alamat);
    
    if(checkUsernameCustomer($username)) $errors['usernameErr'] = "Username sudah ada";

    return $errors;
}

// ----- Validasi untuk Edit Profil -----
function validateEdit(&$errors, $data) {
    $nama = htmlspecialchars($data['nama']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

    // jika password yang dikirim tidak kosong baru lakukan validasi untuk password
    if (!empty($password)) {
        validatePass($errors, $password);
        validatePass2($errors, $password, $password2);
    }

    validateName($errors, $nama);
    validateNoHp($errors, $nohp);
    validateAddress($errors, $alamat);
    
    return $errors;
}

// ----- Validasi untuk Register Karyawan -----
function validateRegisterEmployee(&$errors, $data) {
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nohp = htmlspecialchars($data['nohp']);

    validateName($errors, $nama);
    validateUsername($errors, $username);
    validatePass($errors, $password);
    validatePass2($errors, $password, $password2);
    validateNoHp($errors, $nohp);

    if(checkUsernameEmployee($username)) $errors['usernameErr'] = "Username sudah ada";

    return $errors;
}

// ----- Validasi pada saat menambah data pembayaran -----
function validatePayment(&$errors, $data) {
    // looping data yang dikirim (berbentuk array)
    foreach ($data as $key => $value) {
        // apabila isian nya tidak kosong lakukan validasi untuk angka dan panjang digit
        if(!empty($value) && !preg_match("/^[0-9]+$/", $value)) {
            $errors[$key] = "Input harus berupa Angka saja";
        } else if(!empty($value) && strlen($value) < 8) {
            $errors[$key] = "minimal 8 digit";
        }
    }
    return $errors;
}

// ----- Validasi pada saat menambah data supplier -----
function validateSupplier(&$errors, $data) {
    $nama = htmlspecialchars($data['nama']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);

    validateName($errors, $nama);
    validateNoHp($errors, $nohp);   
    validateAddress($errors, $alamat);
    
    if (checkNameSupplier($nama)) $errors['nameErr'] = "Nama supplier sudah ada";
    
    return $errors;
}

// ----- Pengecekan isi inputan saat menambah data makanan  -----
// validasi untuk upload file
function validateUpload(&$errors, &$file, $kategori) {
    $namaFile 	= $file['gambar']['name']; // ambil nama file upload
    $ukuranFile	= $file['gambar']['size']; // ambil ukuran file upload
    $error	 	= $file['gambar']['error']; // ambil kode error file upload
    $tmpName	= $file['gambar']['tmp_name']; // ambil tempat sementara ketika file upload

    // jika tidak ada file yang dikirim
    if ($error === 4) {
        return $errors['gambarErr'] = 'File gambar harus diisi';
    }
    
    $ekstensiValid 	= ['jpg', 'jpeg', 'png', 'svg']; 
    $ekstensiGambar	= explode('.', $namaFile); // pecah nama file ke dalam array dengan pembatas '.'
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // ambil index terakhir dan jadikan ke huruf kecil

    // jika ekstensi gambar tidak ada dalam array $ekstensiValid
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        return $errors['gambarErr'] = 'Format gambar tidak valid';
    }

    // jika ukuran file lebih dari 1 MB (satuan Byte)
    if ($ukuranFile > 1000000) {
        return $errors['gambarErr'] = 'Ukuran gambar terlalu besar (< 1MB)';
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar; // set nama file secara random 
    // jika tidak ada errors pindah tempat file ke folder sesuai kategori
    if(empty($errors)) move_uploaded_file($tmpName, BASEPATH . '/assets/img/menu/' . $kategori . '/' . $namaFileBaru);
    $file['gambar']['name'] = $namaFileBaru; // rubah nama file yang disukkan menjadi nama yang baru
}
// validasi untuk harga
function validatePrice(&$errors, $data) {
    if (empty($data)) {
        $errors['hargaErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        $errors['hargaErr'] = "Input harus berupa angka saja";
    } elseif (intval($data) < 5000) {
        $errors['hargaErr'] = "Minimal harga Rp. 5.000";
    } elseif (intval($data) > 200000) {
        $errors['hargaErr'] = "Maksimal harga Rp. 200.000";
    }
}
// validasi untuk stok
function validateStok(&$errors, $data) {
    if (empty($data)) {
        $errors['stokErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        $errors['stokErr'] = "Input harus berupa angka saja";
    } elseif (intval($data) < 1) {
        $errors['stokErr'] = "Minimal stok 1 barang";
    }
}
// ----- Validasi untuk data makanan -----
function validateMenu(&$errors, $data, &$file) {
    $nama = htmlspecialchars($data['nama']);
	$harga = htmlspecialchars($data['harga']);
	$stok = htmlspecialchars($data['stok']);
    $supplier = getSupplierById(htmlspecialchars($data['supplier']));
    $kategori = getCategoryByKode(htmlspecialchars($data['kategori']));
    
    validateName($errors, $nama);
    validatePrice($errors, $harga);
    validateStok($errors, $stok);
    
    // untuk mengubah data makanan
    if(isset($data['ubah'])) {
        $result = getMenuByKode($data['kodeMakanan']); // ambil data yang ada pada tb makanan

        // jika nama yang diinputkan tidak sama dengan data pada tb dan panggil cek nama menu
        if ($nama != $result['NAMA_MAKANAN'] && checkNameMenu($nama, $supplier['ID_SUPPLIER'])) $errors['nameErr'] = "Nama makanan sudah ada";
        
        // jika tidak gambar yang dimasukkan
        if($file['gambar']['error'] === 4) {
            $file['gambar']['name'] = $data['gambarLama'];
        } else {
            validateUpload($errors, $file, $kategori['NAMA_KATEGORI']);
        }
    } 
    // untuk menambah data makanan
    else {
        if (checkNameMenu($nama, $supplier['ID_SUPPLIER'])) $errors['nameErr'] = "Nama makanan sudah ada";
        validateUpload($errors, $file, $kategori['NAMA_KATEGORI']);
    }
    
    return $errors;
}