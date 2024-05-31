<?php
require '../AdminPanel/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $publisher = $_POST['publisher'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $category = $_POST['category'] ?? '';
    
    // File upload process
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        die("File is not an image.");
    }
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = basename($_FILES["image"]["name"]);
    } else {
        die("Sorry, there was an error uploading your file.");
    }

    // Adding a book to the database
    $stmt = $conn->prepare("INSERT INTO books (title, author, publisher, quantity, category, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $author, $publisher, $quantity, $category, $image);

    if ($stmt->execute()) {
        header("Location: /LibraryMS/Categories/{$category}.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
