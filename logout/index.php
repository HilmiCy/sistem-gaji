<?php
session_start();

// Proses logout
if (isset($_POST['logout'])) {
    session_destroy();  // Hapus sesi dan logout
    header("Location: ../login/index.php");  // Redirect ke halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Logout - Sistem Penggajian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        p {
            font-size: 1.1rem;
        }

        .spinner-border {
            margin-top: 20px;
            width: 3rem;
            height: 3rem;
        }

        .confirm-btn {
            font-size: 1.1rem;
            background-color: #d9534f;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .cancel-btn {
            font-size: 1.1rem;
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
</head>
<body>

<div class="modal-content">
    <h1>Konfirmasi Logout</h1>
    <p>Apakah Anda yakin ingin keluar dari sistem?</p>
    <form method="POST" action="">
        <button type="submit" name="logout" class="confirm-btn">Ya, Logout</button>
        <a href="../dashboard.php" class="cancel-btn">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
