<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    header("Location: login.php");
}
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrati</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-content">
        <nav class="nav">
            <a href="home.php">HOME</a>
            <a href="#">CD</a>
            <a href="#">VINILI</a>
        </nav>
        <div class="logo text-center">
            <img src="Screenshot_2025-02-04_083718-removebg-preview.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Cerca...">
            <button type="button">🔍</button>
        </div>
    </div>
</header>
<div class="content" style="padding-top: 100px;">
    <h1>Registrati</h1>
    <form action="" method="post">
        <label>Email:</label>
        <input type="text" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Registrati</button>
    </form>
</div>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>