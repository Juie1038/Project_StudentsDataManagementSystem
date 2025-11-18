<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Courses</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
input{padding:6px; margin:3px;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2b4b8a;color:white;border-radius:4px;}
.add-form{margin-bottom:20px;border:1px solid #ccc;padding:15px;border-radius:5px;}
</style>
</head>
<body>

<div class="add-form">
<h2>Add New Course</h2>
<form method="post">
<input type="text" name="course_name" placeholder="Course Name" required>
<input type="submit" name="add" value="Add Course">
</form>
</div>

<?php
if(isset($_POST['add'])){
    $course_name = $_POST['course_name'];
    mysqli_query($conn,"INSERT INTO courses (course_name) VALUES ('$course_name')");
}

// Delete Course
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM courses WHERE id='$id'");
}

// Search
$search = $_GET['search'] ?? '';
$res = mysqli_query($conn,"SELECT * FROM courses WHERE course_name LIKE '%$search%' ORDER BY id DESC");
?>

<form method="get">
<input type="text" name="search" placeholder="Search by Course Name" value="<?= $search ?>">
<input type="submit" value="Search">
</form>

<table>
<tr><th>ID</th><th>Course Name</th><th>Actions</th></tr>
<?php
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['course_name']}</td>
    <td>
        <a class='action-btn' href='courses.php?delete={$row['id']}' onclick=\"return confirm('Delete course?')\">Delete</a>
    </td>
    </tr>";
}
?>
</table>

</body>
</html>
