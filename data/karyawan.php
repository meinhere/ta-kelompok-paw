<?php 
require_once BASEPATH . "/data/connection.php";

function getEmployeeById() {
    try {
		$statement = DB->prepare("SELECT * FROM pelanggan WHERE ID_PELANGGAN = :id_pelanggan");
        $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
    catch(PDOException $err){
        echo $err->getMessage();
    }
}

function insertEmployee($data) {
    $name = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(hash('sha256', $data['password']));
    $nohp = htmlspecialchars($data['nohp']);
    $role = intval($data['role']);

    try {
        $statement = DB->prepare("INSERT INTO karyawan (
            ID_ROLE,
            USERNAME_KARYAWAN,
            PASSWORD_KARYAWAN,
            NAMA_KARYAWAN,
            NO_TELP_KARYAWAN)
            VALUES 
            (:role,
            :username,
            :password,
            :name,
            :nohp)");

        $statement->bindValue(':role', $role);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':nohp', $nohp);
        $statement->execute();

        return true;
    } catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }
}

function editCustomer($data) {
    $customer = getCustomerById();

    $name = htmlspecialchars($data['nama']);
    $password = !empty($data['password']) ? htmlspecialchars(hash('sha256', $data['password'])) : $customer[0]['PASSWORD_PELANGGAN'];
    $nohp = htmlspecialchars($data['nohp']);
    $alamat = htmlspecialchars($data['alamat']);
    $jeniskelamin = htmlspecialchars($data['jenis_kelamin']);

    try {
        $statement = DB->prepare("UPDATE pelanggan SET 
            PASSWORD_PELANGGAN = :password,
            NAMA_PELANGGAN = :name,
            NO_TELP_PELANGGAN = :nohp,
            ALAMAT_PELANGGAN = :alamat,
            JENIS_KELAMIN = :jeniskelamin WHERE ID_PELANGGAN = :id_pelanggan");

        $statement->bindValue(':name', $name);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':nohp', $nohp);
        $statement->bindValue(':alamat', $alamat);
        $statement->bindValue(':jeniskelamin', $jeniskelamin);
        $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
        $statement->execute();

        return true;
    } catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }
}