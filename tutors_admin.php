<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM tutors";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Tutors</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #48BB78;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #48BB78;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .button-detail, .button-edit {
            background: #48BB78;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: background 0.3s ease;
        }
        .button-detail:hover, .button-edit:hover {
            background: #38A169;
        }
        .button-back, .button-add {
            display: block;
            width: 120px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background: #3182CE;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .button-back:hover, .button-add:hover {
            background: #2B6CB0;
        }
        .actions {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List Tutors</h1>
        <table>
            <tr>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td class='actions'>
                                <a href='detail_tutors.php?id=" . htmlspecialchars($row["tutor_id"]) . "' class='button-detail'>Detail</a>
                                <a href='edit_tutor.php?id=" . htmlspecialchars($row["tutor_id"]) . "' class='button-edit'>Edit</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
            }
            ?>
        </table>
        <a href="tambah_tutor.php" class="button-add">Tambah Tutor</a>
        <a href="dashboard_admin.php" class="button-back">Kembali</a>
    </div>
</body>
</html>