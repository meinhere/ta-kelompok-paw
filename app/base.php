<?php 

define("HOST", "localhost");
define("DBNAME", "ta-paw2");
define("USERNAME", "root");
define("PASSWORD", "");

define("BASEURL", "http://localhost/ta-kelompok-paw");
define("BASEASSET", "http://localhost/ta-kelompok-paw/assets");

define("DB", new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));