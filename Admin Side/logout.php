<?php
session_start();            // Start the session
session_unset();            // Remove all session variables
session_destroy();          // Destroy the session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <meta http-equiv="refresh" content="3;url=login.php">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5e6;
            text-align: center;
            padding-top: 100px;
        }
        h2 {
            color: #ff6f00;
        }
        p, a {
            color: #333;
            font-size: 16px;
        }
        a {
            color: #ff6f00;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>You have been logged out successfully.</h2>
    <p>Redirecting to login page in 3 seconds...</p>
    <p>If not redirected, <a href="login.php">click here to login</a>.</p>
</body>
</html>
