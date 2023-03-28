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

  // Display records
  $sql = "SELECT * FROM student";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row["id"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo "<td>".$row["gender"]."</td>";
      echo "<td>".$row["email"]."</td>";
      echo "<td>".$row["mobile"]."</td>";
      echo "<td><a href='edit.php?id=".$row["id"]."'>Edit</a> | <a href='delete.php?id=".$row["id"]."'>Delete</a></td>";
      echo "</tr>";
    }
  } else {
   
    echo "<tr><td colspan='6'>No records found</td></tr>";
  }

  // Close connection
  mysqli_close($conn);
?>
