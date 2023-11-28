<?php 
require_once BASEPATH . "/data/connection.php";

// ----- Pengecekan isi inputan -----
// cek username pelanggan
function checkUsernamePelanggan($username) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    return $statement->rowCount() > 0 && preg_match("/^[a-z0-9_]+$/", $username);
}
// cek username karyawan
function checkUsernameKaryawan($username) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    return $statement->rowCount() > 0 && preg_match("/^[a-z0-9_]+$/", $username);
}
// cek password pelanggan
function checkPasswordPelanggan($username, $password) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username AND PASSWORD_PELANGGAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_pelanggan'] = $data['ID_PELANGGAN'];
    return $statement->rowCount() > 0;
}
// cek password karyawan
function checkPasswordKaryawan($username, $password) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username AND PASSWORD_KARYAWAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_karyawan'] = $data['ID_KARYAWAN'];
    return $statement->rowCount() > 0;
}
// cek role 
function checkRoleAdministrator($username) {
    $statement = DB->prepare("SELECT ID_ROLE FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return ($result && $result['ID_ROLE'] == 1);
}
// cek nama supplier
function checkNameSupplier($nama) {
    $statement = DB->prepare("SELECT * FROM supplier WHERE NAMA_SUPPLIER = :nama");
    $statement->bindValue(':nama', $nama);
    $statement->execute();
    return $statement->rowCount() > 0;
}
// cek nama menu
function checkNameMenu($nama, $supplier) {
    $statement = DB->prepare("SELECT * FROM makanan WHERE NAMA_MAKANAN = :nama AND ID_SUPPLIER = :supplier");
    $statement->bindValue(':nama', $nama);
    $statement->bindValue(':supplier', $supplier);
    $statement->execute();
    return $statement->rowCount() > 0;
}

// ----- Validasi untuk Login -----
function validateLogin(&$error, $username, $password){
    if (!empty($username)){
        if (!empty($password)){
            if (checkUsernamePelanggan($username)){
                if (checkPasswordPelanggan($username, $password)){
                    $_SESSION['login'] = 'pelanggan';
                    header("Location: menu.php");
                    exit();
                }
                return $error["password"] = "Password salah";
            } else if (checkUsernameKaryawan($username)){
                if (checkPasswordKaryawan($username, $password)){
                    $_SESSION['login'] = checkRoleAdministrator($username) ? "admin" : "manager";
                    header("Location: admin/index.php");
                    exit();
                }
                return $error["password"] = "Password salah";
            }
            return $error['username'] = "Username belum terdaftar";
        }
        return $error["password"] = "Password wajib terisi";
    }
    $error["username"] = "Username wajib terisi";
    $error["password"] = "Password wajib terisi";
}

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
function validatePass(&$errors, $data) {
    // (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/", $data))
    // /^[A-Z]{1,}[a-z]{1,}[0-9]{1,}/
    if (empty($data)) {
        $errors['passwordErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[A-Z]{1,}[a-z]{1,}[0-9]{1,}/", $data)) {
        $errors['passwordErr'] = "Password harus berupa kombinasi alphabet dan angka";
    } elseif (!preg_match("/[!@#$%^&*,._?:{}|<>]{2,}/", $data)) {
        $errors['passwordErr'] = "Password harus mengandung setidaknya dua karakter khusus";
    } elseif (strlen($data) < 8) {
        $errors['passwordErr'] = "Minimal karakter 8 ";
    } elseif (strlen($data) > 50) {
        $errors['passwordErr'] = "Maksimal karakter 50 ";
    }
}
function validatePass2(&$errors, $password, $password2) {
    if (!empty($password2)) {
        if ($password != $password2) $errors['password2Err'] = "Password tidak sama";
    } else {
        $errors['password2Err'] = "Input tidak boleh kosong";
    }
}
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

    return $errors;
}

// ----- Validasi untuk Edit Profil -----
function validateEdit(&$errors, $data) {
    $nama = htmlspecialchars($data['nama']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

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

    return $errors;
}

// ----- Validasi untuk pembayaran -----
function validatePayment(&$errors, $data) {
    foreach ($data as $key => $value) {
        if(!empty($value) && !preg_match("/^\d+$/", $value)) {
            $errors[$key] = "Input harus berupa Angka saja";
        } else if(!empty($value) && strlen($value) < 8) {
            $errors[$key] = "minimal 8 digit";
        }
    }
    return $errors;
}

// ----- Validasi untuk supplier -----
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

// ----- Validasi untuk makanan -----
function validateUpload(&$errors, &$file, $kategori) {
    $namaFile 	= $file['gambar']['name'];
    $ukuranFile	= $file['gambar']['size'];
    $error	 	= $file['gambar']['error'];
    $tmpName	= $file['gambar']['tmp_name'];

    if ($error === 4) {
        return $errors['gambarErr'] = 'File gambar harus diisi';
    }
    
    $ekstensiValid 	= ['jpg', 'jpeg', 'png', 'svg'];
    $ekstensiGambar	= explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        return $errors['gambarErr'] = 'Format gambar tidak valid';
    }

    if ($ukuranFile > 1000000) {
        return $errors['gambarErr'] = 'Ukuran gambar terlalu besar (< 1MB)';
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    if(empty($errors)) move_uploaded_file($tmpName, BASEPATH . '/assets/img/menu/' . $kategori . '/' . $namaFileBaru);
    $file['gambar']['name'] = $namaFileBaru;
}
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
function validateStok(&$errors, $data) {
    if (empty($data)) {
        $errors['stokErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        $errors['stokErr'] = "Input harus berupa angka saja";
    } elseif (intval($data) < 1) {
        $errors['stokErr'] = "Minimal stok 1 barang";
    }
}
function validateMenu(&$errors, $data, &$file) {
    $nama = htmlspecialchars($data['nama']);
	$harga = htmlspecialchars($data['harga']);
	$stok = htmlspecialchars($data['stok']);
    $supplier = getSupplierById(htmlspecialchars($data['supplier']));
    $kategori = getCategoryByKode(htmlspecialchars($data['kategori']));
    
    validateName($errors, $nama);
    validatePrice($errors, $harga);
    validateStok($errors, $stok);
    
    
    if(isset($data['ubah'])) {
        $result = getMenuByKode($data['kodeMakanan']);

        if ($nama != $result['NAMA_MAKANAN'] && checkNameMenu($nama, $supplier['ID_SUPPLIER'])) $errors['nameErr'] = "Nama makanan sudah ada";
        
        if($file['gambar']['error'] === 4) {
            $file['gambar']['name'] = $data['gambarLama'];
        } else {
            validateUpload($errors, $file, $kategori['NAMA_KATEGORI']);
        }
    } else {
        if (checkNameMenu($nama, $supplier['ID_SUPPLIER'])) $errors['nameErr'] = "Nama makanan sudah ada";
        validateUpload($errors, $file, $kategori['NAMA_KATEGORI']);
    }
    
    return $errors;
}