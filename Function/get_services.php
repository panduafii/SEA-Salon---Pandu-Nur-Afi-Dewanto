<?php
include 'config.php';

try {
    // Membuat statement
    $stmt = $conn->prepare("SELECT services.id AS service_id, services.service_name, services.duration, branches.branch_name FROM services JOIN branches ON services.branch_id = branches.branch_id");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    // Menjalankan statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Menyimpan hasil ke dalam array
    $services = [];
    while ($row = $result->fetch_assoc()) {
        $services[] = [
            'service_id' => htmlspecialchars($row['service_id']),
            'service_name' => htmlspecialchars($row['service_name']),
            'duration' => htmlspecialchars($row['duration']),
            'branch_name' => htmlspecialchars($row['branch_name'])
        ];
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Mengembalikan hasil dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($services);

} catch (Exception $e) {
    error_log($e->getMessage()); // Log error ke file log server
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
