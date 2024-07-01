<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    error_log("POST data: " . print_r($_POST, true));

    $customer_name = $_POST['customer_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    error_log("Received data - Name: $customer_name, Rating: $rating, Comment: $comment");

    $sql = "INSERT INTO reviews (customer_name, rating, comment) VALUES ('$customer_name', '$rating', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "New review submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
