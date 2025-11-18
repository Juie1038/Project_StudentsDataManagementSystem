<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Retake Exams</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
input, select{padding:6px;margin:3px;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2c3e50;color:white;border-radius:4px;}
.add-form{margin-bottom:20px;border:1px solid #ccc;padding:15px;border-radius:5px;}
</style>
<script>
function setCourse(){
    var students = <?php
        $arr = [];
        $res = mysqli_query($conn,"SELECT id, course FROM students");
        while($row=mysqli_fetch_assoc($res)) $arr[$row['id']] = $row['course'];
        echo json_encode($arr);
    ?>;
    var studentSelect = document.getElementById('student_id');
    var courseInput = document.getElementById('course');
    var selectedId = studentSelect.value;
    courseInput.value = students[selectedId] || '';
}
</script>
</head>
<body>

<div class="add-form">
<h2>Retake Exam Registration</h2>
<form method="post">
    <label>Select Student:</label>
    <select name="student_id" id="student_id" onchange="setCourse()" required>
        <option value="">Select Student</option>
        <?php
        $students = mysqli_query($conn,"SELECT * FROM students ORDER BY name ASC");
        while($s=mysqli_fetch_assoc($students)){
            echo "<option value='{$s['id']}'>{$s['name']}</option>";
        }
        ?>
    </select>

    <label>Course:</label>
    <input type="text" id="course" name="course" placeholder="Enter course" required>

    <input type="submit" name="add" value="Register Retake">
</form>
</div>

<?php
if(isset($_POST['add'])){
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];

    // Clean insert statement
    $student_id = mysqli_real_escape_string($conn,$student_id);
    $course = mysqli_real_escape_string($conn,$course);

    mysqli_query($conn,"INSERT INTO retakes (student_id, course) VALUES ('$student_id','$course')");
}

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM retakes WHERE id='$id'");
}

// Search
$search = $_GET['search'] ?? '';
$res = mysqli_query($conn,"SELECT r.id, s.name, r.course 
FROM retakes r
JOIN students s ON r.student_id=s.id
WHERE s.name LIKE '%$search%' OR r.course LIKE '%$search%' 
ORDER BY r.id DESC");
?>

<form method="get">
<input type="text" name="search" placeholder="Search by Student or Course" value="<?= $search ?>">
<input type="submit" value="Search">
</form>

<table>
<tr><th>ID</th><th>Student Name</th><th>Course</th><th>Actions</th></tr>
<?php
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['course']}</td>
    <td>
        <a class='action-btn' href='retake.php?delete={$row['id']}' onclick=\"return confirm('Delete retake?')\">Delete</a>
    </td>
    </tr>";
}
?>
</table>

</body>
</html>
