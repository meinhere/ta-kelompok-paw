<?php 

define("BASEURL", "http://localhost:8080/paw/ta");
define("BASEPATH", $_SERVER["DOCUMENT_ROOT"] . "/paw/ta");
define("DB", new PDO('mysql:host=localhost;dbname=japanfoods', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));
?>