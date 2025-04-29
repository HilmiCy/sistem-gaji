<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');  // Koneksi ke database

// Menangani pencarian
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Modifikasi query untuk pencarian
$sql = "SELECT * FROM karyawan WHERE nama LIKE '%$search%' OR kode_karyawan LIKE '%$search%' OR jabatan LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
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

<!-- Topbar Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="../dashboard.php">
    <img src="../assets/img/logo.png" alt="Logo" class="img-fluid me-2" style="height: 40px;"> 
    Dashboard
    </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="../slip_gaji/index.php">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../detail_gaji/index.php">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <h2 class="text-center mb-4">Daftar Karyawan</h2>

    <!-- Tombol Tambah dan Form Pencarian -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <a href="tambah.php" class="btn btn-success mb-2">Tambah Karyawan</a>

    <form method="POST" action="" class="d-flex" style="gap: 0.5rem;">
        <input type="text" class="form-control" name="search" placeholder="Cari Karyawan..." value="<?php echo $search; ?>">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</div>

    <!-- Tabel Karyawan -->
    <table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Kode Karyawan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jabatan</th>
            <th>No Telepon</th>
            <th>Email</th>
            <th>No Rekening</th>
            <th>Rekening Bank</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['kode_karyawan']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['jabatan']; ?></td>
                <td><?php echo $row['no_telpon']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['no_rekening']; ?></td>
                <td><?php echo $row['rek_bank']; ?></td>
                <td>
                    <a href="edit.php?kode_karyawan=<?php echo $row['kode_karyawan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?kode_karyawan=<?php echo $row['kode_karyawan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
