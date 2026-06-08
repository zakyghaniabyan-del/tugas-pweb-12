<?php 
// users/detail.php 
 
session_start(); 
require_once '../config/koneksi.php';
// Ambil ID dari URL 
$id = (int)($_GET['id'] ?? 0); 
 
if ($id <= 0) { 
    header('Location: index.php'); 
    exit; 
} 
 
// Ambil data user berdasarkan ID 
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? LIMIT 1"); 
 
if (!$stmt) { 
    die("Query gagal: " . mysqli_error($conn)); 
} 
 
mysqli_stmt_bind_param($stmt, "i", $id); 
mysqli_stmt_execute($stmt); 
 
$result = mysqli_stmt_get_result($stmt); 
$user = mysqli_fetch_assoc($result); 
 
mysqli_stmt_close($stmt); 
 
// Jika user tidak ditemukan 
if (!$user) { 
    header('Location: index.php'); 
    exit; 
} 
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Detail User - <?= htmlspecialchars($user['name']) ?></title> 
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head> 
<body> 
 
<nav class="navbar"> 
    <a href="../index.php" class="brand">PWeb Akademik</a> 
    <div> 
        <a href="index.php">← Kembali ke Daftar</a> 
    </div> 
</nav> 
 
<div class="form-card"> 
 
    <h2>Detail Pengguna</h2> 
 
    <div class="form-group"> 
        <label>ID Pengguna</label> 
        <p><strong>#<?= $user['id'] ?></strong></p> 
    </div> 
 
    <div class="form-group"> 
        <label>Nama Lengkap</label> 
        <p><?= htmlspecialchars($user['name']) ?></p> 
    </div> 
 
    <div class="form-group"> 
        <label>Alamat Email</label> 
        <p><?= htmlspecialchars($user['email']) ?></p> 
    </div> 
 
    <div class="form-group"> 
        <label>Alamat Lengkap</label>
         <p><?= htmlspecialchars($user['address']) ?></p> 
    </div> 
 
    <a href="dataUser.php" class="btn btn-primary"> 
        Kembali ke Daftar 
    </a> 
 
</div> 
 
<script src="../assets/js/script.js"></script> 
</body> 
</html>