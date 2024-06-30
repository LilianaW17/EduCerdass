<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT m.id_materi, m.nama_materi, m.deskripsi, t.nama_depan, t.nama_belakang
        FROM materi m
        INNER JOIN tutors t ON m.tutor_id = t.tutor_id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            padding: 20px;
        }
        .course {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course h3 {
            color: #240750;
            margin-bottom: 10px;
        }
        .course p {
            color: #666;
        }
        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons a {
            background-color: #48BB78;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .action-buttons a:hover {
            background-color: #38A169;
        }
        .add-course {
            margin-top: 20px;
        }
        .add-course a {
            background-color: #3182CE;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .add-course a:hover {
            background-color: #2B6CB0;
        }
        .back-button {
            margin-top: 20px;
        }
        .back-button a {
            background-color: #FF5A5F;
            color: #fff;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .back-button a:hover {
            background-color: #E21F24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Course Admin</h1>
        
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="course">
                <h3><?php echo htmlspecialchars($row['nama_materi']); ?></h3>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($row['deskripsi']); ?></p>
                <p><strong>Tutor:</strong> <?php echo htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']); ?></p>
                <div class="action-buttons">
                    <a href="edit_courses_admin.php?id_materi=<?php echo $row['id_materi']; ?>">Edit</a>
                </div>
            </div>
        <?php } ?>

        <div class="add-course">
            <a href="add_courses_admin.php">Tambah Course</a>
        </div>

        <div class="back-button">
            <a href="dashboard_admin.php">Kembali</a>
        </div>
    </div>
</body>
</html>