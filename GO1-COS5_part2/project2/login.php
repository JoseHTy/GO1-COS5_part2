<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <title>About Us</title>
  <meta name="description" content="About Us" />
  <meta name="keywords" content="software, web, technology" />
  <meta name="author" content="Jacob Semmel" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
</head>
<body>



<?php
session_start();
    include 'nav.inc'; 

    include 'header.inc'; 


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



</body>
</html>
