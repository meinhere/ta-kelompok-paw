<?php 

define("HOST", "localhost");
define("DBNAME", "japanfoods");
define("USERNAME", "root");
define("PASSWORD", "");

define("BASEURL", "http://localhost:8080/paw/ta");
define("BASEASSET", "http://localhost:8080/paw/ta/assets");

define("DB", new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));