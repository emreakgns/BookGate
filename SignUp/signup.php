<?php
require_once '../AdminPanel/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, username, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullname, $username, $email, $phone, $address, $password);
    
    if ($stmt->execute()) {
        header("Location: /LibraryMS/SignUp/userlogin.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required><br><br>
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone"><br><br>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address"><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                
                <input type="submit" value="Sign Up">
            </form>
        </div>
    </main>
</body>
</html>
