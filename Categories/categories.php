<?php
// List of categories
$categories = array(
    "Autobiography",
    "Biography",
    "History",
    "Classics"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Book Wise Library</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="categories.css">
</head>
<body>
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
        <div class="header-content">
            <nav>
                <a href="/LibraryMS/HomePage/homepage.php">Home</a>
                <a href="/LibraryMS/PreviousLogin/previouslogin.html">Login</a>
                <a href="/LibraryMS/ContactUs/ContactUs.html">Contact</a>
            </nav>
            <div class="welcome-message">
                <h1>Book Categories</h1>
                <p>Explore our collection by categories</p>
            </div>
        </div>
    </header>
    
    <main>
        <div class="search-bar">
            <input type="text" placeholder="Search Books...">
            <button type="submit">Search</button>
        </div>
        
        <div class="category-list">
            <?php foreach ($categories as $category): ?>
            <div class="category">
                <img src="<?= strtolower($category) ?>.jpg" alt="<?= $category ?>">
                <h2><?= $category ?></h2>
                <p>Books related to <?= strtolower($category) ?></p>
                <a href="<?= strtolower($category) ?>.php">Explore</a>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Book Gate Library</p>
    </footer>
</body>
</html>
