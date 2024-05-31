<?php
session_start();

// If the user is logged in, redirect to the profile page
if (isset($_SESSION['user_id'])) {
    header("Location: /LibraryMS/profil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Login Page</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="previouslogin.css">
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
</header>

<div class="prelogin">
    <form>
        <div class="bgroup">
            <a href="/LibraryMS/AdminLogin/adminlogin.php" class="custom-btn">Admin Login</a>
        </div>
        <div class="bgroup">
            <a href="/LibraryMS/UserLogin/userlogin.php" class="custom-btn">User Login</a>
        </div>
    </form>  
</div>
</body>
</html>
