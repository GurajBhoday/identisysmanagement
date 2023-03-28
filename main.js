// Define the student data array
let students = [];

// Get the student table element
const studentTable = document.getElementById("student-table");

// Function to render the student table
function renderStudentTable() {
  // Clear the table body
  studentTable.getElementsByTagName("tbody")[0].innerHTML = "";

  // Loop through the students array and add rows to the table
  for (let i = 0; i < students.length; i++) {
    const student = students[i];

    // Create a new row element
    const row = document.createElement("tr");

    // Add cells to the row
    const idCell = document.createElement("td");
    idCell.textContent = student.id;
    row.appendChild(idCell);

    const nameCell = document.createElement("td");
    nameCell.textContent = student.name;
    row.appendChild(nameCell);

    const genderCell = document.createElement("td");
    genderCell.textContent = student.gender;
    row.appendChild(genderCell);

    const emailCell = document.createElement("td");
    emailCell.textContent = student.email;
    row.appendChild(emailCell);

    const mobileCell = document.createElement("td");
    mobileCell.textContent = student.mobile;
    row.appendChild(mobileCell);

    const actionsCell = document.createElement("td");
    const editButton = document.createElement("button");
    editButton.textContent = "Edit";
    editButton.addEventListener("click", () => editStudent(i));
    actionsCell.appendChild(editButton);

    const deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.addEventListener("click", () => deleteStudent(i));
    actionsCell.appendChild(deleteButton);

    row.appendChild(actionsCell);

    // Add the row to the table body
    studentTable.getElementsByTagName("tbody")[0].appendChild(row);
  }
}

// Function to add a new student
function addStudent(event) {
  // Prevent the form from submitting
  event.preventDefault();

  // Get the form data
  const formData = new FormData(event.target);
  const id = formData.get("id");
  const name = formData.get("name");
  const gender = formData.get("gender");
  const email = formData.get("email");
  const mobile = formData.get("mobile");

  // Create a new student object
  const student = {
    id: id,
    name: name,
    gender: gender,
    email: email,
    mobile: mobile
  };

  // Add the student object to the students array
  students.push(student);

  // Render the student table
  renderStudentTable();

  // Reset the form
  event.target.reset();
}

// Function to edit a student
function editStudent(index) {
  // Get the student object
  const student = students[index];

  // Fill the form fields with the student data
  document.getElementById("id").value = student.id;
  document.getElementById("name").value = student.name;
  document.getElementById("gender").value = student.gender;
  document.getElementById("email").value = student.email;
  document.getElementById("mobile").value = student.mobile;

  // Remove the old student object from the students array
  students.splice(index, 1);

  // Render the student table
  renderStudentTable();
}

// Function to delete a student
function deleteStudent(index) {
  // Remove the student object from the students array
  students.splice(index, 1);

  // Render the student table
  renderStudentTable();
}

// Add event listeners
document.getElementById("add-student-form").addEventListener("submit", addStudent);

// Render
