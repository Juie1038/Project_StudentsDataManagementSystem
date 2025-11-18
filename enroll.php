<?php
include 'db_connect.php';

// Handle form submission (Add Student)
if(isset($_POST['enroll'])){
    $name = $_POST['student_name'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, course, year, email) VALUES ('$name','$course','$year','$email')";
    if(mysqli_query($conn, $sql)){
        $message = "Student Enrolled Successfully!";
    } else {
        $error = "Error: ".mysqli_error($conn);
    }
}

// Handle delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM students WHERE id='$id'");
    header("Location: enroll.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Enroll Students</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
.container{max-width:900px;margin:auto;border:1px solid #ccc;padding:20px;border-radius:5px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th, td{border:1px solid #ccc;padding:8px;text-align:center;}
select,input{padding:6px;margin:3px;}
input[type="submit"]{padding:6px 12px;background:#2c3e50;color:white;border:none;cursor:pointer;}
input[type="submit"]:hover{background:#34495e;}
.message{color:green;}
.error{color:red;}
form{margin-bottom:20px;}
</style>
</head>
<body>

<div class="container">
<h2>Enroll New Student</h2>

<?php
if(isset($message)) echo "<p class='message'>$message</p>";
if(isset($error)) echo "<p class='error'>$error</p>";
?>

<!-- Add Student Form -->
<form action="enroll.php" method="post">
    <label for="student_name">Student Name:</label>
    <input type="text" name="student_name" required>

    <label for="course">Course/Class:</label>
    <select name="course" required>
        <option value="">Select Course</option>
        <?php
        $course_res = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name ASC");
        while($course_row = mysqli_fetch_assoc($course_res)){
            $selected = (isset($_POST['course']) && $_POST['course']==$course_row['course_name']) ? 'selected' : '';
            echo "<option value='{$course_row['course_name']}' $selected>{$course_row['course_name']}</option>";
        }
        ?>
    </select>

    <label for="year">Year:</label>
    <select name="year" required>
        <option value="">Select Year</option>
        <option value="2023" <?php if(isset($_POST['year']) && $_POST['year']=='2023') echo 'selected'; ?>>2023</option>
        <option value="2024" <?php if(isset($_POST['year']) && $_POST['year']=='2024') echo 'selected'; ?>>2024</option>
        <option value="2025" <?php if(isset($_POST['year']) && $_POST['year']=='2025') echo 'selected'; ?>>2025</option>
    </select>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>">

    <input type="submit" name="enroll" value="Save Student">
</form>

<!-- Search Form -->
<h3>Existing Students</h3>
<form method="get">
<input type="text" name="search" placeholder="Search by Name, Course, or Year" value="<?php echo $_GET['search'] ?? ''; ?>">
<input type="submit" value="Search">
</form>

<!-- Students Table -->
<table>
<tr><th>ID</th><th>Name</th><th>Course</th><th>Year</th><th>Email</th><th>Action</th></tr>

<?php
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM students WHERE name LIKE '%$search%' OR course LIKE '%$search%' OR year LIKE '%$search%' ORDER BY id DESC";
$res = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['course']}</td>
    <td>{$row['year']}</td>
    <td>{$row['email']}</td>
    <td><a href='enroll.php?delete={$row['id']}' onclick=\"return confirm('Delete student?')\">Delete</a></td>
    </tr>";
}
?>
</table>

</div>
</body>
</html>
