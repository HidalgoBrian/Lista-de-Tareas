<?php
$config = parse_ini_file(__DIR__ . "/config.ini");

$host = $config['host'];
$user = $config['username'];
$pass = $config['password'];
$dbname = $config['database'];

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

return $conn;

