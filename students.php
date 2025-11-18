<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Students</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
input, select{padding:6px; margin:3px;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2b4b8a;color:white;border-radius:4px;}
.add-form{margin-bottom:20px;border:1px solid #ccc;padding:15px;border-radius:5px;}
</style>
</head>
<body>

<div class="add-form">
<h2>Add Student</h2>
<form method="post">
<input type="text" name="name" placeholder="Student Name" required>
<input type="text" name="course" placeholder="Class / Course" required>
<input type="submit" name="add" value="Add Student">
</form>
</div>

<?php
// Add Student
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $course = $_POST['course'];

    mysqli_query($conn,"INSERT INTO students (name, course) VALUES ('$name','$course')");
}

// Delete Student
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM students WHERE id='$id'");
}

// Search
$search = $_GET['search'] ?? '';
$res = mysqli_query($conn,"SELECT * FROM students WHERE name LIKE '%$search%' OR course LIKE '%$search%' ORDER BY id DESC");
?>

<form method="get">
<input type="text" name="search" placeholder="Search by Name or Class" value="<?= $search ?>">
<input type="submit" value="Search">
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Class</th>
    <th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($res)){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['course']}</td>
        <td>
            <a class='action-btn' href='students.php?delete={$row['id']}' onclick=\"return confirm('Delete student?')\">Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
