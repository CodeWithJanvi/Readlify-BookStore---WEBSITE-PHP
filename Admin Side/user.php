<?php
include("connection.php");

$sql = "SELECT id, fullname, username, email, phone, address, dob, gender FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
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
        max-width: 1000px;
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

    .no-data {
        text-align: center;
        padding: 40px;
        color: #888;
        font-size: 18px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 13px;
            padding: 12px;
        }
    }

    @media (max-width: 480px) {
        th, td {
            font-size: 12px;
            padding: 10px;
        }
    }
</style>

</head>
<body>

<h2>Our Users</h2>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>DOB</th>
        <th>Gender</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row["id"] ?></td>
        <td><?= htmlspecialchars($row["fullname"]) ?></td>
        <td><?= htmlspecialchars($row["username"]) ?></td>
        <td><?= htmlspecialchars($row["email"]) ?></td>
        <td><?= htmlspecialchars($row["phone"]) ?></td>
        <td><?= htmlspecialchars($row["address"]) ?></td>
        <td><?= htmlspecialchars($row["dob"]) ?></td>
        <td><?= htmlspecialchars($row["gender"]) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p class="no-data">No users found in the database.</p>
<?php endif; ?>

</body>
</html>
