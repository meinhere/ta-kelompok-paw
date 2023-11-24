<?php 
require_once BASEPATH . "/data/connection.php";

// Validasi untuk Login
function checkUsernamePelanggan($username) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    return $statement->rowCount() > 0;
}
function checkUsernameKaryawan($username) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    return $statement->rowCount() > 0;
}
function checkPasswordPelanggan($username, $password) {
    $statement = DB->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username AND PASSWORD_PELANGGAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_pelanggan'] = $data[0]['ID_PELANGGAN'];
    return $statement->rowCount() > 0;
}
function checkPasswordKaryawan($username, $password) {
    $statement = DB->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username AND PASSWORD_KARYAWAN = SHA2(:password, 256)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($data)) $_SESSION['id_karyawan'] = $data[0]['ID_KARYAWAN'];
    return $statement->rowCount() > 0;
}
function checkRoleAdministrator($username) {
    $statement = DB->prepare("SELECT ID_ROLE FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return ($result && $result['ID_ROLE'] == 1);
}
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

// Validate Register
function validateNoHp(&$errors, $data) {
    if (empty($data)) {
        $errors['nohpErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        $errors['nohpErr'] = "Input harus berupa Angka saja";
    } elseif (strlen($data) < 9) {
        $errors['nohpErr'] = "minimal 11 digit";
    } elseif (strlen($data) > 12) {
        $errors['nohpErr'] = "maksimal panjang 14 digit";
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
    if (empty($data)) {
        $errors['passwordErr'] = "Input tidak boleh kosong";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])/", $data)) {
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
function validateRegister(&$errors, $data) {
    $name = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);

    validateName($errors, $name);
    validateUsername($errors, $username);
    validatePass($errors, $password);
    validatePass2($errors, $password, $password2);
    validateNoHp($errors, $nohp);
    validateAddress($errors, $alamat);

    return $errors;
}
function validateEdit(&$errors, $data) {
    $name = htmlspecialchars($data['nama']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

    if (!empty($password)) {
        validatePass($errors, $password);
        validatePass2($errors, $password, $password2);
    }

    validateName($errors, $name);
    validateNoHp($errors, $nohp);
    validateAddress($errors, $alamat);
    
    return $errors;
}
function validateRegisterEmployee(&$errors, $data) {
    $name = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nohp = htmlspecialchars($data['nohp']);

    validateName($errors, $name);
    validateUsername($errors, $username);
    validatePass($errors, $password);
    validatePass2($errors, $password, $password2);
    validateNoHp($errors, $nohp);

    return $errors;
}

function validatePayment(&$errors, $data) {
    foreach ($data as $key => $value) {
        if(!empty($value) && !preg_match("/^\d+$/", $value)) {
            $errors[$key] = "Input harus berupa Angka saja";
        }
    }
    return $errors;
}