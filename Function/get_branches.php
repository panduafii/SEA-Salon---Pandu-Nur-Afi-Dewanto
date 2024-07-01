<?php
include 'config.php';

try {
    $stmt = $conn->prepare("SELECT branch_id, branch_name, branch_location, opening_time, closing_time FROM branches");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $branches = [];
    while ($row = $result->fetch_assoc()) {
        $branches[] = [
            'branch_id' => htmlspecialchars($row['branch_id']),
            'branch_name' => htmlspecialchars($row['branch_name']),
            'branch_location' => htmlspecialchars($row['branch_location']),
            'opening_time' => htmlspecialchars($row['opening_time']),
            'closing_time' => htmlspecialchars($row['closing_time'])
        ];
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($branches);

} catch (Exception $e) {
    error_log($e->getMessage());
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
