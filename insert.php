<?php
// Include database configuration file
include 'config.php';
// Get the ID value from the form input



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);

    // Insert form data into database
    $sql = "INSERT INTO students (id, name, gender, email, mobile) VALUES ('$id', '$name', '$gender', '$email', '$mobile')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to index page with success message
        header("Location: table.php?msg=success");
        exit();
    } else {
        // Redirect to add page with error message
        header("Location: add.php?msg=error");
        exit();
    }
} else {
    // Redirect to add page
    header("Location: add.php");
    exit();
}
?>
