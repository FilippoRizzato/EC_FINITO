<?php
require 'db.php'; // Assicurati che questo file contenga la connessione PDO

// Recupera il nome del prodotto dall'URL
$product_name = isset($_GET['name']) ? $_GET['name'] : '';

if (!empty($product_name)) {
    // Query per ottenere i dettagli del prodotto
    $sql = "SELECT p.* FROM products p 
            WHERE p.name = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recupera tutte le immagini per il prodotto
        $images_sql = "SELECT image_url FROM product_images WHERE product_id = :product_id";
        $images_stmt = $conn->prepare($images_sql);
        $images_stmt->bindParam(':product_id', $product['id'], PDO::PARAM_INT);
        $images_stmt->execute();

        // Fetch all image URLs into an array
        $alternative_images = $images_stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
        echo "Prodotto non trovato.";
        exit;
    }
} else {
    echo "Nome prodotto non valido.";
    exit;
}

// Chiudi la connessione
$conn = null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - Dettagli Prodotto</title>
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

<div class="container">
    <div class="main-content">
        <div class="product-details">
            <h1>Dettagli Prodotto</h1>
            <div class="slider-container">
                <div class="slider">
                    <?php foreach ($alternative_images as $image): ?>
                        <img src="<?php echo htmlspecialchars(trim($image)); ?>" alt="<?php echo htmlspecialchars($product['name']); ?> Album Cover">
                    <?php endforeach; ?>
                </div>
                <button class="prev">⟨</button>
                <button class="next">⟩</button>
            </div>

            <div class="product-info">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><strong>Prezzo: </strong><?php echo number_format($product['price'], 2, ',', ' '); ?> € <span>Tasse incluse</span></p>
                <p><strong>Disponibilità: </strong><?php echo $product['stock'] > 0 ? 'Disponibile' : 'Non disponibile'; ?></p>

                <form action="prodotto.php" method="get">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">

                    <!-- Menu a discesa per il formato -->
                    <label for="formato">Formato:</label>
                    <select name="formato" id="formato" required>
                        <option value="CD">CD</option>
                        <option value="Vinile">Vinile</option>
                        <option value="Digitale">Digitale</option>
                    </select>

                    <!-- Menu a discesa per la versione -->
                    <label for="versione">Versione:</label>
                    <select name="versione" id="versione" required>
                        <option value="Standard">Standard</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Collector's Edition">Collector's Edition</option>
                    </select>

                    <button type="submit">Torna indietro</button>
                </form>
            </div>
        </div>

        <div class="description">
            <h2>Descrizione</h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
        </div>
    </div>
</div>

<footer>
    &copy; 2025 Negozio di Dischi. Tutti i diritti riservati.
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const slider = document.querySelector(".slider");
        const prevButton = document.querySelector(".prev");
        const nextButton = document.querySelector(".next");

        nextButton.addEventListener("click", function () {
            slider.scrollBy({ left: 300, behavior: "smooth" });
        });

        prevButton.addEventListener("click", function () {
            slider.scrollBy({ left: -300, behavior: "smooth" });
        });
    });
</script>

</body>
</html>