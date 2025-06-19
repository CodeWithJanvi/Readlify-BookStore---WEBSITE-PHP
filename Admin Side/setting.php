<?php
session_start();
include("connection.php");

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

$adminId = $_SESSION["admin_id"];
$success = $error = "";

// Fetch current admin info
$stmt = $conn->prepare("SELECT username, email FROM admin WHERE id = ?");
$stmt->bind_param("i", $adminId);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newUsername = trim($_POST["username"]);
    $newEmail = trim($_POST["email"]);
    $newPassword = trim($_POST["password"]);

    if (!empty($newUsername) && !empty($newEmail)) {
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE admin SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $newUsername, $newEmail, $hashedPassword, $adminId);
        } else {
            $stmt = $conn->prepare("UPDATE admin SET username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $newUsername, $newEmail, $adminId);
        }

        if ($stmt->execute()) {
            $success = "✅ Profile updated successfully.";
            $_SESSION["admin_name"] = $newUsername;
        } else {
            $error = "⚠️ Error updating profile.";
        }

        $stmt->close();
    } else {
        $error = "⚠️ Username and email cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Settings</title>
    <style>
        body {
            font-family: Arial;
            background-color: #fff5e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(255, 111, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #ff6f00;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffd180;
            border-radius: 5px;
            background-color: #fffaf0;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #ff6f00;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #e65100;
        }

        .error, .success {
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .error {
            background-color: #ffe0e0;
            color: #c62828;
        }

        .success {
            background-color: #e0f7e9;
            color: #2e7d32;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Admin Profile</h2>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <?php if ($success) echo "<div class='success'>$success</div>"; ?>
    <form method="POST" action="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($admin['username']) ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($admin['email']) ?>" required>

        <label for="password">New Password <small>(leave blank to keep current password)</small></label>
        <input type="password" name="password" id="password" placeholder="Enter new password">

        <input type="submit" value="Update Profile">
    </form>
</div>
</body>
</html>
