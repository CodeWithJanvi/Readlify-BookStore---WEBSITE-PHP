<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Email or Username already exists.";
        } else {
            // Insert new user
            $insertStmt = $conn->prepare("INSERT INTO users (fullname, username, email, phone, address, dob, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insertStmt->bind_param("ssssssss", $fullname, $username, $email, $phone, $address, $dob, $gender, $hashed_password);

            if ($insertStmt->execute()) {
                // Redirect after successful signup
                header("Location: login.php?message=registered");
                exit();
            } else {
                $message = "Error: " . $insertStmt->error;
            }

            $insertStmt->close();
        }

        $stmt->close();
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="form-modal" id="signupModal">
  <div class="form-box">
    <h2>Sign Up</h2>

    <?php if (!empty($message)): ?>
      <p style="color: <?= strpos($message, 'success') !== false ? 'green' : 'red' ?>;">
        <?= $message ?>
      </p>
    <?php endif; ?>

    <form method="POST" action="signup.php">

      <div class="input-icon">
        <i class="fas fa-user left-icon"></i>
        <input type="text" name="fullname" placeholder="Full Name" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-user-circle left-icon"></i>
        <input type="text" name="username" placeholder="Username" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-envelope left-icon"></i>
        <input type="email" name="email" placeholder="Email" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-phone left-icon"></i>
        <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" title="Enter 10 digit phone number" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-home left-icon"></i>
        <input type="text" name="address" placeholder="Address" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-calendar-alt left-icon"></i>
        <input type="date" name="dob" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-venus-mars left-icon"></i>
        <select name="gender" required>
          <option value="" disabled selected>Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="input-icon">
        <i class="fas fa-lock left-icon"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>

      <div class="input-icon">
        <i class="fas fa-lock left-icon"></i>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
      </div>

      <button type="submit">Sign Up</button>
    </form>
  </div>
</div>

</body>
</html>
