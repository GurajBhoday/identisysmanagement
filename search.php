
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Search Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>Search Student</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
      <label for="id">Student ID</label>
      <input type="text" id="id" name="id" required>
      <input type="submit" value="Search">
    </form>
    <?php
  include('config.php');
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
      $id = $_GET["id"];
      $sql = "SELECT * FROM students WHERE id=$id";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<h2>Student Details</h2>";
        echo "<p><strong>ID: </strong>".$row["id"]."</p>";
        echo "<p><strong>Name: </strong>".$row["name"]."</p>";
        echo "<p><strong>Gender: </strong>".$row["gender"]."</p>";
        echo "<p><strong>Email: </strong>".$row["email"]."</p>";
        echo "<p><strong>Mobile: </strong>".$row["mobile"]."</p>";
      } else {
        echo "<p>No student found with ID $id</p>";
      }
    } else {
      echo "<p>Please scan a student ID</p>";
    }
  }
?>
    <button type="button" class="btn btn-primary" onclick="window.location.href='table.php'">Back to List</button>
  </body>
</html>
