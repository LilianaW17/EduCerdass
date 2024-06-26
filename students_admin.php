<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM pelajar";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Pelajar</title>
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
            color: #5A67D8;
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
            background-color: #5A67D8;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .button-detail {
            background: #48BB78;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .button-detail:hover {
            background: #38A169;
        }
        .button-back {
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
        .button-back:hover {
            background: #2B6CB0;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List Pelajar</h1>
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
                            <td><a href='detail_pelajar.php?id=" . htmlspecialchars($row["pelajar_id"]) . "' class='button-detail'>Detail</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
            }
            ?>
        </table>
        <a href="dashboard_admin.php" class="button-back">Kembali</a>
    </div>
</body>
</html>