<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT pelajar_id FROM pelajar WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pelajar_id = $row['pelajar_id'];
} else {
    echo "Pelajar tidak ditemukan.";
    exit();
}
$stmt->close();

$sql = "
    SELECT q.nama_quiz, n.nilai_quiz
    FROM nilai n
    JOIN quiz q ON n.quiz_id = q.quiz_id
    WHERE n.pelajar_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pelajar_id);
$stmt->execute();
$result = $stmt->get_result();

$riwayat_quiz = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $riwayat_quiz[] = $row;
    }
} else {
    $riwayat_quiz[] = ["nama_quiz" => "Tidak ada nilai tersedia", "nilai_quiz" => ""];
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz History - EduCerdas</title>
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

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
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
        <h1>Riwayat Quiz</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama Quiz</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($riwayat_quiz as $quiz): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($quiz['nama_quiz']); ?></td>
                        <td><?php echo htmlspecialchars($quiz['nilai_quiz']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-container">
            <button onclick="window.location.href='dashboard_pelajar.php'">Kembali</button>
        </div>
    </div>
</body>
</html>