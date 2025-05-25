<?php
require_once("settings.php");

$query = "SELECT * FROM eoi ORDER BY EOInumber DESC";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>EOInumber</th><th>Job Ref No</th><th>First Name</th>...etc</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        
    }
    echo "</table>";
} else {
    echo "<p>No EOI records found.</p>";
}

mysqli_close($conn);

$allowed_sort_fields = ['EOINumber', 'FirstName', 'LastName', 'JobRefNumber', 'ApplicationStatus'];

$sort_field = 'EOINumber'; 

if (isset($_GET['sortby']) && in_array($_GET['sortby'], $allowed_sort_fields)) {
    $sort_field = $_GET['sortby'];
}

$query = "SELECT * FROM eoi ORDER BY $sort_field ASC";  
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['EOINumber']}</td>";
    echo "<td>{$row['FirstName']}</td>";
    echo "<td>{$row['LastName']}</td>";
    echo "<td>{$row['JobRefNumber']}</td>";
    echo "<td>{$row['ApplicationStatus']}</td>";
    echo "</tr>";
}

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

?>
<form method="get" action="manage.php">
    <label for="sortby">Sort by:</label>
    <select name="sortby" id="sortby">
        <option value="job_reference_number">Job Reference Number</option>
        <option value="first_name">First Name</option>
        <option value="last_name">Last Name</option>
        <option value="application_date">Date Applied</option>
    </select>
    <input type="submit" value="Sort">
</form>
<a href="logout.php">Logout</a>



