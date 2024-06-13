<?php
session_start(); // Memulai session

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login_admin.php setelah logout
header("Location: login.php");
exit();
?>