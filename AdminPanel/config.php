<?php
// Database information
$db_host = "localhost"; // Database server
$db_username = "abc"; 
$db_password = "abc"; 
$db_name = "group5"; 

// Database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

//Connection check
if ($conn->connect_error) {
    die("Could not connect to database: " . $conn->connect_error);
}

// Session management
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to check user login status
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /LibraryMS/PreviousLogin/previouslogin.php");
        exit;
    }
}

// Function to get user information
function get_user_info($conn, $user_id) {
    $stmt = $conn->prepare("SELECT fullname, address, phone, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
