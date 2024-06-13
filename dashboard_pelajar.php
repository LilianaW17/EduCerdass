<?php
session_start(); // Mulai session

include 'koneksi.php';

// Periksa apakah pengguna sudah login, jika belum, arahkan kembali ke halaman login
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Jika nama "Pelajar" di database tidak tersedia, gunakan nama pengguna yang saat ini login
$sql = "SELECT username FROM pelajar LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['username'])) {
        $username = $row['username'];
    }
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edu Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0px;
            font-family: "Poppins", sans-serif;
            background-color: rgba(128, 128, 128, 0.055);
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            background-color: #240750;
            color: white;
            width: 250px;
            height: 100vh;
            overflow: auto;
            box-shadow: 3px 0px 4px rgba(0, 0, 0, 0.116);
        }

        .logo {
            margin-left: 25px;
            font-size: 24px;
            margin-top: 20px;
        }

        .selectors {
            display: flex;
            align-items: center;
            height: 50px;
            padding-left: 30px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .selectors i {
            width: 20px;
            margin-right: 10px;
        }

        .selectors:hover {
            background: linear-gradient(95deg, rgba(63, 94, 251, 0.123) 0%, rgba(177, 86, 223, 0.144) 100%);
            color: rgb(41, 41, 41);
        }

        .activeBar {
            background: linear-gradient(95deg, rgba(63, 94, 251, 1) 0%, rgba(178, 86, 223, 1) 100%);
            color: white;
        }

        .selectors div {
            font-size: 15px;
        }

        .body {
            overflow-y: auto;
            width: 100%;
            flex: 1;
            margin-left: 100px;
        }

        .topBar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .h2::after {
            content: "";
            display: block;
            width: 60px;
            height: 3px;
            background-color: #240750;
            margin-top: 8px;
        }

        .body h2 {
            margin-top: 20px;
            margin-bottom: 30px;
            color: #240750;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1 class="logo">EDUCERDAS</h1>
            <div class="selectors activeBar" onclick="window.location.href='dashboard_pelajar.php'">
                <i class="fas fa-chart-pie"></i>
                <div>Dashboard</div>
            </div>
            <div class="selectors" onclick="window.location.href='course_pelajar.php'">
                <i class="fas fa-book"></i>
                <div>Course</div>
            </div>
            <div class="selectors" onclick="alert('Fitur ini belum tersedia')">
                <i class="fas fa-question-circle"></i>
                <div>Quiz</div>
            </div>
            <div class="selectors" onclick="alert('Fitur ini belum tersedia')">
                <i class="fas fa-file-alt"></i>
                <div>Exams</div>
            </div>
            <div class="selectors" onclick="alert('Fitur ini belum tersedia')">
                <i class="fas fa-user"></i>
                <div>Profile</div>
            </div>
        </div>

        <div class="body">
            <div class="topBar">
                <div>
                    <h2 class="h2">Selamat Datang, <?php echo $username; ?>!</h2>
                </div>
            </div>

            <!-- Konten dashboard lainnya di sini -->
        </div>
    </div>
</body>
</html>