-- Membuat tabel users
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL
);

-- Menambahkan akun admin secara default
INSERT INTO users (full_name, email, phone_number, password_hash, role)
VALUES ('Thomas N', 'thomas.n@compfest.id', '08123456789', MD5('Admin123'), 'admin');

-- Membuat tabel untuk cabang
CREATE TABLE branches (
    branch_id INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(255) NOT NULL,
    branch_location VARCHAR(255) NOT NULL,
    opening_time TIME NOT NULL,
    closing_time TIME NOT NULL
);

-- Membuat tabel jenis service
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    branch_id INT NOT NULL,
    FOREIGN KEY (branch_id) REFERENCES branches(branch_id)
);

-- Menambahkan data sampel ke tabel branches dan services
INSERT INTO branches (branch_name, branch_location, opening_time, closing_time) VALUES
('Central Branch', 'Central City', '09:00:00', '21:00:00'),
('East Branch', 'East City', '10:00:00', '20:00:00');

INSERT INTO services (service_name, duration, branch_id) VALUES
('Haircuts and Styling', 60, 1),
('Manicure and Pedicure', 45, 1),
('Facial Treatments', 50, 1),
('Haircuts and Styling', 60, 2),
('Manicure and Pedicure', 45, 2);

-- Membuat tabel reservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    branch_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    service VARCHAR(50) NOT NULL,
    reservation_datetime DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (branch_id) REFERENCES branches(branch_id)
);

-- Membuat tabel reviews
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL
);
