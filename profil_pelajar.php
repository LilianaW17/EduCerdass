<?php
session_start(); // Memulai session

// Periksa apakah pengguna sudah login, jika belum, arahkan kembali ke halaman login
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari session
$username = $_SESSION['username'];
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
$lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : '';

// Jika formulir disubmit, kita bisa memproses data (meskipun dalam contoh ini tidak benar-benar memprosesnya)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Di sini bisa diberikan proses penyimpanan data ke database atau ke sesi lainnya
    // Namun, untuk contoh ini, kita hanya akan menampilkan kembali data yang dimasukkan
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];

    // Simpan kembali ke session untuk ditampilkan kembali di form
    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
    $_SESSION['gender'] = $gender;
}

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
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Pelajar</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="first_name">Nama Depan:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Nama Belakang:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender">
                    <option value="L" <?php if ($gender === 'L') echo 'selected'; ?>>Laki-laki</option>
                    <option value="P" <?php if ($gender === 'P') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Simpan</button>
            </div>
        </form>
        <div class="back-button">
            <a href="dashboard_pelajar.php">Kembali</a>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>