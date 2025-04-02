<?php
require 'db.php';
session_start(); // Assicurati di avviare la sessione

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query per recuperare l'utente
    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password); // Confronto diretto della password
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Imposta le variabili di sessione
        $_SESSION['user_id'] = $user['id']; // Salva l'ID dell'utente nella sessione
        $_SESSION['user_email'] = $email; // Salva l'email dell'utente nella sessione
        header("Location: home.php");
        exit; // Assicurati di uscire dopo il reindirizzamento
    } else {
        echo "Credenziali non valide.";
    }
}
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <h1>Accedi</h1>
    <form action="" method="post">
        <label>Email:</label>
        <input type="text" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>