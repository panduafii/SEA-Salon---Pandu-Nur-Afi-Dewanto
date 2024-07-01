<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    error_log("Fetching reservations for user_id: " . $user_id);

    // Siapkan pernyataan SQL untuk mendapatkan reservasi pengguna
    $stmt = $conn->prepare("SELECT service, reservation_datetime FROM reservations WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    // Mengikat parameter dan menjalankan pernyataan
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memproses hasil
    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = [
            'service_name' => htmlspecialchars($row['service']),
            'datetime' => htmlspecialchars($row['reservation_datetime'])
        ];
    }

    // Debugging: log data reservasi
    error_log("Reservations: " . print_r($reservations, true));

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Mengembalikan hasil dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($reservations);

} catch (Exception $e) {
    error_log($e->getMessage()); // Log error ke file log server
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
