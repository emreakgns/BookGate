<?php
// If a session has been started elsewhere, do not restart it.
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

// Search operation
$search_query = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%'";
} else {
    // If no search, select 8 books at random
    $sql = "SELECT * FROM books ORDER BY RAND() LIMIT 8";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
        <div class="welcome-message">
            <h1>Welcome</h1>
            <p>Welcome to our Library... Rent & Read</p>
        </div>
        <nav>
            <a href="/LibraryMS/Categories/categories.php">Categories</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/LibraryMS/ProfilePage/profile.php">Profile</a>
                <a href="/LibraryMS/cart.php">Cart</a>
                <a href="/LibraryMS/logout.php">Logout</a>
            <?php else: ?>
                <a href="/LibraryMS/PreviousLogin/previouslogin.php">Login</a>
                <a href="/LibraryMS/PreviousLogin/previouslogin.php">Cart</a>
            <?php endif; ?>
            <a href="/LibraryMS/ContactUs/ContactUs.php">Contact</a>
        </nav>
    </header>

    <main>
        <div class="book-search">
            <form method="GET" action="/LibraryMS/HomePage/homepage.php">
                <input type="text" name="search" placeholder="Search Books..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    
        <div class="book-gallery">
            <?php
            if ($result->num_rows > 0) {
                // Creating HTML cards for each book from the database
                $count = 0;
                echo '<div class="book-row">';
                while($row = $result->fetch_assoc()) {
                    echo '<div class="book-card">';
                    echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" style="width: 100px; height: 150px;">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['author']) . '</p>'; //Author name added
                    echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
                    echo '<form method="post" action="/LibraryMS/HomePage/homepage.php">';
                    echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<input type="hidden" name="book_title" value="' . htmlspecialchars($row['title']) . '">';
                    echo '<input type="hidden" name="book_image" value="' . htmlspecialchars($row['image']) . '">';
                    echo '<input type="hidden" name="book_price" value="' . htmlspecialchars($row['price']) . '">';
                    echo '<button type="submit" class="buy-button">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                    $count++;
                    if ($count % 4 == 0 && $count != 8) {
                        echo '</div><div class="book-row">';
                    }
                }
                echo '</div>'; //Close last line
            } else {
                echo "No books found.";
            }
            ?>
        </div>
    </main>
</body>
</html>
