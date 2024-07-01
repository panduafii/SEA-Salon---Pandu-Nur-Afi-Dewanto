<?php
include 'config.php';
session_start();

$sql = "SELECT customer_name, rating, comment FROM reviews";
$result = $conn->query($sql);

$reviews = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

echo json_encode($reviews);

$conn->close();
?>
