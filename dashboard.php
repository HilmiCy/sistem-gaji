<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('config/koneksi.php');  // koneksi ke database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: white !important;
            text-decoration: none;
            font-size: 1.1rem;
            margin-right: 15px;
        }
        .navbar-nav .nav-link:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .container-fluid {
            margin-top: 30px;
            max-width: 1200px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            font-size: 1.5rem;
            color: #007bff;
        }
        .card-text {
            font-size: 1.2rem;
            color: #333;
        }
        .row.mt-4 {
            justify-content: center;
        }
        /* Menambahkan logo ke navbar */
        .navbar-brand img {
            width: 50px; /* Menyesuaikan lebar logo */
            height: auto; /* Menjaga proporsi logo */
            margin-right: 15px;
        }
    </style>
</head>
<body>

<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="dashboard.php">
            <img src="assets/img/logo.png" alt="Logo"> Dashboard
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="karyawan/index.php">Data Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perusahaan/index.php">Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="slip_gaji/index.php">Slip Gaji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="keterangan_gaji/index.php">Keterangan Gaji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="detail_gaji/index.php">Detail Gaji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout/index.php">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <h2 class="text-center mb-4">Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
    <p class="text-center">Ini adalah halaman dashboard Anda. Berikut adalah informasi terkini.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Karyawan</h5>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS total FROM karyawan");
                    $data = $result->fetch_assoc();
                    echo "<p class='card-text'>" . $data['total'] . " orang</p>";
                    ?>
                </div>
            </div>
        </div>
        <!-- Tambahkan kartu lain sesuai kebutuhan -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
