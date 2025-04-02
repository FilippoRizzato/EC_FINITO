<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $discount = $_POST['discount'];

    // Inserisci il bundle nel database
    $sql = "INSERT INTO bundles (name, discount) VALUES (:name, :discount)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':discount', $discount);
    $stmt->execute();

    $bundle_id = $conn->lastInsertId();

    // Aggiungi i prodotti al bundle
    if (isset($_POST['products'])) {
        foreach ($_POST['products'] as $product_id) {
            $sql = "INSERT INTO bundle_products (bundle_id, product_id) VALUES (:bundle_id, :product_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':bundle_id', $bundle_id);
            $stmt->bindValue(':product_id', $product_id);
            $stmt->execute();
        }
    }

    header("Location: bundles.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Bundle</title>
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
<h1>Aggiungi Bundle</h1>
<form action="" method="post">
    <label>Nome Bundle:</label>
    <input type="text" name="name" required>
    <label>Sconto (%):</label>
    <input type="number" name="discount" required>
    <label>Seleziona Prodotti:</label>
    <select name="products[]" multiple required>
        <?php
        // Recupera i prodotti dal database
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            echo "<option value=\"{$product['id']}\">{$product['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Crea Bundle</button>
</form>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>
