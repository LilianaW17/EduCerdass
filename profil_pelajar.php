<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT username, nama_depan, nama_belakang, email_pelajar, jenis_kelamin FROM pelajar WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userName, $firstName, $lastName, $email, $gender);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .container h2 {
            color: #333;
        }
        .profile-item {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .profile-item span {
            font-weight: bold;
        }
        .edit-button {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-button:hover {
            background-color: #555;
        }
        .logout {
            text-align: center;
            margin-top: 10px;
        }
        .logout a {
            color: #333;
            text-decoration: none;
        }
        .logout a:hover {
            text-decoration: underline;
        }
        .back-button {
            text-align: center;
            margin-top: 10px;
        }
        .back-button a {
            color: #333;
            text-decoration: none;
        }
        .back-button a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Pelajar</h2>
        <div class="profile-item">
            <span>Username:</span> <?php echo htmlspecialchars($userName); ?>
        </div>
        <div class="profile-item">
            <span>Nama Depan:</span> <?php echo htmlspecialchars($firstName); ?>
        </div>
        <div class="profile-item">
            <span>Nama Belakang:</span> <?php echo htmlspecialchars($lastName); ?>
        </div>
        <div class="profile-item">
            <span>Email:</span> <?php echo htmlspecialchars($email); ?>
        </div>
        <div class="profile-item">
            <span>Jenis Kelamin:</span> <?php echo htmlspecialchars($gender); ?>
        </div>
        <a href="edit_profil_pelajar.php" class="edit-button">Edit Profil</a>
        <div class="back-button">
            <a href="dashboard_pelajar.php">Kembali</a>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

    </div>
</body>
</html>