<?php
session_start();
require_once("settings.php"); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $errors = [];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM managers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Username already exists.";
        }
        $stmt->close();
    }

    // Validate password (minimum 8 chars)
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    // If no errors, insert new manager
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO managers (username, password) VALUES (?, ?)");
        $insert->bind_param("ss", $username, $hashed_password);
        if ($insert->execute()) {
            echo "<p>Registration successful. You can now <a href='login.php'>login</a>.</p>";
        } else {
            echo "<p>Error during registration. Please try again.</p>";
        }
        $insert->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    $conn->close();
}
?>

<form method="post" action="">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <input type="submit" value="Register">
</form>
