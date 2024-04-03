<?php
// Connexion à la base de données MySQL
$host_name = 'db5015586453.hosting-data.io';
$database = 'dbs12730233';
$user_name = 'dbu3547471';
$password = '200060578478500Dunico&2004';

$conn = new mysqli($host_name, $user_name, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
