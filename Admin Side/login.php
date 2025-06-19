<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["email"] = $email;
                header("Location: index.php");
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with this email.";
        }

        $stmt->close();
    } else {
        $error = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #fff5e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
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
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ffd180;
            border-radius: 6px;
            background-color: #fffaf0;
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
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #e65100;
        }

        .error {
            background-color: #ffe0e0;
            color: #c62828;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
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
    <h2>Login</h2>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST" action="">
        <label for="email">Email Address:</label>
        <input type="text" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>
