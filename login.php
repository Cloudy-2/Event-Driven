<?php
session_start();

include "./config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Email']) && isset($_POST['password'])) {
    // Retrieve form data
    $Email = $_POST['Email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if user exists
    $stmt = $conn->prepare("SELECT * FROM logindata WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row returned
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Password'];
        
        // Verify the submitted password against the hashed password
        if(password_verify($password, $hashedPassword)) {
            header("Location: index.php");
            exit(); // Stop further execution
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="./css/login.css">
<link rel="icon" href="./assets/img/icon.jpg">
</head>
<body>

<div class="login-container">
  <h2>Login</h2>
  <form class="login-form" method="post">
    <label for="Email">Email:</label>
    <input type="text" id="Email" name="Email" placeholder="Email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <div style="position: relative;">
      <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
      <label for="show-password">Show Password</label>
    </div><br>
    <input type="submit" id="login" value="Login">
     <p class="register"><a href="register.php">No account? register here</a>.</p>
    <?php if (!empty($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
  </form>
</div>
<div id="video-background">
  <video autoplay muted loop>
    <source src="./assets/img/LoginBgs.mp4" type="video/mp4">
  </video>
</div>

<script>
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}
</script>

</body>
</html>
