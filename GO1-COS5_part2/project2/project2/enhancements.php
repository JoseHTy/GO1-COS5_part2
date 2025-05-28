<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>About Us</title>
  <meta name="description" content="About Us" />
  <meta name="keywords" content="software, web, technology" />
  <meta name="author" content="Manjot" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
</head>
<body>

<?php include 'nav.inc'; ?>
<?php include 'header.inc'; ?>

<h1>Enhancements</h1>

<h2>1. Manager-Controlled Sorting</h2>
<p>
  A dropdown menu on <code>manage.php</code> allows sorting EOIs by EOI Number, Name, Job Ref, or Status. The selected option is validated and passed to the SQL <code>ORDER BY</code> clause, improving data management.
</p>

<h2>2. Access Control on manage.php</h2>
<p>
  A PHP session-based login system restricts <code>manage.php</code> access to authorized users. Unauthenticated users are redirected from <code>login.php</code>, enhancing security.
</p>

<h2>3. Login Attempt Lockout</h2>
<p>
  After 3 failed logins, users are locked out for 5 minutes. Attempts are tracked in a database table, and on success, the count resets. This helps prevent brute-force attacks.
</p>

<h2>4. Manager Registration with Validation</h2>
<p>
  A registration page was created for managers with server-side validation enforcing unique usernames and strong password rules. New accounts are securely stored in the database, allowing controlled user management.
</p>


<?php include 'footer.inc'; ?>
</body>
</html>
