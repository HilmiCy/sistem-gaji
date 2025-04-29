<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');

// Ambil no_ref slip gaji dari parameter
if (!isset($_GET['no_ref'])) {
    echo "<script>alert('Nomor Referensi slip gaji tidak ditemukan'); window.location.href='index.php';</script>";
    exit();
}

$no_ref = $_GET['no_ref'];
$query = "SELECT * FROM slip_gaji WHERE no_ref = '$no_ref'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='index.php';</script>";
    exit();
}

$data = mysqli_fetch_assoc($result);

// Proses update
if (isset($_POST['submit'])) {
    $kode_karyawan = $_POST['kode_karyawan'];
    $tgl = $_POST['tgl'];
    $total_gaji = $_POST['total_gaji'];

    $update = "UPDATE slip_gaji SET 
                kode_karyawan = '$kode_karyawan', 
                tgl = '$tgl', 
                total_gaji = '$total_gaji' 
               WHERE no_ref = '$no_ref'";
    $hasil = mysqli_query($conn, $update);

    if ($hasil) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Slip Gaji</title>
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
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../dashboard.php">
            <img src="../assets/img/logo.png" alt="Logo" style="width: 50px; margin-right: 10px;"> Dashboard
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link " href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../detail_gaji/.index.php">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Form Edit -->
<div class="container-fluid">
    <h3 class="text-center mb-4">Edit Slip Gaji</h3>
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3 text-start">
                            <label for="kode_karyawan" class="form-label">Karyawan</label>
                            <select class="form-select" id="kode_karyawan" name="kode_karyawan" required>
                                <option value="">Pilih Karyawan</option>
                                <?php
                                // Ambil data karyawan
                                $karyawan_query = "SELECT * FROM karyawan";
                                $karyawan_result = mysqli_query($conn, $karyawan_query);
                                while ($karyawan = mysqli_fetch_assoc($karyawan_result)) {
                                    echo "<option value='".$karyawan['kode_karyawan']."'".($data['kode_karyawan'] == $karyawan['kode_karyawan'] ? " selected" : "").">".$karyawan['nama']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="tgl" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $data['tgl']; ?>" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="total_gaji" class="form-label">Total Gaji</label>
                            <input type="number" class="form-control" id="total_gaji" name="total_gaji" value="<?php echo $data['total_gaji']; ?>" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
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
