<?php
// Memulai session
session_start();

// Periksa apakah pengguna sudah login, jika belum, arahkan kembali ke halaman login
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Periksa peran pengguna, hanya tutor yang dapat mengakses halaman ini
if ($_SESSION['role'] !== 'tutor') { // Asumsikan 'role' disimpan di session
    header("Location: dashboard_tutor.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];

// Koneksi ke database
include 'koneksi.php';

// Query untuk mendapatkan daftar kursus
$sql = "SELECT id_materi, nama_materi, deskripsi FROM materi"; // Pastikan tabel materi dan kolom id_materi, nama_materi sudah benar
$result = $conn->query($sql);

$materi = [];
if ($result->num_rows > 0) {
    // Ambil setiap baris sebagai array
    while($row = $result->fetch_assoc()) {
        $materi[] = $row;
    }
} else {
    $materi[] = ['id_materi' => 0, 'nama_materi' => "Tidak ada materi tersedia"];
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
            text-align: center;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li:hover {
            background-color: #3d107f;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
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

        .edit-button {
            background-color: #3d107f;
            margin-left: 10px;
            padding: 8px 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Materi Kursus</h1>
        <ul>
            <?php foreach($materi as $m): ?>
                <li>
                    <span><?php echo $m['nama_materi']; ?></span>
                    <?php if ($m['id_materi'] != 0): ?>
                        <button class="edit-button" onclick="window.location.href='edit_materi.php?id=<?php echo $m['id_materi']; ?>'">Edit</button>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="button-container">
            <button onclick="window.location.href='tambah_materi.php'">Tambah Materi</button>
            <button onclick="window.location.href='dashboard_tutor.php'">Kembali</button>
        </div>
    </div>
</body>
</html>