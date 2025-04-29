<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');

// Inisialisasi pencarian
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Query ambil data detail gaji dengan join ke slip_gaji dan keterangan_gaji
$sql = "SELECT dg.no_ref, dg.no, kg.keterangan, dg.nominal 
        FROM detail_gaji dg
        JOIN keterangan_gaji kg ON dg.no = kg.no
        WHERE dg.no_ref LIKE '%$search%' OR kg.keterangan LIKE '%$search%'";
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
    <title>Detail Gaji</title>
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
                <li class="nav-item"><a class="nav-link" href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="../karyawan/index.php">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="../slip_gaji/index.php">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container-fluid">
    <h3 class="text-center mb-4">Data Detail Gaji</h3>

    <!-- Form Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="tambah.php" class="btn btn-success mb-2">Tambah Detail Gaji</a>
        <form method="POST" action="" class="d-flex" style="gap: 0.5rem;">
            <input type="text" class="form-control" name="search" placeholder="Cari No. Ref / Keterangan" value="<?= $search ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>

    <!-- Tabel -->
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No. Ref</th>
                <th>No. Keterangan</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['no_ref']) ?></td>
                        <td><?= $row['no'] ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td><?= number_format($row['nominal'], 2, ',', '.') ?></td>
                        <td>
                            <a href="edit.php?no_ref=<?= $row['no_ref'] ?>&no=<?= $row['no'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?no_ref=<?= $row['no_ref'] ?>&no=<?= $row['no'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Tidak ada data ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
