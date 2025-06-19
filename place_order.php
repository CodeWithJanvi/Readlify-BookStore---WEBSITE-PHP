<?php
include 'connection.php';

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body {
            background-color: #fffaf0;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 40px;
            text-align: center;
        }
        .confirmation-box {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border: 2px solid #ffa500;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #ff6600;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin: 12px 0;
        }
        strong {
            color: #ff6600;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST['book_id']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $order_date = date("Y-m-d H:i:s");

    // 1. Fetch book price
    $stmt = $conn->prepare("SELECT price FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $book = $result->fetch_assoc();
        $price = $book['price'];
    } else {
        echo "<div class='confirmation-box'><h2>Invalid book selected.</h2></div>";
        exit;
    }
    $stmt->close();

    // 2. Generate a unique order_id
    $order_id = uniqid();

    // 3. Insert into order_items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, book_id, price, customer_name, address, phone, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sidssss", $order_id, $book_id, $price, $customer_name, $address, $phone, $order_date);

    if ($stmt->execute()) {
        echo "<div class='confirmation-box'>";
        echo "<h2>Order Placed Successfully!</h2>";
        echo "<p>Thank you, <strong>" . htmlspecialchars($customer_name) . "</strong>.</p>";
        echo "<p>Your Order ID: <strong>$order_id</strong></p>";
        echo "<p>Total Price: ₹<strong>$price</strong></p>";
        echo "<a href='index.php'>Back to Home</a>";
        echo "</div>";
    } else {
        echo "<div class='confirmation-box'><h2>Failed to insert into order_items.</h2><p>" . htmlspecialchars($stmt->error) . "</p></div>";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "<div class='confirmation-box'><h2>Invalid request method.</h2></div>";
}

echo '
</body>
</html>';
?>
