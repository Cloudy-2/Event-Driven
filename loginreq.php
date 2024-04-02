<?php
session_start();

include 'database.php';

$error = "";

if(isset($_POST['Email']) && isset($_POST['password'])) {
    // Retrieve form data
    $Email = htmlspecialchars($_POST['Email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM LoginData WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Password'];
        
        if(password_verify($password, $hashedPassword)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {

        $error = "User does not exist.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Email or password not provided
    $error = "Email or password not provided.";
}
?>
