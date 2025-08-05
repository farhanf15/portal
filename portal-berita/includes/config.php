<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "portal_berita";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "CREATE TABLE IF NOT EXISTS berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    tanggal_publikasi DATETIME DEFAULT CURRENT_TIMESTAMP,
    penulis VARCHAR(100)
)";

mysqli_query($conn, $query);

$query = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

mysqli_query($conn, $query);

$check_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='admin'");
if (mysqli_num_rows($check_admin) == 0) {
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('admin', '$password')");
}
?>