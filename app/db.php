<?php

$host = getenv('DB_HOST') ?: 'mysql-service';
$user = getenv('DB_USER') ?: 'appuser';
$password = getenv('DB_PASSWORD') ?: 'apppassword';
$database = getenv('DB_NAME') ?: 'appdb';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
