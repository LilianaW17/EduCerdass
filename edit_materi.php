<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Ambil daftar tutor untuk dropdown
$sql_tutor = "SELECT tutor_id, username FROM tutors";
$result_tutor = $conn->query($sql_tutor);

$tutors = [];
if ($result_tutor->num_rows > 0) {
    while ($row = $result_tutor->fetch_assoc()) {
        $tutors[] = $row;
    }
}

// Ambil data materi untuk ditampilkan
$sql_materi = "SELECT id_materi, nama_materi, deskripsi, tutor_id FROM materi";
$result_materi = $conn->query($sql_materi);

$materi = [];
if ($result_materi->num_rows > 0) {
    while ($row = $result_materi->fetch_assoc()) {
        $materi[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi - EduCerdas</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #240750;
            color: white;
        }

        tr:hover {
            background-color: rgba(128, 128, 128, 0.1);
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

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Materi</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama Materi</th>
                    <th>Deskripsi</th>
                    <th>Tutor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($materi as $m): ?>
                    <tr>
                        <form action="proses_edit_materi.php" method="POST">
                            <td>
                                <input type="hidden" name="id_materi" value="<?php echo $m['id_materi']; ?>">
                                <input type="text" name="nama_materi" value="<?php echo htmlspecialchars($m['nama_materi']); ?>">
                            </td>
                            <td>
                                <textarea name="deskripsi" rows="2"><?php echo htmlspecialchars($m['deskripsi']); ?></textarea>
                            </td>
                            <td>
                                <select name="tutor_id">
                                    <?php foreach($tutors as $tutor): ?>
                                        <option value="<?php echo $tutor['tutor_id']; ?>" <?php echo $tutor['tutor_id'] == $m['tutor_id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($tutor['username']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="update">Update</button>
                                <button type="button" onclick="confirmDelete(<?php echo $m['id_materi']; ?>)">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-container">
            <button onclick="window.location.href='course_tutor.php'">Kembali</button>
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