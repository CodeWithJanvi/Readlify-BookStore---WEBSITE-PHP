<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fullname, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $fullname, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $fullname;
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No user found with this email.";
    }

    $stmt->close();
}
?>

<!-- HTML Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="form-modal" id="loginModal" style="display: block;">
  <div class="form-box">
    <h2>Login</h2>

    <?php if (!empty($message)): ?>
      <p style="color: red;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="input-icon">
        <i class="fas fa-envelope left-icon"></i>
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="input-icon">
        <i class="fas fa-lock left-icon"></i>
        <input type="password" name="password" placeholder="Password" id="loginPass" required />
        <i class="fas fa-eye toggle-password right-icon" onclick="togglePassword('loginPass', this)"></i>
      </div>
      <div class="form-options">
        <label><input type="checkbox" /> Remember Me</label>
        <a href="forgot-password.php">Forgot Password?</a>

      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</div>

<script>
function togglePassword(inputId, icon) {
  const input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}
</script>

</body>
</html>
