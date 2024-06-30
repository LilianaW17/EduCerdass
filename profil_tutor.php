<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT username, nama_depan, nama_belakang, email_tutor, jenis_kelamin, nomor_telepon, alamat, bidang_ahli, foto_profil FROM tutors WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userName, $firstName, $lastName, $email, $gender, $nomorTelepon, $alamat, $bidangAhli, $fotoProfil);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Tutor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            background: url('<?php echo $fotoProfil; ?>') no-repeat center center;
            background-size: cover;
        }
        h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group select {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 0 auto;
        }
        .form-group select {
            width: 100%;
        }
        .form-group button {
            background-color: #48BB78;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #38A169;
        }
        .back-button, .edit-profile, .logout {
            margin-top: 10px;
        }
        .back-button a, .edit-profile a, .logout a {
            color: #fff;
            text-decoration: none;
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .back-button a {
            background-color: #3182CE;
        }
        .back-button a:hover {
            background-color: #2B6CB0;
        }
        .edit-profile a {
            background-color: #48BB78;
        }
        .edit-profile a:hover {
            background-color: #38A169;
        }
        .logout a {
            background-color: #FF5A5F;
        }
        .logout a:hover {
            background-color: #E21F24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-image"></div>
        <h2>Profil Tutor</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="first_name">Nama Depan:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="last_name">Nama Belakang:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <input type="text" id="gender" name="gender" value="<?php echo ($gender === 'L') ? 'Pria' : 'Wanita'; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo htmlspecialchars($nomorTelepon); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="bidang_ahli">Bidang Ahli:</label>
                <input type="text" id="bidang_ahli" name="bidang_ahli" value="<?php echo htmlspecialchars($bidangAhli); ?>" readonly>
            </div>
        </form>
        <div class="back-button">
            <a href="dashboard_tutor.php">Kembali</a>
        </div>
        <div class="edit-profile">
            <a href="edit_profil_tutor.php">Edit Profil</a>
        </div>
        <!-- <div class="logout">
            <a href="logout.php">Logout</a>
        </div> -->
    </div>
</body>
</html>