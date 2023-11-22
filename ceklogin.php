<?php 
// session_start();

include "base.php";

$db = DB;

function isLowercase($string) {
    return ctype_lower($string);
}
function isi($field){
    return empty(trim($field));
}

function checkUsernamePelanggan($username) {
    global $db;
    $statement = $db->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username");
    $statement->execute(array(
        "username" => $username));
    return $statement->rowCount() > 0;
}

function checkUsernameKaryawan($username) {
    global $db;
    $statement = $db->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->execute(array(
        "username" => $username));
    return $statement->rowCount() > 0;
}


function checkPasswordPelanggan($username, $password) {
    global $db;
    $statement = $db->prepare("SELECT * FROM pelanggan WHERE USERNAME_PELANGGAN = :username AND PASSWORD_PELANGGAN = SHA2(:password, 256)");
    $statement->execute(array(
        "username" => $username,
        "password" => $password));
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['kode_pelanggan'] = $data[0]['KODE_PELANGGAN'];
    return $statement->rowCount() > 0;
}

function checkPasswordKaryawan($username, $password) {
    global $db;
    $statement = $db->prepare("SELECT * FROM karyawan WHERE USERNAME_KARYAWAN = :username AND PASSWORD_KARYAWAN = SHA2(:password, 256)");
    $statement->execute(array(
        "username" => $username,
        "password" => $password));
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['id_karyawan'] = $data[0]['ID_KARYAWAN'];
    return $statement->rowCount() > 0;
}

function checkRoleAdministrator($username) {
    global $db;
    $statement = $db->prepare("SELECT ID_ROLE FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->execute(array(
        "username" => $username));

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return ($result && $result['ID_ROLE'] == 1);
}

function checkRoleManager($username) {
    global $db;
    $statement = $db->prepare("SELECT ID_ROLE FROM karyawan WHERE USERNAME_KARYAWAN = :username");
    $statement->execute(array(
        "username" => $username));

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return ($result && $result['ID_ROLE'] == 2);
}

function validAllin(&$error, $username, $password){
    if (isi($username)){
        $error["username"] = "Wajib Terisi !!!";
        if (isi($password)){
            $error["password"] = "Wajib Terisi !!!";
        } else {
            $error["password"] = "Username dan Password Tidak Terdaftar";
        }
    }
    elseif (!islowercase($username)){
        $error["username"] = "Hanya Boleh Menggunakan Huruf Kecil";
        if (isi($password)){
            $error["password"] = "Wajib Terisi !!!";
        } else {
            $error["password"] = "Username dan Password Tidak Terdaftar";
        }
    } elseif (checkUsernamePelanggan($username)){
        if (isi($password)){
            $error["password"] = "Wajib Terisi !!!";
        }elseif (checkPasswordPelanggan($username, $password)){
            $_SESSION['login'] = 'pelanggan';
            header("Location: customer/menu.php");
            exit();
        } else {
            $error["password"] = "Password Salah";
        }
    } elseif (checkUsernameKaryawan($username)){
        if (isi($password)){
            $error["password"] = "Wajib Terisi !!!";
        }elseif (checkPasswordKaryawan($username, $password)){
            if (checkRoleAdministrator($username)){
                $_SESSION['login'] = 'administrator';
                header("Location: administrator/menu.php");
                exit();
            } elseif (checkRoleManager($username)){
                $_SESSION['login'] = 'manager';
                header("Location: manager/menu.php");
                exit();
            }
        } else {
            $error["password"] = "Password Salah";
        }
    } else {
        $error["username"] = "Username Tidak Terdaftar";
        if (isi($password)){
            $error["password"] = "Wajib Terisi !!!";
        } else{
            $error["password"] = "Username dan Password Tidak Terdaftar";
        }
    }
}



// if (isset($_POST['submit'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     if (checkPasswordPelanggan($username, $password)){
//             $_SESSION['pelanggan'] = true;
//             header("Location: customer/menu.php");
//             exit();

//     } elseif (checkPasswordKaryawan($username, $password)) {
//         if (checkAdministrator($username)){
//             $_SESSION['administrator'] = true;
//             header("Location: administrator/menu.php");
//             exit();
//         } elseif (checkManager($username)){
//             $_SESSION['manager'] = true;
//             header("Location: manager/menu.php");
//             exit();
//         }
//     } else {
//         echo "<script>
//             alert('Username atau Password tidak terdaftar!');
//         </script>";
//     }
// }
?>