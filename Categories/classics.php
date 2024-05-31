<?php
// Restart if the session has been started.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../AdminPanel/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add to cart button clicked, process the request
    if (isset($_SESSION['user_id'])) {
        // Check if user is logged in
        $user_id = $_SESSION['user_id'];
        $book_id = $_POST['book_id'];
        $book_title = $_POST['book_title'];
        $book_image = $_POST['book_image'];
        $book_price = $_POST['book_price'];

        // Insert the book into the cart table
        $stmt = $conn->prepare("INSERT INTO cart (user_id, book_id, title, image, price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $user_id, $book_id, $book_title, $book_image, $book_price);
        
        if ($stmt->execute()) {
            // Book added to cart successfully
            header("Location: /LibraryMS/cart.php");
            exit;
        } else {
            // Error occurred while adding book to cart
            echo "Error occurred while adding book to cart.";
        }
    } else {
        // User is not logged in, redirect to login page
        header("Location: /LibraryMS/PreviousLogin/previouslogin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classics Books | Book Wise Library</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="classics.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
        <div class="header-content">
            <nav>
                <a href="/LibraryMS/HomePage/homepage.php">Home</a>
                <a href="/LibraryMS/PreviousLogin/previouslogin.php">Login</a>
                <a href="/LibraryMS/ContactUs/ContactUs.php">Contact</a>
            </nav>
            <div class="welcome-message">
                <h1>Classics Books</h1>
                <p>Explore classics books</p>
            </div>
        </div>
    </header>

    <!-- Books -->
    <main>
        <div class="books-list">
            <div class="books-table">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Pull books from database
                        $books = $conn->query("SELECT * FROM books WHERE category = 'classics'")->fetch_all(MYSQLI_ASSOC);
                        foreach ($books as $book):
                        ?>
                            <tr>
                                <td><img src="../uploads/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>"></td>
                                <td><?= htmlspecialchars($book['title']) ?></td>
                                <td><?= htmlspecialchars($book['author']) ?></td>
                                <td><?= htmlspecialchars($book['publisher']) ?></td>
                                <td>
                                    <form method="post" action="/LibraryMS/Categories/classics.php">
                                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['id']) ?>">
                                        <input type="hidden" name="book_title" value="<?= htmlspecialchars($book['title']) ?>">
                                        <input type="hidden" name="book_image" value="<?= htmlspecialchars($book['image']) ?>">
                                        <input type="hidden" name="book_price" value="<?= htmlspecialchars($book['price']) ?>">
                                        <button type="submit" class="buy-button">Add to Cart</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Book Gate Library</p>
    </footer>
</body>
</html>
