<?php
// START SESSION AND ENABLE ERROR REPORTING
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DATABASE CONNECTION
include("connection.php");

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM admin WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "⚠️ Email already exists. Please use a different one.";
        } else {
            $stmt = $conn->prepare("INSERT INTO admin(username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $success = "✅ Registration successful! You can login now.";
            } else {
                $error = "⚠️ Something went wrong. Try again.";
            }

            $stmt->close();
        }
        $check->close();
    } else {
        $error = "⚠️ All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff5e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(255, 111, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #ff6f00;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ffd180;
            border-radius: 6px;
            background-color: #fffaf0;
            box-sizing: border-box;
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
            font-size: 14px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            background-color: #ffe0e0;
            color: #c62828;
        }

        .success {
            background-color: #e0f7e9;
            color: #2e7d32;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #ff6f00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Sign Up</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='success'>$success</div>"; ?>
    <form method="POST" action="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter Username" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter Email Address" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Create Password" required>

        <input type="submit" value="Sign Up">
    </form>
    <p>Already registered? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
