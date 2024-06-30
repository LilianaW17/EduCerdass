<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

include 'koneksi.php';

if (isset($_GET['id_materi'])) {
    $id_materi = $_GET['id_materi'];

    $sql_materi = "SELECT id_materi, nama_materi, deskripsi, tutor_id FROM materi WHERE id_materi = ?";
    $stmt = $conn->prepare($sql_materi);
    $stmt->bind_param("i", $id_materi);
    $stmt->execute();
    $stmt->bind_result($id_materi, $nama_materi, $deskripsi, $tutor_id);
    $stmt->fetch();
    $stmt->close();

    $sql_tutor = "SELECT tutor_id, username FROM tutors";
    $result_tutor = $conn->query($sql_tutor);

    $tutors = [];
    if ($result_tutor->num_rows > 0) {
        while ($row = $result_tutor->fetch_assoc()) {
            $tutors[] = $row;
        }
    }
} else {
    header("Location: courses_admin.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - EduCerdas</title>
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
            width: 80%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #240750;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Course</h1>
        <form action="proses_edit_m_admin.php" method="POST">
            <input type="hidden" name="id_materi" value="<?php echo $id_materi; ?>">
            <div>
                <label for="nama_materi">Nama Materi:</label>
                <input type="text" id="nama_materi" name="nama_materi" value="<?php echo htmlspecialchars($nama_materi); ?>" required>
            </div>
            <div>
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo htmlspecialchars($deskripsi); ?></textarea>
            </div>
            <div>
                <label for="tutor">Tutor:</label>
                <select id="tutor" name="tutor_id" required>
                    <?php foreach($tutors as $tutor): ?>
                        <option value="<?php echo $tutor['tutor_id']; ?>" <?php echo ($tutor['tutor_id'] == $tutor_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tutor['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" name="update">Update</button>
                <button type="button" onclick="confirmDelete(<?php echo $id_materi; ?>)">Delete</button>
            </div>
        </form>
        <div>
            <button onclick="window.location.href='courses_admin.php'">Kembali</button>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus materi ini?')) {
                window.location.href = 'hapus_materi.php?id=' + id;
            }
        }
    </script>
</body>
</html>