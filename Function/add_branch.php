<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branch_name = $_POST['branch_name'];
    $branch_location = $_POST['branch_location'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];

    $stmt = $conn->prepare("INSERT INTO branches (branch_name, branch_location, opening_time, closing_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $branch_name, $branch_location, $opening_time, $closing_time);

    if ($stmt->execute()) {
        echo "Cabang berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
