<?php
// Database connection
require 'config.php';

// Redirection to the book adding page when the Manage Books button is clicked
if (isset($_POST['manage_books'])) {
  header('Location: manage_books.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System - Admin Panel</title>
  <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
  <link rel="stylesheet" href="adminpanel.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo">
    </div>
    <div class="admin-info">
      <h1>Welcome Admin</h1>
      <p>You can manage the library here.</p>
    </div>
  </header>
  <main>
    <div class="admin-panel">
      <form method="post">
        <div class="button-container">
          <button type="submit" name="manage_books" class="submit-btn">Manage Books</button>
          <a href="/LibraryMS/logout.php" class="logout-button">Logout</a>
        </div>
      </form>
    </div>
  </main>
</body>
</html>