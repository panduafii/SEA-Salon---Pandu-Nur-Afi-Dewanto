<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id']) && $_SESSION['role'] == 'customer') {
    $branch_id = $_POST['res_branch'];
    $name = $_POST['res_name'];
    $phone = $_POST['res_phone'];
    $service = $_POST['res_service'];
    $datetime = $_POST['res_datetime'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO reservations (user_id, branch_id, name, phone, service, reservation_datetime) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $user_id, $branch_id, $name, $phone, $service, $datetime);

    if ($stmt->execute()) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Unauthorized access!";
}
?>
