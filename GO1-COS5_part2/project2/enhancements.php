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
        A dropdown menu was added to <code>manage.php</code> allowing the manager to sort EOI records by fields such as 
        EOI Number, First Name, Last Name, Job Reference Number, and Status. The selected field is passed via GET, 
        validated against a whitelist, and used in the SQL <code>ORDER BY</code> clause. This improves usability and 
        helps managers organize submissions efficiently.
    </p>
    <h2>2. Access Control on manage.php</h2>
<p>
    A login system was added using PHP sessions to restrict access to <code>manage.php</code>. 
    Users must enter a valid username and password on <code>login.php</code>. If not authenticated, 
    they are redirected. This enhances security by ensuring only authorized users can view or manage EOIs.
</p>


    <?php include 'footer.inc'; ?>
</body>
</html>
