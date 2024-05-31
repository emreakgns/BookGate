<?php
session_start();

require './AdminPanel/config.php';

//Database query to retrieve user's cart
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, title, image, price FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// When retrieving cart contents, it may be necessary to pull the books in the user's cart from the database
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}

//Purchase process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["card_number"]) && isset($_POST["cvv"]) && isset($_POST["expiration_date"])) {
        // Get credit card information
        $card_number = $_POST["card_number"];
        $cvv = $_POST["cvv"];
        $expiration_date = $_POST["expiration_date"];

        //Make the purchase (for example, a payment transaction can be made here)
        // Clear cart when purchase is successful
        $sql_delete = "DELETE FROM cart WHERE user_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $user_id);
        $stmt_delete->execute();
    } else {
        echo "Credit card information is missing.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <header>
        <div class="logo"> 
            <a href="/LibraryMS/HomePage/homepage.php"><img src="/LibraryMS/HomePage/bookgatelogo.png" alt="Book Gate Logo"></a>
        </div>
        <nav>
            <a href="/LibraryMS/Categories/categories.php">Categories</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/LibraryMS/ProfilePage/profile.php">Profile</a>
                <a href="/LibraryMS/cart.php">Cart</a>
                <a href="/LibraryMS/logout.php">Logout</a>
            <?php else: ?>
                <a href="/LibraryMS/PreviousLogin/previouslogin.php">Login</a>
            <?php endif; ?>
            <a href="/LibraryMS/ContactUs/ContactUs.php">Contact</a>
        </nav>
    </header>

    <main>
        <div class="cart-container">
            <h2>Your Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_price = 0; //Define variable to hold total price
                    if (count($cart_items) > 0): 
                        foreach ($cart_items as $item): 
                            $total_price += $item['price']; // Update total price
                            ?>
                            <tr>
                                <td><img src="/LibraryMS/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100px; height: 150px;"></td>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                                <td>
                                    <form method="post" action="/LibraryMS/remove_from_cart.php">
                                        <input type="hidden" name="book_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (count($cart_items) > 0): ?>
                <div class="purchase-container">
                    <h2>Complete Your Purchase</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="card_number">Card Number:</label>
                        <input type="text" id="card_number" name="card_number" minlength="16" maxlength="16">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" minlength="3" maxlength="3">
                        <label for="expiration_date">Expiration Date:</label>
                        <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" required>
                        <button type="submit">Purchase</button>
                    </form>
                </div>
            <?php endif; ?>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && count($cart_items) > 0): ?>
                <div class="success-message">
                    <p>Your purchase was successful! Total price: $<?php echo $total_price; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>