<?php
// Memulai session
session_start();

// Periksa apakah pengguna sudah login, jika belum, arahkan kembali ke halaman login
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];

// Koneksi ke database
include 'koneksi.php';

// Query untuk mendapatkan daftar kursus
$sql = "SELECT nama_materi FROM materi"; // Pastikan tabel materi dan kolom nama_materi sudah benar
$result = $conn->query($sql);

$materi = [];
if ($result->num_rows > 0) {
    // Ambil setiap baris sebagai array
    while($row = $result->fetch_assoc()) {
        $materi[] = $row['nama_materi'];
    }
} else {
    $materi[] = "Tidak ada materi tersedia";
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - EduCerdas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background-color: rgba(128, 128, 128, 0.055);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            width: 80%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center; /* Tambahkan untuk mengatur posisi tombol ke tengah */
        }

        h1 {
            color: #240750;
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #240750;
            color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        li:hover {
            background-color: #3d107f;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center; /* Untuk memposisikan tombol di tengah */
        }

        button {
            background-color: #240750;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3d107f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Materi Kursus</h1>
        <ul>
            <?php foreach($materi as $m): ?>
                <li><?php echo $m; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="button-container">
            <button onclick="window.location.href='dashboard_pelajar.php'">Kembali</button>
        </div>
    </div>
</body>
</html>