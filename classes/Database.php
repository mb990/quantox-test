<?php
require_once '../../config/config.php';
class Database {
    // seting connection variables
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

}
    // trying to connect to the database
  try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
  }
