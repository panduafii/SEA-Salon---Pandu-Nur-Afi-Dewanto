<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, full_name, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $full_name, $password_hash, $role);
        $stmt->fetch();

        if (md5($password) == $password_hash) {
            $new_hash = password_hash($password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
            $update_stmt->bind_param("si", $new_hash, $user_id);
            $update_stmt->execute();
            $update_stmt->close();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['role'] = $role;
            redirectUserBasedOnRole($role);
        } elseif (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['role'] = $role;
            redirectUserBasedOnRole($role);
        } else {
            echo "Password salah. Silakan coba lagi.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
    $stmt->close();
    $conn->close();
}

function redirectUserBasedOnRole($role) {
    if ($role == 'admin') {
        header('Location: ../admin_dashboard.php');
    } else {
        header('Location: ../customer_dashboard.php');
    }
    exit;
}
?>
