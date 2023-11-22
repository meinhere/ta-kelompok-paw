<?php 
include "connection.php";

function getAllOrdersDetail($kode_transaksi) {
  try{
		$statement = DB->prepare(
      "SELECT NAMA_MAKANAN, td.HARGA_MAKANAN, td.KODE_MAKANAN, QTY, NAMA_KATEGORI, STOK_PRODUK 
       FROM transaksi_detail td
       INNER JOIN makanan ON makanan.KODE_MAKANAN = td.KODE_MAKANAN
       INNER JOIN kategori ON kategori.KODE_KATEGORI = makanan.KODE_KATEGORI
       WHERE KODE_TRANSAKSI = :kode_transaksi");
		$statement->bindValue(':kode_transaksi', $kode_transaksi);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}
function deleteOrdersDetailByKode($kode_transaksi, $kode_makanan) {
	try{
		$statement = DB->prepare("DELETE FROM transaksi_detail WHERE KODE_MAKANAN = :kode_makanan AND KODE_TRANSAKSI = :kode_transaksi");
		$statement->bindValue(':kode_transaksi',$kode_transaksi);
		$statement->bindValue(':kode_makanan', $kode_makanan);
		$statement->execute();
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	}
}

function getAllOrders() {
  try{
		$statement = DB->query("SELECT * FROM transaksi");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $err){
		echo $err->getMessage();
	} 
}
function editOrders($kode_transaksi, $data) {
  $kode_makanan = $data['kode_makanan'];
  $sisa_stok = $data['sisa_stok'];
  try{
    // Update tabel transaksi
		$statement = DB->prepare("UPDATE transaksi SET STATUS = :status, WAKTU_BAYAR = :waktu_bayar WHERE KODE_TRANSAKSI = :kode_transaksi");
		$statement->bindValue(':status', 1);
		$statement->bindValue(':waktu_bayar', date("Y-m-d H:i:s"));
		$statement->bindValue(':kode_transaksi', $kode_transaksi);
		$statement->execute();

    // Update tabel makanan
    for ($i = 0; $i < count($kode_makanan); $i++) {
      $statement = DB->prepare("UPDATE makanan SET STOK_PRODUK = :sisa_stok WHERE KODE_MAKANAN = :kode_makanan");
      $statement->bindValue(':sisa_stok', $sisa_stok[$i]);
      $statement->bindValue(':kode_makanan', $kode_makanan[$i]);
      $statement->execute();
    }

		header("Location: pesanan.php");
	}
	catch(PDOException $err){
		echo $err->getMessage();
  }
}