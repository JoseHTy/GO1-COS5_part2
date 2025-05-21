<?php
// process_eoi.php

// Prevent direct access
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.php");
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Required fields
$required = [
    "reference_number", "Given_Name", "Last_Name", "Date_Of_Birth", "Gender",
    "Street_Address", "Suburb", "State", "Postcode", "Email_Address", "Phone_Number", "Required_Technical_List"
];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
        die("Error: Missing required field '$field'");
    }
}

// Sanitize inputs
$job_ref     = sanitize_input($_POST["reference_number"]);
$first_name  = sanitize_input($_POST["Given_Name"]);
$last_name   = sanitize_input($_POST["Last_Name"]);
$dob         = sanitize_input($_POST["Date_Of_Birth"]);
$gender      = sanitize_input($_POST["Gender"]);
$street      = sanitize_input($_POST["Street_Address"]);
$suburb      = sanitize_input($_POST["Suburb"]);
$state       = sanitize_input($_POST["State"]);
$postcode    = sanitize_input($_POST["Postcode"]);
$email       = sanitize_input($_POST["Email_Address"]);
$phone       = sanitize_input($_POST["Phone_Number"]);
$skills      = is_array($_POST["Required_Technical_List"]) ? implode(", ", $_POST["Required_Technical_List"]) : sanitize_input($_POST["Required_Technical_List"]);
$otherskills = isset($_POST["Other_Skills"]) ? sanitize_input($_POST["Other_Skills"]) : "";

// Validations
if (!preg_match("/^[a-zA-Z]{1,20}$/", $first_name)) die("Invalid first name");
if (!preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) die("Invalid last name");
if (!preg_match("/^\\d{2}\\/\\d{2}\\/\\d{4}$/", $dob)) die("Invalid date format, use dd/mm/yyyy");
if (!in_array($state, ["VIC","NSW","QLD","NT","WA","SA","TAS","ACT"])) die("Invalid state");
if (!preg_match("/^\\d{4}$/", $postcode)) die("Postcode must be exactly 4 digits");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Invalid email format");
if (!preg_match("/^\\d{8,12}$/", preg_replace("/\\s+/", "", $phone))) die("Phone must be 8-12 digits");

// Postcode/state match
$map = [
    "VIC" => "/^3|8/", "NSW" => "/^1|2/", "QLD" => "/^4|9/", "NT" => "/^0/",
    "WA" => "/^6/", "SA" => "/^5/", "TAS" => "/^7/", "ACT" => "/^0/"
];
if (!preg_match($map[$state], $postcode[0])) die("Postcode does not match the selected state");

// Connect to DB
require_once("settings.php"); // $host, $user, $pswd, $db
$conn = @mysqli_connect($host, $user, $pswd, $db);
if (!$conn) die("DB Connection failed: " . mysqli_connect_error());


// Insert data
$dob_mysql = DateTime::createFromFormat("d/m/Y", $dob)->format("Y-m-d");

$query = "INSERT INTO EOI
    (JobRef, FirstName, LastName, DOB, Gender, Street, Suburb, State, Postcode, Email, Phone, Skills, OtherSkills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssssssssssss",
    $job_ref, $first_name, $last_name, $dob_mysql, $gender, $street, $suburb,
    $state, $postcode, $email, $phone, $skills, $otherskills);

if (mysqli_stmt_execute($stmt)) {
    $eoi_id = mysqli_insert_id($conn);
    echo "<h2>Application Submitted!</h2>";
    echo "<p>Your EOI Number: <strong>{$eoi_id}</strong></p>";
} else {
    echo "<p>Error submitting your application.</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>