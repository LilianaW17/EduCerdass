<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cerdasedu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT username FROM pelajar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Pelajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #5A67D8;
            color: white;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .button-back {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background: #3182CE;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button-back:hover {
            background: #2B6CB0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List Pelajar</h1>
        <ul>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row["username"]) . "</li>";
                }
            } else {
                echo "<li>Tidak ada data.</li>";
            }
            ?>
        </ul>
        <a href="dashboard_admin.php" class="button-back">Kembali</a>
    </div>
</body>
</html>

<?php

$conn->close();
?>