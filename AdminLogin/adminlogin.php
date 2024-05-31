<?php
session_start();

// If the user is logged in, redirect to admin_panel.php
if (isset($_SESSION['admin_id'])) {
    header("Location: /LibraryMS/AdminPanel/admin_panel.php");
    exit();
}

// Database information
$db_host = "localhost"; // Database server
$db_username = "abc";
$db_password = "abc";
$db_name = "group5"; // Database name

// Database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Connection check
if ($conn->connect_error) {
    die("Could not connect to database: " . $conn->connect_error);
}

// When the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query user from admin table
    $sql = "SELECT * FROM admin WHERE adminname = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If the username and password are correct, start a session and redirect to admin panel.php page.
        $_SESSION['admin_id'] = $username;
        header("Location: /LibraryMS/AdminPanel/admin_panel.php");
        exit();
    } else {
        // Show error message if username or password is incorrect
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
<header>
    <div class="logo"> 
        <a href="/LibraryMS/HomePage/homepage.php">
            <img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo">
        </a>
    </div>
</header>
<div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST" onsubmit="return validateForm()">
        <div class="input-group">
            <img src="/LibraryMS/UserLogin/username.png" alt="Username">
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <img src="/LibraryMS/UserLogin/password.png" alt="Password">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <input type="submit" class="submit-btn" value="Login">
        <?php if(isset($error_message)) echo '<div class="error-message">' . $error_message . '</div>'; ?>
    </form>
</div>

<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "" || password === "") {
            alert("Username and password are required.");
            return false;
        }

        return true;
    }
</script>
    
</body>
</html>
