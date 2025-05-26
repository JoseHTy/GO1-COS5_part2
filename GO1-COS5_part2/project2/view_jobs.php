<?php
$host = 'localhost';
$db   = 'project2_database';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT title, description FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Listings</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .job { border: 1px solid #ccc; margin: 20px 0; padding: 15px; border-radius: 8px; }
        .job h2 { margin-top: 0; }
    </style>
</head>
<body>
    <h1>Current Job Openings</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='job'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo $row['description'];  
            echo "</div>";
        }
    } else {
        echo "<p>No job postings available.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
