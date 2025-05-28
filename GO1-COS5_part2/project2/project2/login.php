<?php
session_start();
require_once("settings.php"); // DB connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error reporting

// Hardcoded credentials
$validUsername = 'admin';
$validPassword = 'password123';

$error = "";

// Check if login form is submitted
if (isset($_POST['login'])) {
    $inputUser = $_POST['user'];
    $inputPass = $_POST['pass'];

    $now = date("Y-m-d H:i:s");

    // Get login attempts and lockout time
    $stmt = $conn->prepare("SELECT attempts, locked_until FROM login_attempts WHERE username = ?");
    $stmt->bind_param("s", $inputUser);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($attempts, $locked_until);
    $stmt->fetch();

    // Account is locked
    if ($stmt->num_rows > 0 && $locked_until !== null && $now < $locked_until) {
        $error = "Account is locked. Try again after " . $locked_until;

    } elseif ($inputUser === $validUsername && $inputPass === $validPassword) {
        // Successful login
        $_SESSION['loggedin'] = true;

        // Clear any previous attempts
        $delete = $conn->prepare("DELETE FROM login_attempts WHERE username = ?");
        $delete->bind_param("s", $inputUser);
        $delete->execute();

        header("Location: manage.php");
        exit();

    } else {
        // Invalid login
        if ($stmt->num_rows > 0) {
            $attempts++;
            if ($attempts >= 3) {
                $lockUntil = date("Y-m-d H:i:s", strtotime("+5 minutes"));
                $update = $conn->prepare("UPDATE login_attempts SET attempts = ?, locked_until = ? WHERE username = ?");
                $update->bind_param("iss", $attempts, $lockUntil, $inputUser);
                $update->execute();
                $error = "Too many failed attempts. Account locked for 5 minutes.";
            } else {
                $update = $conn->prepare("UPDATE login_attempts SET attempts = ? WHERE username = ?");
                $update->bind_param("is", $attempts, $inputUser);
                $update->execute();
                $error = "Invalid login. Attempt $attempts of 3.";
            }
        } else {
            // First attempt
            $attempts = 1;
            $insert = $conn->prepare("INSERT INTO login_attempts (username, attempts) VALUES (?, ?)");
            $insert->bind_param("si", $inputUser, $attempts);
            $insert->execute();
            $error = "Invalid login. Attempt 1 of 3.";
        }
    }
}
?>

<!-- HTML Starts Here -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <meta name="description" content="Login" />
  <meta name="keywords" content="software, web, technology" />
  <meta name="author" content="Jacob Semmel" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
</head>
<body>

<?php
include 'nav.inc';
include 'header.inc';
?>

<h2>Login</h2>
<form method="post" action="">
    <label>Username: <input type="text" name="user" required></label><br>
    <label>Password: <input type="password" name="pass" required></label><br>
    <input type="submit" name="login" value="Login">
</form>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>
<?php
session_start();
require_once("settings.php"); // DB connection

if (isset($_POST['login'])) {
    $inputUser = $_POST['user'];
    $inputPass = $_POST['pass'];

    $stmt = $conn->prepare("SELECT password FROM managers WHERE username = ?");
    $stmt->bind_param("s", $inputUser);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($inputPass, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $inputUser;
            header("Location: manage.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
    $conn->close();
}
?>

