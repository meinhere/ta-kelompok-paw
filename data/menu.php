<?php
include "connection.php";

function getAllMenu() {
  try{
		$statement = DB->query("SELECT * FROM makanan INNER JOIN kategori ON makanan.KODE_KATEGORI = kategori.KODE_KATEGORI");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}

function getAllMenuByCategory($kategori) {
  try{
		$statement = DB->prepare("SELECT * FROM makanan JOIN kategori ON kategori.KODE_KATEGORI = makanan.KODE_KATEGORI WHERE kategori.NAMA_KATEGORI = :kategori");
    $statement->bindValue(":kategori", $kategori);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}


// CARTS
function getAllCarts($kode_pelanggan)  {
	try{
		$statement = DB->prepare("SELECT keranjang.KODE_MAKANAN, NAMA_MAKANAN, HARGA_MAKANAN, QTY, GAMBAR_MAKANAN, NAMA_KATEGORI, STOK_PRODUK
		FROM keranjang 
		INNER JOIN makanan ON keranjang.KODE_MAKANAN = keranjang.KODE_MAKANAN
		INNER JOIN kategori ON kategori.KODE_KATEGORI = makanan.KODE_KATEGORI
		WHERE makanan.KODE_MAKANAN = keranjang.KODE_MAKANAN AND KODE_PELANGGAN = :kode_pelanggan AND STATUS_K = 0");
		$statement->bindValue(":kode_pelanggan", $kode_pelanggan);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function insertCarts($kode_pelanggan, $kode_makanan) {
	try{
		$statement = DB->prepare("INSERT INTO keranjang(KODE_PELANGGAN, KODE_MAKANAN, QTY, STATUS_K) VALUES (:kode_pelanggan, :kode_makanan, :qty, :status_k)");
    $statement->bindValue(":kode_pelanggan", $kode_pelanggan);
    $statement->bindValue(":kode_makanan", $kode_makanan);
    $statement->bindValue(":qty", 1);
    $statement->bindValue(":status_k", 0);
		$statement->execute();
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function deleteCartsByKode($kode_makanan) {
	try{
		$statement = DB->prepare("DELETE FROM keranjang WHERE KODE_MAKANAN = :kode_makanan");
		$statement->bindValue(':kode_makanan',$kode_makanan);
		$statement->execute();
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function deleteAllCarts($kode_pelanggan) {
	try{
		$statement = DB->prepare("DELETE FROM keranjang WHERE KODE_PELANGGAN = :kode_pelanggan");
		$statement->bindValue(':kode_pelanggan',$kode_pelanggan);
		$statement->execute();
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function editCarts($kode_pelanggan, $data) {
	$kode_makanan = $data['kode_makanan'];
	$qty = $data['qty'];
	try{
		for ($i = 0; $i < count($kode_makanan); $i++) {
			$statement = DB->prepare("UPDATE keranjang SET QTY = :qty WHERE KODE_PELANGGAN = :kode_pelanggan AND KODE_MAKANAN = :kode_makanan");
			$statement->bindValue(':kode_pelanggan',$kode_pelanggan);
			$statement->bindValue(':kode_makanan',$kode_makanan[$i]);
			$statement->bindValue(':qty',$qty[$i]);
			$statement->execute();
		}
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function insertOrders($kode_pelanggan, $data) {
	$total = $data['total'];
	$kode_makanan = $data['kode_makanan'];
	$harga_makanan = $data['harga_makanan'];
	$qty = $data['qty'];
	try{
		// Hapus isi keranjang
		$statement = DB->prepare("DELETE FROM keranjang WHERE KODE_PELANGGAN = :kode_pelanggan");
		$statement->bindValue(':kode_pelanggan',$kode_pelanggan);
		$statement->execute();

		// Tambahkan pada tabel transaksi
		$statement = DB->prepare("INSERT INTO transaksi(KODE_PELANGGAN, TOTAL, STATUS) VALUES(:kode_pelanggan, :total, :status)");
		$statement->bindValue(':kode_pelanggan',$kode_pelanggan);
		$statement->bindValue(':total', $total);
		$statement->bindValue(':status', 0);
		$statement->execute();

		// Tambahkan pada tabel transaksi_detail
		$kode_transaksi = DB->lastInsertId();
		for ($i = 0; $i < count($kode_makanan); $i++) {
			$statement = DB->prepare("INSERT INTO transaksi_detail VALUES(:kode_transaksi, :kode_makanan, :harga_makanan, :qty)");
			$statement->bindValue(':kode_transaksi', $kode_transaksi);
			$statement->bindValue(':kode_makanan',$kode_makanan[$i]);
			$statement->bindValue(':harga_makanan',$harga_makanan[$i]);
			$statement->bindValue(':qty',$qty[$i]);
			$statement->execute();
		}
		header("Location: konfirmasi.php?id=" . $kode_transaksi);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}

function moveToPay() {
	$statement = DB->query("SELECT * FROM transaksi");
	$id = $statement->rowCount() + 1;

	header("Location: konfirmasi.php?id=$id");
}