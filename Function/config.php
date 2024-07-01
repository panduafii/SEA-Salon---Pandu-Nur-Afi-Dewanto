<?php
$host = "localhost"; 
$dbname = "sea_salon"; 
$username = "root"; 
$password = "root"; //Jika OS windows maka password dikosongkan menjadi $password = " ", jika Mac OS maka diisi root

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
