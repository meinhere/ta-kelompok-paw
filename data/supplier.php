<?php 
require_once BASEPATH . "/data/connection.php";

function getAllSupplier() {
  try {
		$statement = DB->query("SELECT * FROM supplier");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
    catch(PDOException $err){
        echo $err->getMessage();
    }
}

function getSupplierById($id_supplier) {
    try {
		$statement = DB->prepare("SELECT * FROM supplier WHERE ID_SUPPLIER = :id_supplier");
		$statement->bindValue(":id_supplier", $id_supplier);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
    catch(PDOException $err){
        echo $err->getMessage();
    }
}

function insertSupplier($data) {
	$nama = htmlspecialchars($data['nama']);
	$nohp = htmlspecialchars($data['nohp']);
	$alamat = htmlspecialchars($data['alamat']);
	try {
		$statement = DB->prepare("INSERT INTO supplier (
				NAMA_SUPPLIER,
				NO_TELP_SUPPLIER,
				ALAMAT_SUPPLIER)
				VALUES 
				(:nama,
				:nohp,
				:alamat)");

		$statement->bindValue(':nama', $nama);
		$statement->bindValue(':nohp', $nohp);
		$statement->bindValue(':alamat', $alamat);
		$statement->execute();

		return true;
	} catch (PDOException $err) {
			echo $err->getMessage();
			return false;
	}
}

function editSupplier($data) {
	$nama = htmlspecialchars($data['nama']);
	$nohp = htmlspecialchars($data['nohp']);
	$alamat = htmlspecialchars($data['alamat']);
	$id_supplier = intval($data['id_supplier']);
	try {
		$statement = DB->prepare("UPDATE supplier SET NAMA_SUPPLIER = :nama, NO_TELP_SUPPLIER = :nohp, ALAMAT_SUPPLIER = :alamat WHERE ID_SUPPLIER = :id_supplier");

		$statement->bindValue(':id_supplier', $id_supplier);
		$statement->bindValue(':nama', $nama);
		$statement->bindValue(':nohp', $nohp);
		$statement->bindValue(':alamat', $alamat);
		$statement->execute();

		return true;
	} catch (PDOException $err) {
			echo $err->getMessage();
			return false;
	}
}

function deleteSupplier($id_supplier) {
	try {
		$statement = DB->prepare("DELETE FROM supplier WHERE ID_SUPPLIER = :id_supplier");
		$statement->bindValue(':id_supplier', intval($id_supplier));
		$statement->execute();

		return true;
	} catch (PDOException $err) {
			echo $err->getMessage();
			return false;
	}
}