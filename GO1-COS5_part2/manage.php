<?php
require_once("settings.php");

function displayResults($result) {      //this is a table created to retrieve data from  my sql query 
    // and for the manager to search different parts of it .
    if (mysqli_num_rows($result) > 0) {
echo "<table border='1'><tr>
<th>EOInumber</th><th>Job ref</th><th>Name</th><th>Email</th>
<th>Phone</th><th>status</th></tr>";
while ($row = mysqli_fetch_assoc($result)){

echo "<tr>
<td>{$row['EOInumber']}</td>
<td>{$row['JobRefNumber']}</td>
<td>{$row['FirstName']}</td>
<td>{$row['LastName']}</td>
<td>{$row['Email']}</td>
<td>{$row['Phone']}</td>
<td>{$row['Status']}</td>
</tr>";
}                echo "</table><br>";
            }else {
        echo "<p> No Result found. </p>" ;
    }
}

// List of all Eois mentioned

if (!isset($_POST['search_job']) && !isset($_POST['search_name']) && !isset($_POST['delete_eoi']) && !isset($_POST['update_status'])) {
    $result = mysqli_query($conn, "SELECT * FROM eoi");
    echo "<h2>All EOIs</h2>";
    displayResults($result);
}

// Search by Job Reference
if (isset($_POST['search_job'])) {
    $job_ref = mysqli_real_escape_string($conn, $_POST['job_ref']);
    $result = mysqli_query($conn, "SELECT * FROM eoi WHERE JobRefNumber = '$job_ref'");
    echo "<h2>EOIs for Job Ref: $job_ref</h2>";
    displayResults($result);
}
// Search by Name
if (isset($_POST['search_name'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $sql = "SELECT * FROM eoi WHERE FirstName LIKE '%$fname%' OR LastName LIKE '%$lname%'";
    $result = mysqli_query($conn, $sql);
    echo "<h2>EOIs for Applicant: $fname $lname</h2>";
    displayResults($result);
}

// Delete EOIs by Job Reference
if (isset($_POST['delete_eoi'])) {
    $job_ref = mysqli_real_escape_string($conn, $_POST['job_ref_delete']);
    $sql = "DELETE FROM eoi WHERE JobRefNumber = '$job_ref'";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Deleted all EOIs for Job Ref: $job_ref</p>";
    } else {
        echo "<p>Error deleting EOIs.</p>";
    }
}


// Changing the status of jobs
if (isset($_POST['update_status'])) {
    $eoi = (int)$_POST['eoi_number'];
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
    $sql = "UPDATE eoi SET Status = '$new_status' WHERE EOInumber = $eoi";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Updated status of EOI #$eoi to '$new_status'.</p>";
    } else {
        echo "<p>Error updating status.</p>";
    }
}
mysqli_close($conn);
?>
<h2>Manager Tools</h2>

<!-- Search by Job Reference --> <!--created to make a form for that specific button -->
<form method="post">
    <h3>Search EOIs by Job Ref</h3>
    <input type="text" name="job_ref" required>
    <input type="submit" name="search_job" value="Search">
</form>

<!-- Search by Name -->
<form method="post">
    <h3>Search EOIs by Applicant Name</h3>
    <input type="text" name="first_name" placeholder="First name">
    <input type="text" name="last_name" placeholder="Last name">
    <input type="submit" name="search_name" value="Search">
</form>

<!-- Delete EOIs by Job Reference -->
<form method="post">
    <h3>Delete EOIs by Job Ref</h3>
    <input type="text" name="job_ref_delete" required>
    <input type="submit" name="delete_eoi" value="Delete">
</form>

<!-- Update Status -->
<form method="post">
    <h3>Update EOI Status</h3>
    <input type="number" name="eoi_number" placeholder="EOI #" required>
    <select name="new_status">
        <option value="New">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
    </select>
    <input type="submit" name="update_status" value="Update">
</form>

