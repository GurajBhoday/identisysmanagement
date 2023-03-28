<?php
  // Connect to database
  include 'config.php';
  
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get record by id
  $id = $_GET["id"];

  $sql = "SELECT * FROM student WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  } else {
    echo "Record not found";
  }

  // Close connection
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>Edit Student</h1>
    <form action="update.php" method="post">
    <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
      </select>
      <label for="email">Email</label>
      <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" required>
      <label for="mobile">Mobile</label>
      <input type="text" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>" required>
      <input type="submit" value="Update Student">
    </form>
    <button type="button" class="btn btn-primary" onclick="window.location.href='table.php'">Back to List</button>
  </body>
</html>

