<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['res_name'];
    $phone = $_POST['res_phone'];
    $service = $_POST['res_service'];
    $datetime = $_POST['res_datetime'];

    if (empty($name) || empty($phone) || empty($service) || empty($datetime)) {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO reservations (name, phone, service, reservation_datetime) VALUES ('$name', '$phone', '$service', '$datetime')";

        if ($conn->query($sql) === TRUE) {
            echo "Reservation Successful";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
