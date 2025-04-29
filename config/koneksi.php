<?php
$host = 'localhost';          // Host
$username = 'root';           // Nama pengguna MySQL
$password = '';               // Password (kosongkan jika tidak ada)
$dbname = ' db_gaji_karyawan'; // Nama database yang digunakan

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>