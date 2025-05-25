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
    <input type="text" name ="job_ref_delete"  required>
    <input type="submit" name ="delete_eoi" value="Delete">
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


