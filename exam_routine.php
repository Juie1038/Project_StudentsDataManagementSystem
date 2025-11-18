<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Exam Routine</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
input, select{padding:5px;margin:3px;}
input[type="submit"]{padding:6px 12px;margin-top:5px;background:#2c3e50;color:white;border:none;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2c3e50;color:white;border-radius:4px;}
.add-form{margin-bottom:20px;border:1px solid #ccc;padding:15px;border-radius:5px;}
</style>
</head>
<body>

<div class="add-form">
<h2>Add Exam Routine</h2>
<form method="post">
<input type="text" name="subject" placeholder="Subject" required>
<input type="text" name="date" placeholder="Date (YYYY-MM-DD)" required>
<input type="text" name="time" placeholder="Time" required>
<input type="submit" name="add" value="Add Routine">
</form>
</div>

<?php
if(isset($_POST['add'])){
    $subject = $_POST['subject'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    mysqli_query($conn,"INSERT INTO exam_routine (subject,date,time) VALUES ('$subject','$date','$time')");
}

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM exam_routine WHERE id='$id'");
}

// Fetch
$res = mysqli_query($conn,"SELECT * FROM exam_routine ORDER BY date ASC,time ASC");
?>

<table>
<tr><th>ID</th><th>Subject</th><th>Date</th><th>Time</th><th>Actions</th></tr>
<?php
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['subject']}</td>
    <td>{$row['date']}</td>
    <td>{$row['time']}</td>
    <td>
        <a class='action-btn' href='exam_routine.php?delete={$row['id']}' onclick=\"return confirm('Delete?')\">Delete</a>
    </td>
    </tr>";
}
?>
</table>

</body>
</html>
