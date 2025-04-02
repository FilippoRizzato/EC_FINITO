<?php
require 'db.php';

// Recupera i bundle dal database
$sql = "SELECT * FROM bundles";
$stmt = $conn->prepare($sql);
$stmt->execute();
$bundles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Bundle di Prodotti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-content">
        <nav class="nav">
            <a href="home.php">TORNA ALLA HOME</a>
            <a href="add_bundle.php">CREA UN BUNDLE</a>
        </nav>
        <div class="logo">
            <img src="Screenshot_2025-02-04_083718-removebg-preview.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Cerca...">
            <button type="button">🔍</button>
        </div>
    </div>
</header>
<h1>Bundle di Prodotti</h1>
<ul>
    <?php foreach ($bundles as $bundle): ?>
        <li>
            <h2><?php echo htmlspecialchars($bundle['name']); ?></h2>
            <p>Sconto: <?php echo htmlspecialchars($bundle['discount']); ?>%</p>
            <a href="view_bundle.php?id=<?php echo $bundle['id']; ?>">Visualizza</a>
        </li>
    <?php endforeach; ?>
</ul>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>
