<?php
include("connection.php");

// Handle delete request
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $conn->query("DELETE FROM order_items WHERE id = $deleteId");
    header("Location: order.php");
    exit;
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_status"])) {
    $orderId = intval($_POST["order_id"]);
    $status = $_POST["status"];
    $stmt = $conn->prepare("UPDATE order_items SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $orderId);
    $stmt->execute();
    $stmt->close();
    header("Location: order.php");
    exit;
}

// Fetch order data
$sql = "SELECT id, order_id, book_id, price, customer_name, address, phone, order_date, status FROM order_items ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Orders</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        padding: 40px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .table-container {
        max-width: 1100px;
        margin: auto;
        overflow-x: auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        min-width: 700px;
    }

    th, td {
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }

    th {
        background-color: #ff6f00;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
    }

    tr:nth-child(even) {
        background-color: #fdf6f0;
    }

    tr:hover {
        background-color: #fff0e0;
    }

    td {
        color: #444;
        font-size: 15px;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .actions a, .actions form button {
        text-decoration: none;
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }

    .edit-btn {
        background-color: #2196f3;
        color: white;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    .status-form {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-form select {
        padding: 5px;
        font-size: 13px;
    }

    .status-form button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 5px 8px;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: #888;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 13px;
            padding: 10px;
        }
    }
    </style>
</head>
<body>

<h2>Order Details</h2>

<div class="table-container">
<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Book ID</th>
            <th>Price</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php $count = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= htmlspecialchars($row["order_id"]) ?></td>
            <td><?= htmlspecialchars($row["book_id"]) ?></td>
            <td>₹<?= htmlspecialchars($row["price"]) ?></td>
            <td><?= htmlspecialchars($row["customer_name"]) ?></td>
            <td><?= htmlspecialchars($row["address"]) ?></td>
            <td><?= htmlspecialchars($row["phone"]) ?></td>
            <td><?= htmlspecialchars($row["order_date"]) ?></td>
            <td>
                <form method="POST" class="status-form">
                    <input type="hidden" name="order_id" value="<?= $row["id"] ?>">
                    <select name="status">
                        <option <?= $row["status"] == "Pending" ? "selected" : "" ?>>Pending</option>
                        <option <?= $row["status"] == "Shipped" ? "selected" : "" ?>>Shipped</option>
                        <option <?= $row["status"] == "Delivered" ? "selected" : "" ?>>Delivered</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
            <td class="actions">
    
                <a href="order.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="no-data">No orders found in the database.</p>
<?php endif; ?>
</div>

</body>
</html>
