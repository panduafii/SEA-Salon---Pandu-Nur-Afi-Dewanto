<?php
include 'config.php';

try {
    $stmt = $conn->prepare("SELECT reservations.id, reservations.name, reservations.service, reservations.reservation_datetime, branches.branch_name 
                            FROM reservations 
                            JOIN branches ON reservations.branch_id = branches.branch_id");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = [
            'id' => htmlspecialchars($row['id']),
            'name' => htmlspecialchars($row['name']),
            'service' => htmlspecialchars($row['service']),
            'datetime' => htmlspecialchars($row['reservation_datetime']),
            'branch_name' => htmlspecialchars($row['branch_name'])
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
