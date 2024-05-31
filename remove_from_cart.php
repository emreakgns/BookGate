<?php
// Get database connection from config.php file
require './AdminPanel/config.php';

//Removing the book from the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    // Query to delete the book to be removed from the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $bookId);
    if ($stmt->execute()) {
        header("Location: /LibraryMS/cart.php");
        exit();
    } else {
        echo "Error: Could not remove book from cart.";
    }
}
?>
