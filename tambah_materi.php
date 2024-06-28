<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Ambil daftar tutor untuk dropdown
$sql = "SELECT tutor_id, username FROM tutors";
$result = $conn->query($sql);

$tutors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tutors[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi - EduCerdas</title>
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
            width: 50%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #240750;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #240750;
        }

        input[type="text"], textarea, select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: none;
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

        .back-button {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Materi Baru</h1>
        <form action="proses_tambah_materi.php" method="POST">
            <label for="nama_materi">Nama Materi:</label>
            <input type="text" id="nama_materi" name="nama_materi" required>
            
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea>
            
            <label for="tutor_id">Tutor:</label>
            <select id="tutor_id" name="tutor_id" required>
                <option value="">Pilih Tutor</option>
                <?php foreach($tutors as $tutor): ?>
                    <option value="<?php echo $tutor['tutor_id']; ?>"><?php echo htmlspecialchars($tutor['username']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Tambah Materi</button>
        </form>
        <div class="back-button">
            <button onclick="window.location.href='course_tutor.php'">Kembali</button>
        </div>
    </div>
</body>
</html>