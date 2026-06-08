<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<p>Selamat datang, <?php echo $_SESSION['user_name']; ?>!</p>
<p>Email: <?php echo $_SESSION['user_email']; ?></p>

<a href="dataUser.php">Data User</a> |
<a href="../auth/logout.php">Logout</a>

</body>
</html>