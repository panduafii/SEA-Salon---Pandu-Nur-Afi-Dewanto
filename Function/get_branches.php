<?php
include 'config.php';

$stmt = $conn->prepare("SELECT branch_id, branch_name, branch_location, opening_time, closing_time FROM branches");
$stmt->execute();
$result = $stmt->get_result();

$branches = [];
while ($row = $result->fetch_assoc()) {
    $branches[] = [
        'id' => htmlspecialchars($row['branch_id']),
        'name' => htmlspecialchars($row['branch_name']),
        'location' => htmlspecialchars($row['branch_location']),
        'opening_time' => htmlspecialchars($row['opening_time']),
        'closing_time' => htmlspecialchars($row['closing_time'])
    ];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($branches);
?>
