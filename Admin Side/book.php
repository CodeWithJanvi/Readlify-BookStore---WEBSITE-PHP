<?php
include("connection.php");

$success = $error = "";

// Handle Add Book
if (isset($_POST["add"])) {
    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $price = trim($_POST["price"]);
    $rating = intval($_POST["rating_star"]);
    $feature = $_POST["feature"];

    // Upload image
    $imageName = "";
    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "images/" . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
    }

    if ($title && $author && $price) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, price, image, rating_star, feature, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssdsss", $title, $author, $price, $imageName, $rating, $feature);
        $stmt->execute();
        $success = "✅ Book added successfully!";
        $stmt->close();
    } else {
        $error = "⚠️ All fields are required.";
    }
}

// Handle Delete Book
if (isset($_GET["delete"])) {
    $deleteId = intval($_GET["delete"]);
    $conn->query("DELETE FROM books WHERE id = $deleteId");
    header("Location: book.php");
    exit;
}

// Fetch books
$books = $conn->query("SELECT * FROM books ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Books</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma;
            background: #fffaf4;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        form {
            background: #fff;
            max-width: 600px;
            margin: 0 auto 30px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(255, 111, 0, 0.15);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffd180;
            background: #fffdf7;
            border-radius: 6px;
            margin-top: 5px;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background: #ff6f00;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .message {
            max-width: 600px;
            margin: 10px auto;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
        }

        .success { background: #e0f7e9; color: #2e7d32; }
        .error { background: #ffe0e0; color: #c62828; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            min-width: 900px;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #f2f2f2;
        }

        th {
            background: #ff6f00;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background: #fff7ef;
        }

        .action-btns a {
            margin-right: 8px;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
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

        img.thumb {
            width: 60px;
            height: 80px;
            object-fit: cover;
        }

        .table-container {
            max-width: 1200px;
            margin: auto;
            overflow-x: auto;
        }
    </style>
</head>
<body>

<h2>Add New Book</h2>

<?php if ($success) echo "<div class='message success'>$success</div>"; ?>
<?php if ($error) echo "<div class='message error'>$error</div>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Author</label>
    <input type="text" name="author" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <label>Upload Image</label>
    <input type="file" name="image" accept="image/*">

    <label>Rating Star (1-5)</label>
    <select name="rating_star" required>
        <option value="">Select rating</option>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
        <?php endfor; ?>
    </select>

    <label>Feature</label>
    <select name="feature" required>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>

    <input type="submit" name="add" value="Add Book">
</form>

<h2>All Books</h2>
<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
        <th>Rating</th>
        <th>Featured</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $books->fetch_assoc()): ?>
    <tr>
        <td><?= $row["id"] ?></td>
        <td>
            <?php if ($row["image"]): ?>
               <img src="images/<?= htmlspecialchars($row["image"]) ?>" class="thumb" alt="Book Cover">

            <?php else: ?>
                N/A
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row["title"]) ?></td>
        <td><?= htmlspecialchars($row["author"]) ?></td>
        <td>₹<?= htmlspecialchars($row["price"]) ?></td>
        <td><?= htmlspecialchars($row["rating_star"]) ?>⭐</td>
        <td><?= $row["feature"] ?></td>
        <td><?= $row["created_at"] ?></td>
        <td class="action-btns">
            <a class="edit-btn" href="edit-book.php?id=<?= $row['id'] ?>">Edit</a>
            <a class="delete-btn" href="book.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this book?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

</body>
</html>