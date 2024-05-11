<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dialpro2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch campaign data from the database
$sql = "SELECT campaign FROM login_info"; // Modify the query as needed
$result = $conn->query($sql);

if (!$result) {
    echo "Error fetching data: " . $conn->error;
} else {
    $options = '<option value="" disabled selected>Select Campaign</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['campaign'] . '">' . $row['campaign'] . '</option>';
    }
    echo $options;
}

$conn->close();
?>
