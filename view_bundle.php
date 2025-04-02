<?php
require 'db.php';

$bundle_id = $_GET['id'];

$sql = "SELECT * FROM bundles WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $bundle_id);
$stmt->execute();
$bundle = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT p.* FROM products p 
        JOIN bundle_products bp ON p.id = bp.product_id 
        WHERE bp.bundle_id = :bundle_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':bundle_id', $bundle_id);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($bundle['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-content">
        <nav class="nav">
            <a href="home.php">TORNA ALLA HOME</a>
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
<h1><?php echo htmlspecialchars($bundle['name']); ?></h1>
<p>Sconto: <?php echo htmlspecialchars($bundle['discount']); ?>%</p>
<h2>Prodotti nel Bundle:</h2>
<ul>
    <?php foreach ($products as $product): ?>
        <li><?php echo htmlspecialchars($product['name']); ?> - Prezzo: <?php echo number_format($product['price'], 2, ',', ' '); ?> €</li>
    <?php endforeach; ?>
</ul>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>
