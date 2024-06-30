<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT username, nama_depan, nama_belakang, email_pelajar, jenis_kelamin, foto_profil FROM pelajar WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userName, $firstName, $lastName, $email, $gender, $fotoProfil);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelajar - EduCerdas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #240750 0%, #530fa8 100%);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: scale(1.05);
        }
        h2 {
            color: #ffb800;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .profile-item {
            margin-bottom: 15px;
            font-size: 18px;
        }
        .profile-item span {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        .edit-button, .back-button a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #ffb800;
            color: #240750;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .edit-button:hover, .back-button a:hover {
            background-color: #ff9400;
            transform: scale(1.05);
        }
        .back-button {
            margin-top: 15px;
        }
        .profile-picture {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid #ffb800;
            margin-bottom: 15px;
            transition: box-shadow 0.3s ease;
        }
        .profile-picture:hover {
            box-shadow: 0 0 10px rgba(255, 184, 0, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($fotoProfil)) : ?>
            <img src="<?php echo htmlspecialchars($fotoProfil); ?>" alt="Foto Profil" class="profile-picture">
        <?php else : ?>
            <img src="placeholder.jpg" alt="Foto Profil" class="profile-picture">
        <?php endif; ?>
        <h2>Profil Pelajar</h2>
        <div class="profile-item">
            <span>Username</span> <?php echo htmlspecialchars($userName); ?>
        </div>
        <div class="profile-item">
            <span>Nama Depan</span> <?php echo htmlspecialchars($firstName); ?>
        </div>
        <div class="profile-item">
            <span>Nama Belakang</span> <?php echo htmlspecialchars($lastName); ?>
        </div>
        <div class="profile-item">
            <span>Email</span> <?php echo htmlspecialchars($email); ?>
        </div>
        <div class="profile-item">
            <span>Jenis Kelamin</span> <?php echo htmlspecialchars($gender); ?>
        </div>
        <a href="edit_profil_pelajar.php" class="edit-button">Edit Profil</a>
        <div class="back-button">
            <a href="dashboard_pelajar.php">Kembali</a>
        </div>
    </div>
</body>
</html>