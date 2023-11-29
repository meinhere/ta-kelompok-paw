<?php 
require_once BASEPATH . "/data/connection.php";

function getAllPayment() {
  try {
    $statement = DB->prepare("SELECT * FROM metode_bayar WHERE ID_PELANGGAN = :id_pelanggan");
    $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $err){
      echo $err->getMessage();
  }
}

function getPaymentById($id_metode) {
  try {
    $statement = DB->prepare("SELECT * FROM metode_bayar WHERE ID_PELANGGAN = :id_pelanggan AND ID_METODE = :id_metode");
    $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
    $statement->bindValue(':id_metode', $id_metode);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $err){
      echo $err->getMessage();
  }
}

function editPayment($data) {
  try {
    foreach ($data as $key => $value) {
      if ($key == "bri") {
        $id_metode = 1; 
        $nama_metode = "Rekening BRI";
      } else if ($key == "bca") {
        $id_metode = 2;
        $nama_metode = "Rekening BCA";
      } else if ($key == "dana") {
        $id_metode = 3;
        $nama_metode = "Digital DANA";
      } else if ($key == "ovo") {
        $id_metode = 4;
        $nama_metode = "Digital OVO";
      }

      if ($value) {
        if (!empty(getPaymentById($id_metode))) {
          $statement = DB->prepare("UPDATE metode_bayar SET NO_REKENING = :no_rekening WHERE ID_PELANGGAN = :id_pelanggan AND ID_METODE = :id_metode");
          $statement->bindValue(':no_rekening', $value);
        } else {
          $statement = DB->prepare("INSERT INTO metode_bayar VALUES(:id_metode, :id_pelanggan, :nama_metode, :no_rekening)");
          $statement->bindValue(':nama_metode', $nama_metode);
          $statement->bindValue(':no_rekening', $value);
        }
        $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
        $statement->bindValue(':id_metode', $id_metode);
        $statement->execute();
      } else {
        if (!empty(getPaymentById($id_metode))) {
          $statement = DB->prepare("DELETE FROM metode_bayar WHERE ID_PELANGGAN = :id_pelanggan AND ID_METODE = :id_metode");
          $statement->bindValue(':id_pelanggan', $_SESSION['id_pelanggan']);
          $statement->bindValue(':id_metode', $id_metode);
          $statement->execute();
        }
      }
    }
    return true;
  }
  catch(PDOException $err){
      echo $err->getMessage();
      return false;
  }
}