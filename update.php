<?php
  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "students";
  
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Update record
  $id = $_POST["id"];
  $name = $_POST["name"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];

  $sql = "UPDATE student SET name='$name', gender='$gender', email='$email', mobile='$mobile' WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    header("location: index.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close connection
  mysqli_close($conn);
?>
