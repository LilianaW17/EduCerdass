<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include 'koneksi.php';

$sql_users = "SELECT pelajar_id, username FROM pelajar";
$result_users = $conn->query($sql_users);

$users = [];
if ($result_users->num_rows > 0) {
    while ($row_users = $result_users->fetch_assoc()) {
        $users[$row_users['pelajar_id']] = $row_users['username'];
    }
} else {
    $users[0] = "Tidak ada pelajar tersedia";
}

$riwayat_quiz = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pelajar_id']) && !empty($_POST['pelajar_id'])) {
        $selected_pelajar_id = $_POST['pelajar_id'];
        
        $sql_quiz = "SELECT quiz.nama_quiz, nilai.nilai_quiz AS score
                     FROM nilai
                     JOIN quiz ON nilai.quiz_id = quiz.quiz_id
                     WHERE nilai.pelajar_id = ?";

        $stmt = $conn->prepare($sql_quiz);
        $stmt->bind_param("i", $selected_pelajar_id);
        $stmt->execute();
        $result_quiz = $stmt->get_result();

        while ($row_quiz = $result_quiz->fetch_assoc()) {
            $riwayat_quiz[] = $row_quiz;
        }

        $stmt->close();
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
            <label for="pelajar_id">Pilih Pelajar:</label>
            <select name="pelajar_id" id="pelajar_id">
                <?php foreach ($users as $pelajar_id => $username): ?>
                    <option value="<?php echo htmlspecialchars($pelajar_id); ?>" <?php if (isset($selected_pelajar_id) && $pelajar_id == $selected_pelajar_id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($username); ?>
                    </option>
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
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>Tidak ada riwayat quiz untuk pelajar yang dipilih.</p>
        <?php endif; ?>

        <div class="button-container">
            <button onclick="window.location.href='dashboard_admin.php'">Kembali</button>
        </div>
    </div>
</body>
</html>