<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');

// Ambil data slip gaji dan keterangan untuk dropdown
$slipQuery = mysqli_query($conn, "SELECT no_ref FROM slip_gaji");
$ketQuery = mysqli_query($conn, "SELECT no, keterangan FROM keterangan_gaji");

// Proses simpan
if (isset($_POST['submit'])) {
    $no_ref = $_POST['no_ref'];
    $no_ket = $_POST['no_ket'];
    $nominal = $_POST['nominal'];

    $insert = mysqli_query($conn, "INSERT INTO detail_gaji (no_ref, no, nominal) VALUES ('$no_ref', '$no_ket', '$nominal')");

    if ($insert) {
        echo "<script>alert('Detail gaji berhasil ditambahkan'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan detail gaji');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Gaji</title>
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
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="../dashboard.php">
    <img src="../assets/img/logo.png" alt="Logo" class="img-fluid me-2" style="height: 40px;"> 
    Dashboard
</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                 <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="../karyawan/index.php">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="../slip_gaji/index.php">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>>
            </ul>
        </div>
    </div>
</nav>

<!-- Form Tambah -->
<div class="container-fluid">
    <h3 class="text-center mb-4">Tambah Detail Gaji</h3>
    <div class="row mt-4">
        <div class="col-md-8 mx-auto">
            <div class="card p-4">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3 text-start">
                            <label for="no_ref" class="form-label">No. Ref Slip Gaji</label>
                            <select name="no_ref" id="no_ref" class="form-control" required>
                                <option value="">-- Pilih No. Ref --</option>
                                <?php while ($slip = mysqli_fetch_assoc($slipQuery)) : ?>
                                    <option value="<?= $slip['no_ref'] ?>"><?= $slip['no_ref'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="no_ket" class="form-label">Keterangan</label>
                            <select name="no_ket" id="no_ket" class="form-control" required>
                                <option value="">-- Pilih Keterangan --</option>
                                <?php while ($ket = mysqli_fetch_assoc($ketQuery)) : ?>
                                    <option value="<?= $ket['no'] ?>"><?= $ket['keterangan'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="number" step="0.01" name="nominal" id="nominal" class="form-control" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
