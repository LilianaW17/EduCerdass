<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_materi = $_GET['id'];

    $sql = "DELETE FROM materi WHERE id_materi=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_materi);

    if ($stmt->execute()) {
        echo "Materi berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: edit_materi.php");
    exit();
} else {
    header("Location: edit_materi.php");
    exit();
}
?>