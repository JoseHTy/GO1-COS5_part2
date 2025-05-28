<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <title>Process_Eoi</title>
  <meta name="description" content="About Us" />
  <meta name="keywords" content="software, web, technology" />
  <meta name="author" content="Jose" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
</head>


<body>

  <?php include 'nav.inc'; ?>

    <?php include 'header.inc'; ?>


<?php
// Prevent direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php");
    exit();
}

// Sanitize function 
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate and sanitize form data
$errors = [];

$reference_number = clean_input($_POST['reference_number'] ?? '');
$first_name = clean_input($_POST['Given_Name'] ?? '');
$last_name = clean_input($_POST['Last_Name'] ?? '');
$dob = clean_input($_POST['Date_Of_Birth'] ?? '');
$gender = clean_input($_POST['Gender'] ?? '');
$street_address = clean_input($_POST['Street_Address'] ?? '');
$suburb = clean_input($_POST['Suburb'] ?? '');
$state = clean_input($_POST['State'] ?? '');
$postcode = clean_input($_POST['Postcode'] ?? '');
$email = clean_input($_POST['Email_Address'] ?? '');
$phone = clean_input($_POST['Phone_Number'] ?? '');
$otherskills = clean_input($_POST['Other_Skills'] ?? '');
$required_skills = $_POST['Required_Technical_List'] ?? [];

// Field validations
if (empty($reference_number)) $errors[] = "Job reference is required.";
if (!preg_match("/^[a-zA-Z]{1,20}$/", $first_name)) $errors[] = "Invalid first name.";
if (!preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) $errors[] = "Invalid last name.";
if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $dob)) $errors[] = "Date of birth must be in dd/mm/yyyy format.";
if (empty($gender)) $errors[] = "Gender is required.";
if (strlen($street_address) > 40) $errors[] = "Address must be 40 characters or less.";
if (strlen($suburb) > 40) $errors[] = "Suburb must be 40 characters or less.";
if (!in_array($state, ['Victoria', 'New South Wales', 'Queensland', 'Northern Territory', 'West Australia', 'South Australia', 'Tasmania', 'Australian Capital Territory'])) $errors[] = "Invalid state.";
if (!preg_match("/^\d{4}$/", $postcode)) $errors[] = "Postcode must be 4 digits.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
if (!preg_match("/^[\d ]{8,12}$/", $phone)) $errors[] = "Phone number must be 8–12 digits or spaces.";
if (count($required_skills) === 0) $errors[] = "At least one technical skill must be selected.";

// Postcode-State Match
$statePostcodeMap = [
    'Victoria' => ['3', '8'],
    'New South Wales' => ['1', '2'],
    'Queensland' => ['4', '9'],
    'Northern Territory'  => ['0'],
    'West Australia'  => ['6'],
    'South Australia'  => ['5'],
    'Tasmania' => ['7'],
    'Australian Capital Territory' => ['0']
];
if (isset($statePostcodeMap[$state])) {
    if (!in_array(substr($postcode, 0, 1), $statePostcodeMap[$state])) {
        $errors[] = "Postcode does not match selected state.";
    }
} else {
    $errors[] = "Invalid state selection.";
}


// Show errors if any
if (!empty($errors)) {
    echo "<h2>Form submission failed due to the following errors:</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul><p><a href='apply.php'>Go back to the application form</a></p>";
    exit();
}

// Connect to database
require_once("settings.php"); // contains $host, $user, $pwd, $sql_db

$conn = @mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("<p>Database connection failure</p>");
}

// Create table if not exists
$table = "eoi";
$createTable = "CREATE TABLE IF NOT EXISTS $table (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    JobRefNumber VARCHAR(10),
    FirstName VARCHAR(20),
    LastName VARCHAR(20),
    StreetAddress VARCHAR(40),
    Suburb VARCHAR(40),
    State VARCHAR(3),
    Postcode VARCHAR(4),
    Email VARCHAR(50),
    Phone VARCHAR(12),
    Skill1 VARCHAR(30),
    Skill2 VARCHAR(30),
    Skill3 VARCHAR(30),
    Skill4 VARCHAR(30),
    Skill5 VARCHAR(30),
    OtherSkills TEXT,
    Status VARCHAR(10) DEFAULT 'New'
)";
mysqli_query($conn, $createTable);

// Prepare skill fields
$skillFields = array_fill(0, 5, null);
for ($i = 0; $i < count($required_skills) && $i < 5; $i++) {
    $skillFields[$i] = clean_input($required_skills[$i]);
}

// Insert into table
$insertQuery = "INSERT INTO $table 
(JobRefNumber, FirstName, LastName, StreetAddress, Suburb, State, Postcode, Email, Phone, 
 Skill1, Skill2, Skill3, Skill4, Skill5, OtherSkills) 
VALUES (
    '$reference_number', '$first_name', '$last_name', '$street_address', '$suburb', '$state', '$postcode', '$email', '$phone',
    '{$skillFields[0]}', '{$skillFields[1]}', '{$skillFields[2]}', '{$skillFields[3]}', '{$skillFields[4]}',
    '$otherskills'
)";

if (mysqli_query($conn, $insertQuery)) {
    $eoiID = mysqli_insert_id($conn);
    echo "<h2>Application Received</h2>";
    echo "<p>Your application has been submitted successfully.</p>";
    echo "<p>Your EOI Number is: <strong>$eoiID</strong></p>";
} else {
    echo "<p>Something went wrong. Please try again later.</p>";
}


mysqli_close($conn);





?>
<?php include 'footer.inc'; ?>
