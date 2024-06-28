<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari session
$currentUsername = $_SESSION['username'];

include 'koneksi.php';

// Variabel untuk pesan sukses
$successMessage = '';

// Jika form disubmit, proses perubahan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // Update data dalam database
    $sql = "UPDATE pelajar SET username=?, nama_depan=?, nama_belakang=?, email_pelajar=?, jenis_kelamin=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $newUsername, $firstName, $lastName, $email, $gender, $currentUsername);
    
    if ($stmt->execute()) {
        // Update username di session jika username berubah
        if ($newUsername !== $currentUsername) {
            $_SESSION['username'] = $newUsername;
        }

        $successMessage = "Profil berhasil diperbarui!";
    } else {
        echo "Terjadi kesalahan saat memperbarui profil: " . $stmt->error;
    }

    $stmt->close();
}

// Ambil data pelajar dari database
$sql = "SELECT username, nama_depan, nama_belakang, email_pelajar, jenis_kelamin FROM pelajar WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentUsername);
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
    <title>Edit Profil Pelajar</title>
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
            position: relative;
        }
        .container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group select {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group select {
            width: 100%;
        }
        .form-group button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #555;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
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
        /* CSS untuk pop-up */
        .popup {
            display: none;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profil Pelajar</h2>
        <div id="popup" class="popup">Profil berhasil diperbarui!</div> <!-- Pop-up notifikasi -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userName); ?>">
            </div>
            <div class="form-group">
                <label for="first_name">Nama Depan:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Nama Belakang:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender">
                    <option value="L" <?php if ($gender === 'L') echo 'selected'; ?>>Laki-laki</option>
                    <option value="P" <?php if ($gender === 'P') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" onclick="showPopup()">Simpan Perubahan</button>
            </div>
        </form>
        <div class="back-button">
            <a href="profil_pelajar.php">Kembali ke Profil</a>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <script>
        function showPopup() {
            <?php if ($successMessage): ?>
                document.getElementById('popup').style.display = 'block';
                setTimeout(function() {
                    document.getElementById('popup').style.display = 'none';
                }, 3000);
            <?php endif; ?>
        }
    </script>
</body>
</html>