<?php
$host = 'localhost';
$db   = 'project2_database';
$user = '';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO jobs (title, description) VALUES
('IT Support Technician', '<ul>
<li><strong>Position Ref:</strong> ITST01</li>
<li><strong>Location:</strong> Melbourne, Australia</li>
<li><strong>Job type:</strong> Full-time / Part-time</li>
<li><strong>Salary Range:</strong> AUD \$45,000 – \$65,000</li>
<li><strong>Reports To:</strong> IT Manager</li>
</ul>
<h3>About the Role</h3>
<p>As an IT Support Technician, you’ll help diagnose and resolve technical issues...</p>'),

('Junior Network Administrator', '<ul>
<li><strong>Position Ref:</strong> JNA12</li>
<li><strong>Location:</strong> Sydney, Australia</li>
<li><strong>Job type:</strong> Full-time / Internship</li>
<li><strong>Salary Range:</strong> AUD \$50,000 – \$65,000</li>
<li><strong>Reports To:</strong> Senior Network Engineer</li>
</ul>
<h3>About the Role</h3>
<p>As a Junior Network Administrator, you will support network maintenance and security...</p>');";

if ($conn->query($sql)) {
    echo "Jobs inserted successfully!";
}

    echo "Jobs inserted successfully!";

    else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
