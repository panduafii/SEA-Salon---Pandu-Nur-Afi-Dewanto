<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Membuat hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Mengecek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Menyimpan data user baru
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone_number, password_hash, role) VALUES (?, ?, ?, ?, 'customer')");
        $stmt->bind_param("ssss", $full_name, $email, $phone_number, $password_hash);
        if ($stmt->execute()) {
            echo "Pengguna berhasil terdaftar!";
            // Redirect ke halaman login atau dashboard
            header("Location: ../login_register.php"); 
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>
