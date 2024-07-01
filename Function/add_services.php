<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST['service_name'];
    $branch_id = $_POST['branch_id'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO services (service_name, branch_id, duration) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $service_name, $branch_id, $duration);

    if ($stmt->execute()) {
        echo "Layanan berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
