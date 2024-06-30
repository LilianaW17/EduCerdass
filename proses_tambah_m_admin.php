<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_materi = $_POST['nama_materi'];
    $deskripsi = $_POST['deskripsi'];
    $tutor_id = $_POST['tutor_id'];

    $sql = "INSERT INTO materi (nama_materi, deskripsi, tutor_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama_materi, $deskripsi, $tutor_id);

    if ($stmt->execute()) {
        echo "Materi berhasil ditambahkan!";
        header("Location: courses_admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: add_courses_admin.php");
    exit();
}
?>