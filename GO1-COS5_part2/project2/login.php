<?php
session_start();

$username = 'admin';
$password = 'password123';

if (isset($_POST['login'])) {
    if ($_POST['user'] === $username && $_POST['pass'] === $password) {
        $_SESSION['loggedin'] = true;
        header("Location: manage.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<form method="post" action="">
    <label>Username: <input type="text" name="user" required></label><br>
    <label>Password: <input type="password" name="pass" required></label><br>
    <input type="submit" name="login" value="Login">
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
