<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Results</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
.container{max-width:900px;margin:auto;border:1px solid #ccc;padding:20px;border-radius:5px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
input, select{padding:5px;}
input[type="submit"]{margin-top:10px;padding:10px 20px;background:#2c3e50;color:#fff;border:none;cursor:pointer;}
input[type="submit"]:hover{background:#34495e;}
p{color:green;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2b4b8a;color:white;border-radius:4px;}
</style>
</head>
<body>

<div class="container">
<h2>Enter Student Results</h2>

<!-- Add Result Form -->
<form method="post">
<select name="student_id" required>
<option value="">Select Student</option>
<?php
$students = mysqli_query($conn,"SELECT * FROM students ORDER BY name ASC");
while($s=mysqli_fetch_assoc($students)){
    echo "<option value='{$s['id']}'>{$s['name']} ({$s['course']})</option>";
}
?>
</select>

<input type="number" name="marks" placeholder="Marks" required>
<input type="submit" name="add" value="Save Result">
</form>

<?php
// Insert Result
if(isset($_POST['add'])){
    $student_id = $_POST['student_id'];
    $marks = $_POST['marks'];

    mysqli_query($conn,"INSERT INTO results (student_id, marks) VALUES ('$student_id', '$marks')");
}

// Delete Result
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM results WHERE id='$id'");
}

// Search
$search = $_GET['search'] ?? '';
$res = mysqli_query($conn,"
    SELECT r.id, r.marks, s.name, s.course 
    FROM results r 
    JOIN students s ON r.student_id = s.id
    WHERE s.name LIKE '%$search%' 
    ORDER BY r.id DESC
");
?>

<!-- Search Form -->
<form method="get">
<input type="text" name="search" placeholder="Search by Student" value="<?= $search ?>">
<input type="submit" value="Search">
</form>

<h3>All Results</h3>
<table>
<tr><th>ID</th><th>Student Name</th><th>Course</th><th>Marks</th><th>Actions</th></tr>
<?php
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['course']}</td>
    <td>{$row['marks']}</td>
    <td>
        <a class='action-btn' href='results.php?delete={$row['id']}' onclick=\"return confirm('Delete result?')\">Delete</a>
    </td>
    </tr>";
}
?>
</table>

<h3>Student CGPA / Average Marks</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Course</th><th>Average Marks</th></tr>
<?php
$all_students = mysqli_query($conn,"SELECT * FROM students ORDER BY id ASC");
while($stu=mysqli_fetch_assoc($all_students)){
    $marks_res = mysqli_query($conn,"SELECT marks FROM results WHERE student_id='".$stu['id']."'");
    
    $total = 0; $count = 0;
    while($m=mysqli_fetch_assoc($marks_res)){
        $total += $m['marks'];
        $count++;
    }

    $avg = ($count > 0) ? round($total / $count, 2) : 0;

    echo "<tr>
    <td>{$stu['id']}</td>
    <td>{$stu['name']}</td>
    <td>{$stu['course']}</td>
    <td>$avg</td>
    </tr>";
}
?>
</table>

</div>
</body>
</html>
