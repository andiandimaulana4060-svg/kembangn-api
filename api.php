<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

// Simpan log aktivitas
function log_activity($action) {
    $log_file = 'activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "$timestamp - $action\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

// Endpoint untuk status
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'status':
            echo json_encode([
                'status' => 'active',
                'message' => 'Sistem bom terkontrol siap',
                'timestamp' => time()
            ]);
            break;
        default:
            echo json_encode([
                'status' => 'error',
                'message' => 'Aksi tidak dikenali'
            ]);
            break;
    }
    exit;
}

// Endpoint untuk menerima data dari ESP32
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['action'])) {
        switch ($data['action']) {
            case 'activate':
                log_activity('BOM_ACTIVATED');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Perintah aktivasi berhasil dikirim',
                    'timestamp' => time()
                ]);
                break;

            case 'receiveData':  // Endpoint baru untuk menerima data suhu dan kelembaban
                if (isset($data['temperature']) && isset($data['humidity'])) {
                    $temperature = $data['temperature'];
                    $humidity = $data['humidity'];
                    
                    // Simpan data atau proses sesuai kebutuhan
                    log_activity("Data diterima: Temp: $temperature°C, Humidity: $humidity%");
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data diterima dengan sukses',
                        'temperature' => $temperature,
                        'humidity' => $humidity,
                        'timestamp' => time()
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak lengkap, pastikan parameter temperature dan humidity ada'
                    ]);
                }
                break;

            default:
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Aksi tidak dikenali'
                ]);
                break;
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Parameter action tidak ditemukan'
        ]);
    }
    exit;
}

// Default response
echo json_encode([
    'status' => 'error',
    'message' => 'Endpoint tidak valid'
]);
?>
