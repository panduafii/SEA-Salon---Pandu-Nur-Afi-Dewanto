<?php
include 'config.php';

try {
    // Membuat statement
    $stmt = $conn->prepare("SELECT name, service, reservation_datetime FROM reservations");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    // Menjalankan statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Menyimpan hasil ke dalam array
    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = [
            'name' => htmlspecialchars($row['name']),
            'service' => htmlspecialchars($row['service']),
            'datetime' => htmlspecialchars($row['reservation_datetime'])
        ];
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($reservations);

} catch (Exception $e) {
    error_log($e->getMessage()); 
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
