<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

include('../config/koneksi.php');

if (!isset($_GET['kode_karyawan'])) {
    echo "Kode karyawan tidak ditemukan.";
    exit();
}

$kode_karyawan = $_GET['kode_karyawan'];
$query = mysqli_query($conn, "SELECT * FROM karyawan WHERE kode_karyawan = '$kode_karyawan'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data karyawan tidak ditemukan.";
    exit();
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];
    $email = $_POST['email'];
    $no_rekening = $_POST['no_rekening'];
    $rek_bank = $_POST['rek_bank'];
    $id_perusahaan = $_POST['id_perusahaan'];

    $update = mysqli_query($conn, "UPDATE karyawan SET 
        nama='$nama',
        jabatan='$jabatan',
        alamat='$alamat',
        no_telpon='$no_telpon',
        email='$email',
        no_rekening='$no_rekening',
        rek_bank='$rek_bank',
        id='$id_perusahaan'
        WHERE kode_karyawan='$kode_karyawan'
    ");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand img {
            width: 50px;
            margin-right: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="../dashboard.php">
    <img src="../assets/img/logo.png" alt="Logo" class="img-fluid me-2" style="height: 40px;"> 
    Dashboard
</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../perusahaan/index.php">Data Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="../slip_gaji/index.php">Slip Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../keterangan_gaji/index.php">Keterangan Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Detail Gaji</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout/index.php">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Edit Data Karyawan</div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="kode_karyawan" class="form-label">Kode Karyawan</label>
                    <input type="text" class="form-control" value="<?php echo $data['kode_karyawan']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required value="<?php echo $data['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" required value="<?php echo $data['jabatan']; ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" required><?php echo $data['alamat']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="no_telpon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telpon" required value="<?php echo $data['no_telpon']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required value="<?php echo $data['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">No Rekening</label>
                    <input type="text" class="form-control" name="no_rekening" required value="<?php echo $data['no_rekening']; ?>">
                </div>
                <div class="mb-3">
                    <label for="rek_bank" class="form-label">Rekening Bank</label>
                    <input type="text" class="form-control" name="rek_bank" required value="<?php echo $data['rek_bank']; ?>">
                </div>
                <div class="mb-3">
                    <label for="id_perusahaan" class="form-label">ID Perusahaan</label>
                    <input type="number" class="form-control" name="id_perusahaan" required value="<?php echo $data['id']; ?>">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary w-100">Kembali ke Daftar</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
