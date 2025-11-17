<?php
// Konfigurasi koneksi ESP32
define('ESP32_IP', '192.168.1.100'); // Ganti dengan IP ESP32 Anda

// Konfigurasi database (jika diperlukan)
define('DB_HOST', 'localhost');
define('DB_NAME', 'bomb_control');
define('DB_USER', 'root');
define('DB_PASS', '');

// Koneksi database (jika diperlukan)
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error. Please try again later.");
}
?>
