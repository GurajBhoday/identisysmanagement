<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $sql = "INSERT INTO students (id, name, gender, email, mobile) VALUES ('$id', '$name', '$gender', '$email', '$mobile')";
  if (mysqli_query($conn, $sql)) {
    echo "success";
  }
  else {
    echo "failure";
  }
}

// if the form was submitted, add the new student to the database
if (isset($_POST["name"]) && isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["mobile"])) {
  $name = $_POST["name"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];

  $stmt = $conn->prepare("INSERT INTO students (name, gender, email, mobile) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $gender, $email, $mobile);
  $stmt->execute();
  $stmt->close();
}

// if the delete button was clicked, delete the student from the database
if (isset($_POST["delete"])) {
  $id = $_POST["delete"];
  $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

// get the list of students from the database
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

// check for errors in the query
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Student Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      function deleteStudent(id) {
        if (confirm("Are you sure you want to delete this student?")) {
          $.post("delete.php", {id: id}, function(response) {
            if (response == "success") {
              $("#row-"+id).remove();
            }
            else {
              alert("Failed to delete student.");
            }
          });
        }
      }
      $(document).ready(function() {
        $("#add-student-form").submit(function(event) {
          event.preventDefault();
          var form = $(this);
          $.post("add.php", form.serialize(), function(response) {
            if (response == "success") {
              var table = $("#student-table tbody");
              var newRow = $("<tr>");
              var nameCol = $("<td>").text(form.find("#name").val());
              var genderCol = $("<td>").text(form.find("#gender").val());
              var emailCol = $("<td>").text(form.find("#email").val());
          var mobileCol = $("<td>").text(form.find("#mobile").val());
          var deleteCol = $("<td>");
          var deleteButton = $("<button>").addClass("btn btn-danger").text("Delete");
          deleteButton.click(function() {
            deleteStudent(form.find("#id").val());
          });
          deleteCol.append(deleteButton);
          newRow.append(nameCol);
          newRow.append(genderCol);
          newRow.append(emailCol);
          newRow.append(mobileCol);
          newRow.append(deleteCol);
          table.append(newRow);
          form.trigger("reset");
        }
        else {
          alert("Failed to add student.");
        }
      });
    });

    // Code for editing the student data
    $('.edit').click(function () {
      var studentRow = $(this).closest('tr');
      var id = studentRow.attr('id');
      var name = studentRow.find('.name').text();
      var gender = studentRow.find('.gender').text();
      var email = studentRow.find('.email').text();
      var mobile = studentRow.find('.mobile').text();

      $('#id').val(id);
      $('#name').val(name);
      $('#gender').val(gender);
      $('#email').val(email);
      $('#mobile').val(mobile);
      $('#add-student-form').attr('action', 'edit.php');
      $('#submit-button').text('Update');
    });
  });
</script>
</head>
  <body>
    <div class="container">
      <h2>Student Database</h2>
      <table class="table table-striped" id="student-table">
      <button type="button" class="btn btn-primary" onclick="window.location.href ='search.php'">Search</button>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr id='".$row["id"]."'>";
              echo "<td>".$row["id"]."</td>";
              echo "<td class='name'>".$row["name"]."</td>";
              echo "<td class='gender'>".$row["gender"]."</td>";
              echo "<td class='email'>".$row["email"]."</td>";
              echo "<td class='mobile'>".$row["mobile"]."</td>";
              echo "<td><button class='btn btn-primary edit'> Edit </button>&nbsp;<button class='btn btn-danger' onclick='deleteStudent(".$row["id"].")'>Delete</button></td>";
              echo "</tr>";
            }
          }
          else {
            echo "<tr><td colspan='6'>No students found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
      <button type="button" class="btn btn-primary" onclick="window.location.href ='index.php'">Home</button>
      <button type="button" class="btn btn-primary" onclick="window.location.href ='add.php'">Add student</button>

      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Student</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form id="add-student-form" method="post">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
</div>
<div class="form-group">
<label for="gender">Gender:</label>
<select class="form-control" id="gender" name="gender" required>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
</div>
<div class="form-group">
<label for="mobile">Mobile:</label>
<input type="text" class="form-control" id="mobile" placeholder="Enter mobile number" name="mobile" required>
</div>
<button type="submit" class="btn btn-primary" id="submit-button">Add</button>
</form>
</div>
</div>
</div>
</div>
</div>

  </body>
</html>
<!-- PHP code for adding the student data -->
<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  if (empty($id)) {
    $sql = "INSERT INTO students (name, gender, email, mobile) VALUES ('$name', '$gender', '$email', '$mobile')";
  }
  else {
    $sql = "UPDATE students SET name='$name', gender='$gender', email='$email', mobile='$mobile' WHERE id=$id";
  }
  if (mysqli_query($conn, $sql)) {
    echo "success";
  }
  else {
    echo "failure";
  }
}
?>
<!-- PHP code for deleting the student data -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $sql = "DELETE FROM students WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
    echo "success";
  }
  else {
    echo "failure";
  }
}
?>

