<?php
session_start();

// Default password (dalam aplikasi nyata, seharusnya disimpan dengan aman di database)
$correct_password = "6122005";
$esp32_ip = "192.168.1.100"; // Ganti dengan IP ESP32 Anda

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        $entered_password = $_POST['password'];
        
        if ($entered_password === $correct_password) {
            $_SESSION['authenticated'] = true;
            $_SESSION['auth_time'] = time();
            $message = "Autentikasi berhasil! Sistem siap diaktifkan.";
            $message_type = "success";
        } else {
            $message = "Password salah! Silakan coba lagi.";
            $message_type = "error";
            // Catat percobaan gagal
            if (!isset($_SESSION['failed_attempts'])) {
                $_SESSION['failed_attempts'] = 1;
            } else {
                $_SESSION['failed_attempts']++;
            }
        }
    }
    
    if (isset($_POST['activate']) && isset($_SESSION['authenticated'])) {
        // Kirim perintah ke ESP32 via API
        $url = "http://" . $esp32_ip . "/activate";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($response === false || $http_code !== 200) {
            $message = "Gagal terhubung ke ESP32. Periksa koneksi jaringan.";
            $message_type = "error";
        } else {
            // Mulai hitung mundur
            $_SESSION['countdown_started'] = true;
            $_SESSION['countdown_time'] = time();
            $message = "Sistem diaktifkan! Bom akan meledak dalam 3 detik.";
            $message_type = "success";
            
            // Redirect untuk menghindari resubmission form
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Handle countdown
$countdown = false;
if (isset($_SESSION['countdown_started']) && $_SESSION['countdown_started']) {
    $elapsed = time() - $_SESSION['countdown_time'];
    $remaining = 3 - $elapsed;
    
    if ($remaining <= 0) {
        // Countdown selesai, ledakan
        $countdown = "BOOM!";
        session_destroy();
    } else {
        $countdown = $remaining;
    }
}
?>
