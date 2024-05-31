<?php
session_start();

// If the user is logged in, redirect to homepage.php
if (isset($_SESSION['user_id'])) {
    header("Location: /LibraryMS/HomePage/homepage.php");
    exit();
}

// Database information
$db_host = "localhost";
$db_username = "abc"; 
$db_password = "abc"; 
$db_name = "group5";

// Database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

//Connection check
if ($conn->connect_error) {
    die("Could not connect to database: " . $conn->connect_error);
}

// When the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Debug: Entered username and password
    echo "User name: $username, Parola: $password<br>";

    // Query the user from the Users table
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("MySQL preparation error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Debug: Number of SQL query results
    echo "Number of Results: " . $stmt->num_rows . "<br>";

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();

        // Debug: User information returned from the database
        echo "Database Username: $db_username, Database Password: $db_password<br>";

        // Compare the hash of the entered password with the hash in the database
        if ($password === $db_password) {
            $_SESSION['user_id'] = $user_id;
            header("Location: /LibraryMS/HomePage/homepage.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        // User not found, show error message
        $error_message = "User not found.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="userlogin.css">
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
    <h2>User Login</h2>
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
        <a href="/LibraryMS/SignUp/signup.php" class="signup-btn">Sign Up</a>
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
