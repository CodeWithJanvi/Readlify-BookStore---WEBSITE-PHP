<?php
include("connection.php");

// Handle status update
if (isset($_GET['mark']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $newStatus = $_GET['mark'];
    if (in_array($newStatus, ['read', 'replied'])) {
        $stmt = $conn->prepare("UPDATE messages SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: message.php");
        exit;
    }
}

// Fetch messages
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Messages</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        h2 {
            color: #ff6f00;
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
        }

        th {
            background-color: #ff6f00;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-new {
            color: #d84315;
            font-weight: bold;
        }

        .status-read {
            color: #2e7d32;
        }

        .status-replied {
            color: #1565c0;
        }

        .btn {
            padding: 6px 12px;
            font-size: 13px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 5px;
            display: inline-block;
        }

        .btn-read {
            background-color: #43a047;
            color: #fff;
        }

        .btn-replied {
            background-color: #1e88e5;
            color: #fff;
        }

        td:last-child {
            white-space: nowrap;
        }

        @media screen and (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 6px;
                padding: 12px;
                background: #fff;
            }

            td {
                text-align: right;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<h2>User Messages</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Received</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td data-label="#"> <?= $row['id'] ?> </td>
                <td data-label="Full Name"> <?= htmlspecialchars($row['fullname']) ?> </td>
                <td data-label="Email"> <?= htmlspecialchars($row['email']) ?> </td>
                <td data-label="Subject"> <?= htmlspecialchars($row['subject']) ?> </td>
                <td data-label="Message"> <?= nl2br(htmlspecialchars($row['message'])) ?> </td>
                <td data-label="Status" class="status-<?= $row['status'] ?>"> <?= ucfirst($row['status']) ?> </td>
                <td data-label="Received"> <?= date("d M Y, h:i A", strtotime($row['created_at'])) ?> </td>
                <td data-label="Action">
                    <?php if ($row['status'] == 'new'): ?>
                        <a class="btn btn-read" href="?mark=read&id=<?= $row['id'] ?>">Mark as Read</a><br>
                    <?php endif; ?>
                    <?php if ($row['status'] != 'replied'): ?>
                        <a class="btn btn-replied" href="?mark=replied&id=<?= $row['id'] ?>">Mark as Replied</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="8" style="text-align:center;">No messages found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
