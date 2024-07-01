<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login_register.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - SEA Salon</title>
    <link rel="stylesheet" href="CSS/custDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Branded+Hand&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    
</head>
<body>
    <div class="container">
        <header class="Header">
            <h1>SEA Salon</h1>
            <p class="lead">Beauty and Elegance Redefined</p>
        </header>
        <h1 class="TextDash">Dashboard Pelanggan</h1>
        <h2 class="userWelcome">Selamat Datang, <?php echo htmlspecialchars($_SESSION['full_name']); ?></h2>

        <section class="formLayanan">
            <h3>Layanan Tersedia</h3>
            <div id="services_list">
                <!-- Layanan akan dimuat di sini -->
            </div>
        </section>

        <section class="formReservasi">
            <h3>Buat Reservasi Baru</h3>
            <form id="reservation-form" action="Function/process_reservation.php" method="post">
                <div class="form-group">
                    <label for="res-branch">Cabang:</label>
                    <select id="res-branch" name="res_branch" required>
                        <!-- Cabang akan dimuat di sini -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="res-name">Nama:</label>
                    <input type="text" id="res-name" name="res_name" placeholder="Masukkan nama Anda" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="res-phone">Nomor Telepon Aktif:</label>
                    <input type="tel" id="res-phone" name="res_phone" placeholder="Masukkan nomor telepon Anda" required>
                </div>
                <div class="form-group">
                    <label for="res-service">Jenis Layanan:</label>
                    <select id="res-service" name="res_service" required>
                        <!-- Layanan akan dimuat di sini -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="res-datetime">Tanggal dan Waktu:</label>
                    <input type="datetime-local" id="res-datetime" name="res_datetime" required>
                </div>
                <button class="submitButton" type="submit">Buat Reservasi</button>
            </form>
            
            <div id="reservation-result" class="mt-3">
                <!-- Pesan keberhasilan dan data reservasi akan ditampilkan di sini -->
            </div>
        </section>
        <section class="reservasiAnda">
            <h3>Reservasi Anda</h3>
            <div id="reservations_list">
                <!-- Reservasi akan dimuat di sini -->
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchBranches();
            document.getElementById('res-branch').addEventListener('change', fetchServices);
            fetchReservations();
        });

        function fetchBranches() {
            fetch('Function/get_branches.php')
            .then(response => response.json())
            .then(data => {
                const branchSelect = document.getElementById('res-branch');
                branchSelect.innerHTML = '';
                data.forEach(branch => {
                    branchSelect.innerHTML += `<option value="${branch.id}">${branch.name}</option>`;
                });
                fetchServices(); // Memuat layanan berdasarkan cabang yang dipilih pertama kali
            })
            .catch(error => console.error('Error:', error));
        }

        function fetchServices() {
            const branchId = document.getElementById('res-branch').value;
            fetch('Function/get_services.php?branch_id=' + branchId)
            .then(response => response.json())
            .then(data => {
                const servicesList = document.getElementById('services_list');
                const serviceSelect = document.getElementById('res-service');
                servicesList.innerHTML = '';
                serviceSelect.innerHTML = '';
                data.forEach(service => {
                    servicesList.innerHTML += `<div class='service-item'>${service.name} - ${service.duration} menit (${service.branch_name})</div>`;
                    serviceSelect.innerHTML += `<option value="${service.name}">${service.name}</option>`;
                });
            })
            .catch(error => console.error('Error:', error));
        }

        function fetchReservations() {
            fetch('Function/get_customer_reservations.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }
                console.log(data); // Debugging: menampilkan data yang diterima di console
                const reservationsList = document.getElementById('reservations_list');
                reservationsList.innerHTML = '';
                data.forEach(reservation => {
                    reservationsList.innerHTML += `<div class='reservation-item'>${reservation.service} pada ${reservation.datetime}</div>`;
                });
            })
            .catch(error => {
                console.error('Error:', error); // Debugging: menampilkan error yang mungkin terjadi
            });
        }

        document.getElementById('reservation-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const branch = document.getElementById('res-branch').value;
            const name = document.getElementById('res-name').value;
            const phone = document.getElementById('res-phone').value;
            const service = document.getElementById('res-service').value;
            const datetime = document.getElementById('res-datetime').value;

            fetch('Function/process_reservation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `res_branch=${encodeURIComponent(branch)}&res_name=${encodeURIComponent(name)}&res_phone=${encodeURIComponent(phone)}&res_service=${encodeURIComponent(service)}&res_datetime=${encodeURIComponent(datetime)}`
            })
            .then(response => response.text())
            .then(data => {
                const resultDiv = document.getElementById('reservation-result');
                resultDiv.innerHTML = `
                    <h4>Reservasi Berhasil!</h4>
                    <p>Cabang: ${branch}</p>
                    <p>Nama: ${name}</p>
                    <p>Telepon: ${phone}</p>
                    <p>Layanan: ${service}</p>
                    <p>Tanggal dan Waktu: ${datetime}</p>
                `;
                document.getElementById('reservation-form').reset();
                fetchReservations();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi masalah dengan pengiriman data: ' + error.message);
            });
        });
    </script>
</body>
</html>
