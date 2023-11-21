<?php

define("HOST", "localhost");
define("DBNAME", "store");
define("USERNAME", "root");
define("PASSWORD", "");

define("BASEURL", "http://localhost:8080/ta-kelompok-paw");
define("BASEASSET", "http://localhost:8080/ta-kelompok-paw/assets");

define("DB", new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));