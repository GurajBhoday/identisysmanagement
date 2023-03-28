<?php
// connect to the database
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get the ID of the student to delete
$id = $_POST["id"];

// prepare and execute the DELETE statement
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// close the database connection and send a response
$stmt->close();
$conn->close();
echo "success";
?>
