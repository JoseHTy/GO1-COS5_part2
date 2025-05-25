<?php
require_once("settings.php");

$query = "SELECT * FROM eoi ORDER BY EOInumber DESC";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>EOInumber</th><th>Job Ref No</th><th>First Name</th>...etc</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        // output rows
    }
    echo "</table>";
} else {
    echo "<p>No EOI records found.</p>";
}

mysqli_close($conn);
?>