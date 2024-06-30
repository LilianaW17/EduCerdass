<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

// Inisialisasi variabel pesan
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email_tutor = $_POST['email_tutor'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $bidang_ahli = $_POST['bidang_ahli'];

    // Hash password sebelum menyimpannya ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database
    $sql_insert = "INSERT INTO tutors (username, password, nama_depan, nama_belakang, jenis_kelamin, email_tutor, nomor_telepon, alamat, bidang_ahli) 
                   VALUES ('$username', '$hashed_password', '$nama_depan', '$nama_belakang', '$jenis_kelamin', '$email_tutor', '$nomor_telepon', '$alamat', '$bidang_ahli')";

    if ($conn->query($sql_insert) === TRUE) {
        $message = "Tutor baru berhasil ditambahkan.";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tutor</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input, select, textarea {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background: #48BB78;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #38A169;
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
        .message {
            text-align: center;
            margin-top: 10px;
            color: #3182CE;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Tutor</h1>
        <form method="post" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="nama_depan">Nama Depan</label>
            <input type="text" id="nama_depan" name="nama_depan" required>

            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" id="nama_belakang" name="nama_belakang" required>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Pria</option>
                <option value="Perempuan">Wanita</option>
            </select>

            <label for="email_tutor">Email Tutor</label>
            <input type="email" id="email_tutor" name="email_tutor" required>

            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" required>

            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" required></textarea>

            <label for="bidang_ahli">Bidang Ahli</label>
            <input type="text" id="bidang_ahli" name="bidang_ahli" required>

            <button type="submit">Tambahkan Tutor</button>
        </form>
        <a href="tutors_admin.php" class="button-back">Kembali</a>
        <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
    </div>
</body>
</html>