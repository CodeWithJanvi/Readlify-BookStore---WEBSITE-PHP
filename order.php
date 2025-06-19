<?php
include 'connection.php'; // your DB connection file

// Check if book_id is in URL (better to use 'book_id' than just 'id' for clarity)
if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);  // sanitize input

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $book = $result->fetch_assoc();
    } else {
        echo "<h2>Book not found.</h2>";
        exit;
    }
    $stmt->close();
} else {
    echo "<h2>No book selected.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Order Book - <?php echo htmlspecialchars($book['title']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff8f0; color: #333; padding: 20px; }
        .order-container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ffa50050; }
        .book-details img { max-width: 200px; display: block; margin-bottom: 15px; }
        .book-details h3 { margin-top: 0; color: #e67300; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ffa500; border-radius: 4px; }
        button { margin-top: 20px; background: #ff6600; color: white; border: none; padding: 12px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #e65c00; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="order-container">
    <h2>Order Book</h2>

    <div class="book-details">
        <img src="images/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
        <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($book['price'] ?: $book['price']); ?></p>
    </div>

    <form action="place_order.php" method="POST" novalidate>
        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">

        <label for="customer_name">Full Name:</label>
        <input type="text" id="customer_name" name="customer_name" required placeholder="Your full name">

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="3" required placeholder="Your shipping address"></textarea>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required placeholder="Your phone number" pattern="[0-9+\-\s]{7,15}" title="Enter a valid phone number">

        <button type="submit">Place Order</button>
    </form>
</div>

</body>
</html>
