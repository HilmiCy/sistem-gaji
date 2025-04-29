<?php
include('../config/koneksi.php'); // koneksi database

// Inisialisasi variabel pencarian
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Query pencarian berdasarkan no_ref atau kode_karyawan
$sql = "SELECT * FROM slip_gaji WHERE no_ref LIKE '%$search%' OR kode_karyawan LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

// Cek jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Slip Gaji</title>
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
        img {
    max-width: 100%;
    height: auto;
}

    </style>
</head>
<body>

<!-- Topbar Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="../dashboard.php">
    <img src="../assets/img/logo.png" alt="Logo" class="img-fluid me-2" style="height: 40px; max-height: 40px;">
    Dashboard
</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link " href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../detail_gaji/index.php">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <h2 class="text-center mb-4">Daftar Slip Gaji</h2>

    <!-- Tombol Tambah dan Form Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="tambah.php" class="btn btn-success mb-2">Tambah Slip Gaji</a>
        <form method="POST" action="" class="d-flex" style="gap: 0.5rem;">
            <input type="text" class="form-control" name="search" placeholder="Cari Slip Gaji..." value="<?php echo $search; ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <!-- Tabel Slip Gaji -->
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No. Ref</th>
                <th>Tanggal</th>
                <th>Total Gaji</th>
                <th>Kode Karyawan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Mengecek apakah ada hasil
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['no_ref']; ?></td>
                        <td><?php echo $row['tgl']; ?></td>
                        <td><?php echo number_format($row['total_gaji'], 2, ',', '.'); ?></td>
                        <td><?php echo $row['kode_karyawan']; ?></td>
                        <td>
                            <a href="edit.php?no_ref=<?php echo $row['no_ref']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?no_ref=<?php echo $row['no_ref']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada data slip gaji.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
