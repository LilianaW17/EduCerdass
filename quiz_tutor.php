<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql = "SELECT username FROM pelajar";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['username'];
    }
} else {
    $users[] = "Tidak ada pelajar tersedia";
}

$riwayat_quiz = [
    "wulandari" => [
        ["nama_quiz" => "Quiz Basic PHP", "score" => 90]
    ],
    "justin" => [
        ["nama_quiz" => "Quiz Basic HTML", "score" => 100]
    ]
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $selected_user = $_POST['username'];
        if (array_key_exists($selected_user, $riwayat_quiz)) {
            $riwayat_quiz = $riwayat_quiz[$selected_user];
        } else {
            $riwayat_quiz = [];
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz History - Tutor - EduCerdas</title>
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

        .form-container {
            margin-bottom: 20px;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Quiz Pelajar</h1>

        <form method="post" class="form-container">
            <label for="username">Pilih Pelajar:</label>
            <select name="username" id="username">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo htmlspecialchars($user); ?>"><?php echo htmlspecialchars($user); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Tampilkan Riwayat</button>
        </form>

        <?php if (!empty($riwayat_quiz)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Quiz</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($riwayat_quiz as $quiz): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($quiz['nama_quiz']); ?></td>
                            <td><?php echo htmlspecialchars($quiz['score']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada riwayat quiz untuk pelajar yang dipilih.</p>
        <?php endif; ?>

        <div class="button-container">
            <button onclick="window.location.href='dashboard_tutor.php'">Kembali</button>
        </div>
    </div>
</body>
</html>