<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Devi accedere per visualizzare il carrello.";
    exit;
}

$user_id = $_SESSION['user_id']; // Ottieni l'ID dell'utente dalla sessione

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Query per rimuovere il prodotto dal carrello
    $sql = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();

    // Reindirizza l'utente al carrello
    header("Location: cart.php");
    exit;
}
?>
