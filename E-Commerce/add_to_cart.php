<?php
require 'db.php'; // Assicurati che questo file contenga la connessione PDO
session_start();

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id']; // Assicurati che l'ID utente sia nella sessione
    $product_id = $_POST['product_id']; // ID del prodotto da aggiungere
    $quantity = $_POST['quantity']; // Quantità da aggiungere

    // Controlla se il prodotto è già nel carrello
    $sql = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Se il prodotto è già nel carrello, aggiorna la quantità
        $sql = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id";
    } else {
        // Se il prodotto non è nel carrello, inseriscilo
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->execute();

    // Reindirizza l'utente a una pagina di conferma o alla pagina del prodotto
    header("Location: product.php?id=" . $product_id); // Modifica il reindirizzamento come necessario
    exit;
}
?>