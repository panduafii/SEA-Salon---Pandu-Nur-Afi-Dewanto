<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];

    // Hapus reservasi dari database
    $query = "DELETE FROM reservations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reservation_id);

    if ($stmt->execute()) {
        echo "Reservasi berhasil diselesaikan.";
    } else {
        echo "Gagal menyelesaikan reservasi.";
    }

    $stmt->close();
    $conn->close();
}
?>
