<?php
require 'db.php';

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="header-content">
        <nav class="nav">
            <a href="home.php">HOME</a>
            <a href="#">CD</a>
            <a href="#">VINILI</a>
        </nav>
        <div class="logo text-center">
            <img src="Screenshot%202025-02-04%20083718.png" alt="Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Cerca...">
            <button type="button">🔍</button>
        </div>
    </div>
</header>
<body>
<h1><?php echo $product['name']; ?></h1>
<p>Prezzo: <?php echo $product['price']; ?>€</p>
<form action="cart.php" method="post">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <button type="submit" name="add_to_cart">Aggiungi al Carrello</button>
</form>
<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>
</body>
</html>
