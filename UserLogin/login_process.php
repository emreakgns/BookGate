<?php
session_start();

// Include database connection and other required files
require_once '../AdminPanel/config.php';

// Get the username and password entered by the user
$username = $_POST['username'];
$password = $_POST['password'];

// Query to select user from database
$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// If the user exists, check their password
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $db_username, $db_password);
    $stmt->fetch();
    
    // Compare the hash of the entered password with the hash in the database
    if (password_verify($password, $db_password)) {
        //Password is correct, start the session and redirect the user to the home page
        $_SESSION['id'] = $id;
        header("Location: /LibraryMS/HomePage/homepage.php");
        exit;
    } else {
        //Password is incorrect, show error message
        echo "Invalid password.";
    }
} else {
    // User not found, show error message
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
