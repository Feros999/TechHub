<?php
// Memulai sesi untuk memastikan bahwa sesi saat ini aktif
session_start();

// Menghancurkan semua data sesi yang ada
session_destroy();

// Mengarahkan pengguna ke halaman login (index.php)
$url = 'index.php';
header('Location: ' . $url);

// Mengakhiri eksekusi script setelah header redirect
exit();
?>
