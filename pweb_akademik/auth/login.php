<?php 
// auth/login.php 
 
session_start(); 
require_once '../config/koneksi.php'; 
 
// Jika sudah login, redirect ke halaman utama 
if (isset($_SESSION['user_id'])) { 
    header('Location: ../users/index.php'); 
    exit; 
} 
 
$error = ''; 
$email = ''; 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
 
    $email    = trim($_POST['email'] ?? ''); 
    $password = $_POST['password'] ?? ''; 
 
    if ($email === '' || $password === '') { 
        $error = 'Email dan password wajib diisi!'; 
    } else { 
 
        // Cari user berdasarkan email 
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? 
LIMIT 1"); 
 
        if (!$stmt) { 
            die("Query gagal: " . mysqli_error($conn)); 
        } 
 
        mysqli_stmt_bind_param($stmt, "s", $email);
         $result = mysqli_stmt_get_result($stmt); 
        $user = mysqli_fetch_assoc($result); 
 
        mysqli_stmt_close($stmt); 
 
        // Verifikasi password hash 
        if ($user && password_verify($password, $user['password'])) { 
 
            session_regenerate_id(true); 
 
            $_SESSION['user_id']    = $user['id']; 
            $_SESSION['user_name']  = $user['name']; 
            $_SESSION['user_email'] = $user['email']; 
 
            header('Location: ../index.php'); 
            exit; 
        } else { 
            $error = 'Email atau password salah!'; 
        } 
    } 
} 
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Login - PWeb Akademik</title> 
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
    <h2>Masuk ke Akun</h2> 
 
    <?php if ($error): ?> 
        <div class="alert alert-error"> 
            <?= htmlspecialchars($error) ?> 
        </div> 
    <?php endif; ?> 
 
    <form action="login.php" method="POST"> 
 
        <div class="form-group"> 
            <label for="email">Email</label> 
            <input type="email" 
                   id="email" 
                   name="email" 
                   placeholder="email@contoh.com" 
                   value="<?= htmlspecialchars($email) ?>"> 
        </div> 
 
        <div class="form-group"> 
            <label for="password">Password</label> 
 
            <div style="position:relative"> 
                <input type="password" 
                       id="password"
                       name="password" 
                       placeholder="Masukkan password"> 
 
                <span id="togglePwd" 
                      onclick="togglePassword('password','togglePwd')" 
                      
style="position:absolute;right:12px;top:12px;cursor:pointer"> 
                    👁️ 
                </span> 
            </div> 
        </div> 
 
        <button type="submit" class="btn btn-primary">Masuk</button> 
 
    </form> 
 
    <p class="text-center" style="margin-top:20px"> 
        Belum punya akun? 
        <a href="register.php" class="link-secondary">Daftar di sini</a> 
    </p> 
</div> 
 
<script src="../assets/js/script.js"></script> 
</body>