<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

$tutor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM tutors WHERE tutor_id = $tutor_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Tutor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #48BB78;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            width: 30%;
            background-color: #48BB78;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .button-back {
            display: block;
            width: 120px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background: #3182CE;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .button-back:hover {
            background: #2B6CB0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Tutor</h1>
        <table>
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
            </tr>
            <tr>
                <th>Nama Depan</th>
                <td><?php echo htmlspecialchars($row['nama_depan']); ?></td>
            </tr>
            <tr>
                <th>Nama Belakang</th>
                <td><?php echo htmlspecialchars($row['nama_belakang']); ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
            </tr>
            <tr>
                <th>Email Tutor</th>
                <td><?php echo htmlspecialchars($row['email_tutor']); ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            </tr>
            <tr>
                <th>Bidang Ahli</th>
                <td><?php echo htmlspecialchars($row['bidang_ahli']); ?></td>
            </tr>
        </table>
        <a href="tutors_admin.php" class="button-back">Kembali</a>
    </div>
</body>
</html>