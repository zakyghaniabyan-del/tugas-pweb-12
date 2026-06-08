<?php
session_start(); 
require_once '../config/koneksi.php'; 
 
$error = ''; 
$success = ''; 
 
$name = ''; 
$email = ''; 
$address = ''; 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
 
    $name     = trim($_POST['name'] ?? ''); 
    $email    = trim($_POST['email'] ?? ''); 
    $password = trim($_POST['password'] ?? ''); 
    $address  = trim($_POST['address'] ?? ''); 
 
    if ($name === '' || $email === '' || $password === '' || $address === '') { 
        $error = 'Semua field wajib diisi!'; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error = 'Format email tidak valid!'; 
    } elseif (strlen($password) < 6) { 
        $error = 'Password minimal 6 karakter!'; 
    } else { 
 
        $cek = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' LIMIT 1");  
        $hasil = mysqli_fetch_array($cek);
        $count = mysqli_num_rows($cek);
 
        if ($count > 0) { 
            $error = 'Email sudah terdaftar!'; 
        } else { 
 
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password, address) VALUES ('$name', '$email', '$password_hash', '$address')"; 
 
            $stmt = mysqli_query($conn, $sql); 
 
            if ($stmt === TRUE) { 
                $success = 'Registrasi berhasil! Silakan login.'; 
                $name = ''; 
                $email = ''; 
                $address = ''; 
            } else { 
                $error = 'Registrasi gagal: ' . mysqli_error($conn); 
            } 
        } 
 
    } 
} 
?>

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Registrasi - PWeb Akademik</title> 
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head> 
<body> 
 
<nav class="navbar"> 
    <a href="../index.php" class="brand">PWeb Akademik</a> 
    <div> 
        <a href="login.php">Login</a> 
        <a href="register.php">Daftar</a> 
    </div> 
</nav> 
 
<div class="form-card"> 
    <h2>Daftar Akun</h2> 
 
    <?php if ($error): ?> 
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div> 
    <?php endif; ?> 
 
    <?php if ($success): ?> 
        <div class="alert alert-success"><?= htmlspecialchars($success) 
?></div> 
    <?php endif; ?> 
 
    <form action="register.php" method="POST"> 
 
        <div class="form-group"> 
            <label for="name">Nama Lengkap</label> 
            <input type="text" id="name" name="name" 
                   placeholder="Masukkan nama lengkap" 
                   value="<?= htmlspecialchars($name) ?>"> 
        </div>
         <div class="form-group"> 
            <label for="email">Alamat Email</label> 
            <input type="email" id="email" name="email" 
                   placeholder="contoh@email.com" 
                   value="<?= htmlspecialchars($email) ?>"> 
        </div> 
 
        <div class="form-group"> 
            <label for="password">Password</label> 
            <input type="password" id="password" name="password" 
                   placeholder="Masukkan password"> 
        </div> 
 
        <div class="form-group"> 
            <label for="address">Alamat Lengkap</label> 
            <textarea id="address" name="address" rows="3" 
                      placeholder="Jl. Contoh No.1, Kota"><?= 
htmlspecialchars($address) ?></textarea> 
        </div> 
 
        <button type="submit" class="btn btn-primary">Daftar Sekarang</button> 
 
    </form> 
 
    <p class="text-center" style="margin-top:20px"> 
        Sudah punya akun? 
        <a href="login.php" class="link-secondary">Login di sini</a> 
    </p> 
</div> 
 
<script src="../assets/js/script.js"></script> 
</body> 
</html>