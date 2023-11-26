<?php 
require_once BASEPATH . "/data/connection.php";

function getAllCategory() {
    try {
        $statement = DB->query("SELECT * FROM kategori");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $err){
        echo $err->getMessage();
    }
}


function getCategoryByKode($kode_kategori) {
    try {
		$statement = DB->prepare("SELECT * FROM kategori WHERE KODE_KATEGORI = :kode_kategori");
		$statement->bindValue(":kode_kategori", $kode_kategori);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
    catch(PDOException $err){
        echo $err->getMessage();
    }
}