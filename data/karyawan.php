<?php 
require_once BASEPATH . "/data/connection.php";

// ----- Ambil semua data pada tb karyawan berdasarkan id_karyawan ------
function getEmployeeById() {
    try {
        $statement = DB->prepare("SELECT * FROM karyawan WHERE ID_KARYAWAN = :id_karyawan");
        $statement->bindValue(':id_karyawan', $_SESSION['id_karyawan']);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
    catch(PDOException $err){
        echo $err->getMessage();
    }
}

// ----- Tambah data pada tb karyawan ------
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