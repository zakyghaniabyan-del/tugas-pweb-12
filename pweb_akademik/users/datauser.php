<?php 
// users/dataUser.php 
 
session_start(); 
require_once '../config/koneksi.php'; 
 
// Ambil semua data user dari database 
$query = "SELECT * FROM users ORDER BY id DESC"; 
$result = mysqli_query($conn, $query); 
 
$users = []; 
 
if ($result) { 
    while ($row = mysqli_fetch_assoc($result)) { 
        $users[] = $row; 
    } 
} else { 
    die("Query gagal: " . mysqli_error($conn)); 
} 
?> 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Data Users - PWeb Akademik</title> 
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head> 
<body> 
 
<nav class="navbar"> 
    <a href="../index.php" class="brand">PWeb Akademik</a> 
    <div> 
        <a href="../auth/register.php">+ Tambah User</a> 
 <a href="../auth/logout.php">Logout</a> 
    </div> 
</nav> 
 
<div class="container"> 
    <div class="table-wrapper"> 
        <h2 style="margin-bottom:20px;color:#1F4E79"> 
            Daftar Pengguna Terdaftar 
        </h2> 
 
        <?php if (empty($users)): ?> 
            <p style="text-align:center;color:#888"> 
                Belum ada data pengguna. 
            </p> 
        <?php else: ?> 
            <table> 
                <thead> 
                    <tr> 
                        <th>No</th> 
                        <th>Nama</th> 
                        <th>Email</th> 
                        <th>Alamat</th> 
                        <th>Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php $no = 1; foreach ($users as $user): ?> 
                        <tr> 
                            <td><?= $no++ ?></td> 
                            <td><?= htmlspecialchars($user['name']) ?></td> 
                            <td><?= htmlspecialchars($user['email']) ?></td> 
                            <td><?= htmlspecialchars($user['address']) ?></td> 
                            <td> 
                                <a href="detail.php?id=<?= $user['id'] ?>" 
                                   class="btn btn-primary" 
                                   style="font-size:12px;padding:5px 10px"> 
                                    Detail 
                                </a> 
                            </td> 
                        </tr> 
                    <?php endforeach; ?> 
                </tbody> 
            </table> 
        <?php endif; ?> 
    </div> 
</div> 
 
<script src="../assets/js/script.js"></script> 
</body> 
</html> 