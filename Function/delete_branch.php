<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $branch_id = intval($_POST['branch_id']);

    // Hapus reservasi yang terkait dengan cabang ini
    $query = "DELETE FROM reservations WHERE branch_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $branch_id);
    if (!$stmt->execute()) {
        echo "Gagal menghapus reservasi terkait: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Hapus layanan yang terkait dengan cabang ini
    $query = "DELETE FROM services WHERE branch_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $branch_id);
    if (!$stmt->execute()) {
        echo "Gagal menghapus layanan terkait: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Hapus cabang dari database
    $query = "DELETE FROM branches WHERE branch_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $branch_id);
    if ($stmt->execute()) {
        echo "Cabang berhasil dihapus.";
    } else {
        echo "Gagal menghapus cabang: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
