<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /LibraryMS/UserLogin/userlogin.php");
    exit;
}

require_once '../AdminPanel/config.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname, address, phone, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_info = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
    </header>
    <div class="profile-container">
        <div class="profile-header">
            <img src="icardiProfile.png" alt="Profile Picture" class="profile-pic">
            <h1>Welcome, <?php echo $user_info['fullname']; ?>!</h1>
        </div>
        <div class="profile-details">
            <h2>Your Profile Information:</h2>
            <ul>
                <li><strong>Full Name:</strong> <?php echo $user_info['fullname']; ?></li>
                <li><strong>Address:</strong> <?php echo $user_info['address']; ?></li>
                <li><strong>Phone:</strong> <?php echo $user_info['phone']; ?></li>
                <li><strong>Email:</strong> <?php echo $user_info['email']; ?></li>
            </ul>
        </div>
    </div>
</body>
</html>
