<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
    <link rel="stylesheet" href="manage_books.css">
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
            <div class="card">
                <h2>Add New Book</h2>
                <form action="add_book.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Title" required><br>
                    <input type="text" name="author" placeholder="Author" required><br>
                    <input type="text" name="publisher" placeholder="Publisher" required><br>
                    <input type="number" name="quantity" placeholder="Quantity" required><br>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="autobiography">Autobiography</option>
                        <option value="biography">Biography</option>
                        <option value="classics">Classics</option>
                        <option value="history">History</option>
                    </select><br>
                    <input type="file" name="image" accept="image/*" required><br>
                    <button type="submit" class="submit-btn">Add</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
