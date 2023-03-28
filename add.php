<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>Add Student</h1>
    <form action="insert.php" method="post">
      <label for="id">ID</label>
      <input type="text" id="id" name="id" placeholder="Scan ID" required>
      <label for="name">Name</label>
      <input type="text" id="name" name="name"  placeholder="Enter Name" required>
      <label for="gender">Gender</label>
      <select id="gender" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
      <label for="email">Email</label>
      <input type="text" id="email" name="email"  placeholder="Enter Email" required>
      <label for="mobile">Mobile</label>
      <input type="text" id="mobile" name="mobile"  placeholder="Enter Mobile No." required>
      <input type="submit" value="Add Student ">
    </form>
    <button type="button" class="btn btn-primary" onclick="window.location.href ='table.php'">Back to List</button>
  </body>
</html>
