<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT username, nama_depan, nama_belakang, email_tutor, jenis_kelamin, nomor_telepon, alamat, bidang_ahli FROM tutors WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userName, $firstName, $lastName, $email, $gender, $nomorTelepon, $alamat, $bidangAhli);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $nomorTelepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $bidangAhli = $_POST['bidang_ahli'];

    $sql_update = "UPDATE tutors SET nama_depan = ?, nama_belakang = ?, email_tutor = ?, jenis_kelamin = ?, nomor_telepon = ?, alamat = ?, bidang_ahli = ? WHERE username = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssss", $firstName, $lastName, $email, $gender, $nomorTelepon, $alamat, $bidangAhli, $username);
    
    if ($stmt_update->execute()) {
        $message = "Profil berhasil diperbarui.";
    } else {
        $message = "Terjadi kesalahan saat memperbarui profil: " . $conn->error;
    }

    $stmt_update->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Tutor</title>
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
        .back-button, .logout {
            margin-top: 10px;
        }
        .back-button a, .logout a {
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
        .logout a {
            background-color: #FF5A5F;
        }
        .logout a:hover {
            background-color: #E21F24;
        }
        .message {
            color: #48BB78;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profil Tutor</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="first_name">Nama Depan:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Nama Belakang:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender" required>
                    <option value="L" <?php if ($gender === 'Pria') echo 'selected'; ?>>Pria</option>
                    <option value="P" <?php if ($gender === 'Wanita') echo 'selected'; ?>>Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo htmlspecialchars($nomorTelepon); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
            </div>
            <div class="form-group">
                <label for="bidang_ahli">Bidang Ahli:</label>
                <input type="text" id="bidang_ahli" name="bidang_ahli" value="<?php echo htmlspecialchars($bidangAhli); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Simpan</button>
            </div>
        </form>
        <div class="back-button">
            <a href="profil_tutor.php">Kembali</a>
        </div>
        <?php if (!empty($message)) { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>
    </div>
</body>
</html>