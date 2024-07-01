<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log POST data untuk debugging
    error_log("POST data: " . print_r($_POST, true));

    // Menggunakan filter_input untuk mendapatkan dan memvalidasi service_id
    $service_id = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
    error_log("Service ID received after filter_input: " . $service_id); // Log the received ID after conversion

    if ($service_id > 0) {
        error_log("Valid service ID: " . $service_id); // Log for valid ID
        $query = "DELETE FROM services WHERE id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            echo "Gagal mempersiapkan penghapusan: " . $conn->error;
            exit;
        }

        $stmt->bind_param("i", $service_id);
        if ($stmt->execute()) {
            // Pastikan baris benar-benar terhapus
            if ($stmt->affected_rows > 0) {
                echo "Layanan berhasil dihapus.";
            } else {
                echo "Gagal menghapus layanan: Tidak ada baris yang dihapus.";
                error_log("Execute failed: No rows affected.");
            }
        } else {
            error_log("Execute failed: " . $stmt->error);
            echo "Gagal menghapus layanan: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gagal menghapus layanan: ID layanan tidak valid.";
        error_log("Service ID not valid: " . $service_id);
    }

    $conn->close();
}
?>
