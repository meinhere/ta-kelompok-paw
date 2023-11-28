<?php
require_once BASEPATH . "/data/connection.php";

function getAllMenu() {
  try{
		$statement = DB->query("SELECT * FROM makanan INNER JOIN kategori ON makanan.KODE_KATEGORI = kategori.KODE_KATEGORI INNER JOIN supplier ON makanan.ID_SUPPLIER = supplier.ID_SUPPLIER");
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
function getMenuByKode($kode_makanan) {
  try{
		$statement = DB->prepare("SELECT KODE_MAKANAN, NAMA_MAKANAN, HARGA_MAKANAN, STOK_PRODUK, GAMBAR_MAKANAN, makanan.KODE_KATEGORI, NAMA_KATEGORI, ID_SUPPLIER FROM makanan INNER JOIN kategori ON makanan.KODE_KATEGORI = kategori.KODE_KATEGORI WHERE KODE_MAKANAN = :kode_makanan ");
    $statement->bindValue(":kode_makanan", intval($kode_makanan));
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function insertMenu($data, $file) {
	$nama = htmlspecialchars($data['nama']);
	$harga = intval($data['harga']);
	$stok = intval($data['stok']);
	$kategori = intval($data['kategori']);
	$supplier = intval($data['supplier']);
	$gambar = htmlspecialchars($file['gambar']['name']);
	try{
		$statement = DB->prepare("INSERT INTO makanan 
		(NAMA_MAKANAN, HARGA_MAKANAN, STOK_PRODUK, KODE_KATEGORI, ID_SUPPLIER, GAMBAR_MAKANAN)
		VALUES 
		(:nama, :harga, :stok, :kategori, :supplier, :gambar)");
    $statement->bindValue(":nama", $nama);
    $statement->bindValue(":harga", $harga);
    $statement->bindValue(":stok", $stok);
    $statement->bindValue(":gambar", $gambar);
    $statement->bindValue(":kategori", $kategori);
    $statement->bindValue(":supplier", $supplier);
		$statement->execute();

		return "Ditambah";
	}
	catch(PDOException $err){
		echo $err->getMessage();
		return false;
	}
}

function editMenu($data, $file) {
	$kode = intval($data['kodeMakanan']);

	$nama = htmlspecialchars($data['nama']);
	$harga = intval($data['harga']);
	$stok = intval($data['stok']);
	$kategori = intval($data['kategori']);
	$supplier = intval($data['supplier']);
	$gambar = htmlspecialchars($file['gambar']['name']);
	$gambarLama = htmlspecialchars($data['gambarLama']);
	try{
		$statement = DB->prepare("UPDATE makanan SET
		NAMA_MAKANAN = :nama, 
		HARGA_MAKANAN = :harga, 
		STOK_PRODUK = :stok, 
		KODE_KATEGORI = :kategori, 
		ID_SUPPLIER = :supplier, 
		GAMBAR_MAKANAN = :gambar WHERE KODE_MAKANAN = :kode");
		
    $statement->bindValue(":kode", $kode);
    $statement->bindValue(":nama", $nama);
    $statement->bindValue(":harga", $harga);
    $statement->bindValue(":stok", $stok);
    $statement->bindValue(":gambar", $gambar);
    $statement->bindValue(":kategori", $kategori);
    $statement->bindValue(":supplier", $supplier);
		$statement->execute();
		
		if($gambarLama != $gambar) {
			$result = getMenuByKode($kode);
			unlink(BASEPATH . '/assets/img/menu/' . $result['NAMA_KATEGORI'] . '/' . $gambarLama);
		} 
		return "Diubah";
	}
	catch(PDOException $err){
		echo $err->getMessage();
		return false;
	}
}
function deleteMenu($kode_makanan) {
	$result = getMenuByKode($kode_makanan);

	try{
		$statement = DB->prepare("DELETE FROM makanan WHERE KODE_MAKANAN = :kode_makanan");
		$statement->bindValue(':kode_makanan',$kode_makanan);
		$statement->execute();
		unlink(BASEPATH . '/assets/img/menu/' . $result['NAMA_KATEGORI'] . '/' . $result['GAMBAR_MAKANAN']);
		return true;
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}

// CARTS
function getAllCarts()  {
	try{
		$statement = DB->prepare("SELECT keranjang.KODE_MAKANAN, NAMA_MAKANAN, HARGA_MAKANAN, QTY, GAMBAR_MAKANAN, NAMA_KATEGORI, STOK_PRODUK
		FROM keranjang 
		INNER JOIN makanan ON keranjang.KODE_MAKANAN = keranjang.KODE_MAKANAN
		INNER JOIN kategori ON kategori.KODE_KATEGORI = makanan.KODE_KATEGORI
		WHERE makanan.KODE_MAKANAN = keranjang.KODE_MAKANAN AND ID_PELANGGAN = :id_pelanggan");
		$statement->bindValue(":id_pelanggan", $_SESSION['id_pelanggan']);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function insertCarts($kode_makanan) {
	try{
		$statement = DB->prepare("INSERT INTO keranjang(ID_PELANGGAN, KODE_MAKANAN, QTY) VALUES (:id_pelanggan, :kode_makanan, :qty)");
    $statement->bindValue(":id_pelanggan", $_SESSION['id_pelanggan']);
    $statement->bindValue(":kode_makanan", $kode_makanan);
    $statement->bindValue(":qty", 1);
		$statement->execute();
		header("Location: " . $_SERVER['HTTP_REFERER']);
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
function deleteAllCarts() {
	try{
		$statement = DB->prepare("DELETE FROM keranjang WHERE ID_PELANGGAN = :id_pelanggan");
		$statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
		$statement->execute();
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function editCarts($data) {
	$kode_makanan = $data['kode_makanan'];
	$qty = $data['qty'];
	try{
		for ($i = 0; $i < count($kode_makanan); $i++) {
			$statement = DB->prepare("UPDATE keranjang SET QTY = :qty WHERE ID_PELANGGAN = :id_pelanggan AND KODE_MAKANAN = :kode_makanan");
			$statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
			$statement->bindValue(':kode_makanan', $kode_makanan[$i]);
			$statement->bindValue(':qty',$qty[$i]);
			$statement->execute();
		}
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function insertOrders($data) {
	$total = $data['total'];
	$kode_makanan = $data['kode_makanan'];
	$harga_makanan = $data['harga_makanan'];
	$qty = $data['qty'];
	try{
		// Hapus isi keranjang
		$statement = DB->prepare("DELETE FROM keranjang WHERE ID_PELANGGAN = :id_pelanggan");
		$statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
		$statement->execute();

		// Tambahkan pada tabel transaksi
		$statement = DB->prepare("INSERT INTO transaksi(ID_PELANGGAN, TOTAL, STATUS) VALUES(:id_pelanggan, :total, :status)");
		$statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
		$statement->bindValue(':total', $total);
		$statement->bindValue(':status', 0);
		$statement->execute();

		// Tambahkan pada tabel transaksi_detail
		$kode_transaksi = DB->lastInsertId();
		for ($i = 0; $i < count($kode_makanan); $i++) {
			$statement = DB->prepare("INSERT INTO transaksi_detail VALUES(:kode_transaksi, :kode_makanan, :harga_makanan, :qty)");
			$statement->bindValue(':kode_transaksi', $kode_transaksi);
			$statement->bindValue(':kode_makanan', $kode_makanan[$i]);
			$statement->bindValue(':harga_makanan', $harga_makanan[$i]);
			$statement->bindValue(':qty',$qty[$i]);
			$statement->execute();
		}
		header("Location: konfirmasi.php?id=" . $kode_transaksi);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}