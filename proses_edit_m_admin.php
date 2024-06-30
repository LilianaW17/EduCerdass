<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id_materi = $_POST['id_materi'];
    $nama_materi = $_POST['nama_materi'];
    $deskripsi = $_POST['deskripsi'];
    $tutor_id = $_POST['tutor_id'];

    $sql = "UPDATE materi SET nama_materi=?, deskripsi=?, tutor_id=? WHERE id_materi=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nama_materi, $deskripsi, $tutor_id, $id_materi);

    if ($stmt->execute()) {
        echo "Materi berhasil diperbarui!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: edit_courses_admin.php");
    exit();
} else {
    header("Location: edit_courses_admin.php");
    exit();
}
?>