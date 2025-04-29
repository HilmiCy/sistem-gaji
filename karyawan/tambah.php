<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_karyawan = $_POST['kode_karyawan'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];
    $email = $_POST['email'];
    $no_rekening = $_POST['no_rekening'];
    $rek_bank = $_POST['rek_bank'];
    $id_perusahaan = $_POST['id_perusahaan'];

    $sql = "INSERT INTO karyawan (kode_karyawan, nama, jabatan, alamat, no_telpon, email, no_rekening, rek_bank, id) 
            VALUES ('$kode_karyawan', '$nama', '$jabatan', '$alamat', '$no_telpon', '$email', '$no_rekening', '$rek_bank', '$id_perusahaan')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Karyawan berhasil ditambahkan'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
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

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../dashboard.php">
            <img src="../assets/img/logo.png" alt="Logo"> Dashboard
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="../slip_gaji/index.php">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../detail_gaji.index.php">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Ganti bagian <div class="container"> sampai penutup </div> -->
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
            Form Tambah Karyawan
        </div>
        <div class="card-body p-4">
            <form action="tambah.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kode_karyawan" class="form-label">Kode Karyawan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" name="kode_karyawan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                            <input type="text" class="form-control" name="jabatan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="no_telpon" class="form-label">No Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                            <input type="text" class="form-control" name="no_telpon" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="no_rekening" class="form-label">No Rekening</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-credit-card-2-back-fill"></i></span>
                            <input type="text" class="form-control" name="no_rekening" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="rek_bank" class="form-label">Rekening Bank</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-bank"></i></span>
                            <input type="text" class="form-control" name="rek_bank" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="id_perusahaan" class="form-label">ID Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                            <input type="number" class="form-control" name="id_perusahaan" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan Data</button>
                    <a href="index.php" class="btn btn-outline-secondary">Kembali ke Daftar Karyawan</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
