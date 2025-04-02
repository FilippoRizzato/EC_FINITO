<?php
require 'db.php'; // Assicurati che questo file contenga la connessione PDO
session_start();

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $formato = $_POST['formato'];
    $versione = $_POST['versione'];
    $bundle_id = isset($_POST['bundle_id']) ? $_POST['bundle_id'] : null;

    // Controlla se il prodotto è già nel carrello
    $sql = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id AND formato = :formato AND versione = :versione AND bundle_id = :bundle_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':formato', $formato);
    $stmt->bindValue(':versione', $versione);
    $stmt->bindValue(':bundle_id', $bundle_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Se il prodotto è già nel carrello, aggiorna la quantità e i dettagli
        $sql = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id AND formato = :formato AND versione = :versione AND bundle_id = :bundle_id";
    } else {
        // Se il prodotto non è nel carrello, inseriscilo
        $sql = "INSERT INTO cart (user_id, product_id, quantity, formato, versione, bundle_id) VALUES (:user_id, :product_id, :quantity, :formato, :versione, :bundle_id)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':formato', $formato);
    $stmt->bindValue(':versione', $versione);
    $stmt->bindValue(':bundle_id', $bundle_id);
    $stmt->execute();

    header("Location: product.php?id=" . $product_id);


    exit;
}
?>