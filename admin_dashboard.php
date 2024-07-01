<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login_register.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SEA Salon</title>
    <link rel="stylesheet" href="CSS/adminDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Branded+Hand&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <header class="Header">
            <h1>SEA Salon</h1>
            <p class="lead">Beauty and Elegance Redefined</p>
        </header>
        <h1 class="TextDash">Dashboard Admin</h1>
        <h2 class="userWelcome">Selamat Datang, Admin</h2>

        <h3 class="TextDash">Daftar Reservasi</h3>
        <div id="reservations_list" class="formLayanan">
            <!-- Reservasi akan dimuat di sini -->
        </div>

        <h3 class="TextDash">Daftar Cabang</h3>
        <div id="branches_list" class="formLayanan">
            <!-- Cabang akan dimuat di sini -->
        </div>

        <!-- Form Tambah Cabang Baru -->
        <section class="formCabang">
            <h3>Tambahkan Cabang Baru</h3>
            <form id="branchForm" method="POST">
                <div class="form-group">
                    <label for="branch_name">Nama Cabang:</label>
                    <input type="text" id="branch_name" name="branch_name" required>
                </div>
                <div class="form-group">
                    <label for="branch_location">Lokasi Cabang:</label>
                    <input type="text" id="branch_location" name="branch_location" required>
                </div>
                <div class="form-group">
                    <label for="opening_time">Jam Buka:</label>
                    <input type="time" id="opening_time" name="opening_time" required>
                </div>
                <div class="form-group">
                    <label for="closing_time">Jam Tutup:</label>
                    <input type="time" id="closing_time" name="closing_time" required>
                </div>
                <button class="submitButton" type="button" onclick="addBranch()">Tambah Cabang</button>
            </form>
        </section>

        <h3 class="TextDash">Daftar Layanan</h3>
        <div id="services_list" class="formLayanan">
            <!-- Layanan akan dimuat di sini -->
        </div>

        <!-- Form Tambah Layanan Baru -->
        <section class="formIsiLayanan">
            <h3>Tambahkan Layanan Baru</h3>
            <form id="serviceForm" method="POST">
                <div class="form-group">
                    <label for="service_name">Nama Layanan:</label>
                    <input type="text" id="service_name" name="service_name" required>
                </div>
                <div class="form-group">
                    <label for="branch_id">Cabang:</label>
                    <select id="branch_id" name="branch_id" required>
                        <!-- Cabang akan dimuat di sini -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration">Durasi (menit):</label>
                    <input type="number" id="duration" name="duration" required>
                </div>
                <button class="submitButton" type="button" onclick="addService()">Tambah Layanan</button>
            </form>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchBranches();
            fetchServices();
            fetchReservations();
        });

        // Cabang
        function addBranch() {
            var formData = new FormData(document.getElementById('branchForm'));
            fetch('Function/add_branch.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fetchBranches(); 
            })
            .catch(error => console.error('Error:', error));
        }

        function fetchBranches() {
            fetch('Function/get_branches.php')
            .then(response => response.json())
            .then(data => {
                const branchesList = document.getElementById('branches_list');
                branchesList.innerHTML = '';
                const branchSelect = document.getElementById('branch_id');
                branchSelect.innerHTML = '';
                data.forEach(branch => {
                    branchesList.innerHTML += `<div class='service-item'>
                        ${branch.branch_name} - ${branch.branch_location} (Buka: ${branch.opening_time} Tutup: ${branch.closing_time})
                        <button onclick="hapusCabang(${branch.branch_id})">Hapus</button>
                    </div>`;
                    branchSelect.innerHTML += `<option value="${branch.branch_id}">${branch.branch_name}</option>`;
                });
            })
            .catch(error => console.error('Error:', error));
        }

        function hapusCabang(branch_id) {
            if (confirm("Apakah Anda yakin ingin menghapus cabang ini?")) {
                fetch('Function/delete_branch.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `branch_id=${branch_id}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchBranches(); // Refresh the list of branches
                })
                .catch(error => console.error('Error:', error));
            }
        }


        //Pelayanan
        function addService() {
            var formData = new FormData(document.getElementById('serviceForm'));
            fetch('Function/add_services.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fetchServices();
            })
            .catch(error => console.error('Error:', error));
        }

        function fetchServices() {
            fetch('Function/get_services.php')
            .then(response => response.json())
            .then(data => {
                console.log("Services data received:", data); // Debugging: Log the services data
                const servicesList = document.getElementById('services_list');
                servicesList.innerHTML = '';
                data.forEach(service => {
                    console.log("Processing service:", service); // Debugging: Log each service object
                    if (service.service_id && !isNaN(service.service_id) && service.service_id > 0) {
                        servicesList.innerHTML += `<div class='service-item'>
                            ${service.service_name} - ${service.duration} menit (${service.branch_name})
                            <button onclick="hapusLayanan(${service.service_id})">Hapus</button>
                        </div>`;
                    } else {
                        console.error("Invalid service ID:", service.service_id); // Debugging: Log invalid service ID
                    }
                });
            })
            .catch(error => console.error('Error fetching services:', error));
        }

        function hapusLayanan(service_id) {
            console.log("Service ID to delete:", service_id); // Debugging: Log the ID

            // Check if service_id is valid before sending the request
            if (!service_id || isNaN(service_id) || service_id <= 0) {
                alert("ID layanan tidak valid.");
                return;
            }

            if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
                fetch('Function/delete_services.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `service_id=${service_id}`
                })
                .then(response => response.text())
                .then(data => {
                    console.log("Response from server:", data); // Debugging: Log the response
                    alert(data);
                    fetchServices(); // Refresh the list of services
                })
                .catch(error => console.error('Error:', error));
            }
        }



        // Reservasi
        function fetchReservations() {
            fetch('Function/get_reservation.php')
            .then(response => response.json())
            .then(data => {
                const reservationsList = document.getElementById('reservations_list');
                reservationsList.innerHTML = '';
                data.forEach(reservation => {
                    reservationsList.innerHTML += `<div class='service-item'>
                        ${reservation.name} - ${reservation.service} di ${reservation.branch_name} pada ${reservation.datetime}
                        <button onclick="selesaikanReservasi(${reservation.id})">Selesai</button>
                    </div>`;
                });
            })
            .catch(error => console.error('Error:', error));
        }

        function selesaikanReservasi(reservation_id) {
            if (confirm("Apakah Anda yakin ingin menyelesaikan reservasi ini?")) {
                fetch('Function/delete_reservation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `reservation_id=${reservation_id}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchReservations(); // Refresh the list of reservations
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>
