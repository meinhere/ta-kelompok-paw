<?php
function register($data)
{
    $name = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(hash('sha256', $data['password']));
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);
    $jeniskelamin = htmlspecialchars($data['jenis_kelamin']);

    try {
        $statement = DB->prepare("INSERT INTO pelanggan (KODE_PELANGGAN,
            USERNAME_PELANGGAN,
            PASSWORD_PELANGGAN,
            NAMA_PELANGGAN,
            NO_TELP_PELANGGAN,
            ALAMAT_PELANGGAN,
            JENIS_KELAMIN)
            VALUES 
            ('',
            :username,
            :password,
            :nama,
            :nohp,
            :alamat,
            :jeniskelamin)");

        $statement->bindValue(':nama', $name);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':nohp', $nohp);
        $statement->bindValue(':alamat', $alamat);
        $statement->bindValue(':jeniskelamin', $jeniskelamin);
        $statement->execute();

        return true;

    } catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }
}

function validateAll($data)
{
    $name = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);

    $nameErr = validateName($name);
    $usernameErr = validateUsername($username);
    $passwordErr = validatePass($password);
    $password2Err = validatePass2($password, $password2);
    $nohpErr = valMinCharacter($nohp);
    $alamatErr = validateAddress($alamat);

    $errors = array(
        'nameErr' => $nameErr,
        'usernameErr' => $usernameErr,
        'passwordErr' => $passwordErr,
        'password2Err' => $password2Err,
        'nohpErr' => $nohpErr,
        'alamatErr' => $alamatErr
    );
    return $errors;
}

function validatePass2($password, $password2)
{
    if (!empty($password2)) {
        if ($password != $password2) {
            return "Password tidak sama";
        }
    }
    return null;
}

function validatePass($data)
{
    if (empty($data)) {
        return "Input tidak boleh kosong";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])/", $data)) {
        return "Password harus berupa kombinasi alphabet dan angka";
    } elseif (!preg_match("/[!@#$%^&*,._?:{}|<>]{2,}/", $data)) {
        return "Password harus mengandung setidaknya dua karakter khusus";
    } elseif (strlen($data) < 8) {
        return "Minimal karakter 8 ";
    } elseif (strlen($data) > 50) {
        return "Maksimal karakter 50 ";
    }
    return null;
}

function validateName($data)
{
    // var_dump($data);
    if (empty($data)) {
        return "Input tidak boleh kosong";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data)) {
        return "Input harus berupa alphabet saja";
    } elseif (strlen($data) < 3) {
        return "Minimal karakter 3 ";
    } elseif (strlen($data) > 50) {
        return "Maksimal karakter 50 ";
    }
    return null;
}
function validateUsername($data)
{
    // var_dump($data);
    if (empty($data)) {
        return "Input tidak boleh kosong";
    } elseif (!preg_match("/^[a-z0-9_]+$/", $data)) {
        return "Input harus berupa alphabet kecil dan angka saja";
    } elseif (strlen($data) < 3) {
        return "Minimal karakter 3 ";
    } elseif (strlen($data) > 50) {
        return "Maksimal karakter 50 ";
    }
    return null;
}
function validateAddress($data)
{
    // var_dump($data);
    if (empty($data)) {
        return "Input tidak boleh kosong";
    }
    return null;
}

function valMinCharacter($data)
{
    if (empty($data)) {
        return "Input tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $data)) {
        return "Input harus berupa Angka saja";
    } elseif (strlen($data) < 9) {
        return "minimal 11 digit";
    } elseif (strlen($data) > 12) {
        return "panjang 14 digit";
    }
    return null;
}

?>