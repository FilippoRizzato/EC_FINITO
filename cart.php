<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Devi accedere per visualizzare il carrello.";
    exit;
}

$user_id = $_SESSION['user_id']; // Ottieni l'ID dell'utente dalla sessione

// Recupera i prodotti nel carrello per l'utente
$sql = "SELECT c.quantity, p.*, c.formato, c.versione, b.discount FROM cart c 
        JOIN products p ON c.product_id = p.id 
        LEFT JOIN bundles b ON c.bundle_id = b.id
        WHERE c.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inizializza il totale e il codice sconto
$total = 0;
$discount = 0;

// Chiudi la connessione
$conn = null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
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

<div class="cart-container">
    <h1>Carrello</h1>

    <div class="cart-items">
        <?php if (count($cart_items) > 0): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                    <span class="price"><?php echo number_format($item['price'], 2, ',', ' '); ?> €</span>
                    <span class="quantity">Quantità: <?php echo htmlspecialchars($item['quantity']); ?></span>
                    <?php if (!empty($item['formato'])): ?>
                        <span class="formato">Formato: <?php echo htmlspecialchars($item['formato']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($item['versione'])): ?>
                        <span class="versione">Versione: <?php echo htmlspecialchars($item['versione']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($item['discount'])): ?>
                        <span class="discount">Sconto Bundle: <?php echo htmlspecialchars($item['discount']); ?>%</span>
                    <?php endif; ?>
                    <form action="remove_from_cart.php" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <button class="remove-btn" type="submit">Rimuovi</button>
                    </form>
                </div>
                <?php
                // Calcola il totale
                $item_total = $item['price'] * $item['quantity'];
                if (!empty($item['discount'])) {
                    $item_total -= ($item_total * ($item['discount'] / 100)); // Applica lo sconto
                }
                $total += $item_total;
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Il carrello è vuoto.</p>
        <?php endif; ?>
    </div>

    <div class="cart-summary">
        <p><strong>Totale: </strong>
            <?php
            echo number_format($total, 2, ',', ' ') . ' €';
            ?>
        </p>
        <button onclick="checkout()">Procedi al pagamento</button>
    </div>
</div>

<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>

<script>
    function checkout() {
        alert('Reindirizzamento al pagamento...');
    }
</script>

</body>
</html>