<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'bentatecnologies_database';

try { //Conexión a la base de datos por PDO
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
