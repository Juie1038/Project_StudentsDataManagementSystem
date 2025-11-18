<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Mark Attendance</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
.container{max-width:900px;margin:auto;border:1px solid #ccc;padding:20px;border-radius:5px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
select{padding:5px;}
input[type="submit"]{margin-top:10px;padding:10px 20px;background:#2c3e50;color:#fff;border:none;cursor:pointer;}
input[type="submit"]:hover{background:#34495e;}
p{color:green;}
</style>
</head>
<body>

<div class="container">
<h2>Mark Attendance</h2>

<form action="" method="post">
<table>
<tr><th>ID</th><th>Name</th><th>Class</th><th>Status</th></tr>
<?php
$res = mysqli_query($conn,"SELECT * FROM students ORDER BY id ASC");
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['course']}</td>
    <td>
    <select name='status[{$row['id']}]'>
        <option value='Present'>Present</option>
        <option value='Absent'>Absent</option>
    </select>
    </td>
    </tr>";
}
?>
</table>
<input type="submit" name="mark" value="Save Attendance">
</form>

<?php
if(isset($_POST['mark'])){
    $date = date("Y-m-d");
    foreach($_POST['status'] as $student_id => $status){
        $check = mysqli_query($conn,"SELECT * FROM attendance WHERE student_id='$student_id' AND date='$date'");
        if(mysqli_num_rows($check)==0){
            mysqli_query($conn,"INSERT INTO attendance (student_id,status,date) VALUES ('$student_id','$status','$date')");
        }else{
            mysqli_query($conn,"UPDATE attendance SET status='$status' WHERE student_id='$student_id' AND date='$date'");
        }
    }
    echo "<p>Attendance saved successfully!</p>";
}
?>

<h3>Attendance Percentage</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Class</th><th>% Attendance</th></tr>
<?php
$res2 = mysqli_query($conn,"SELECT * FROM students");
while($student = mysqli_fetch_assoc($res2)){
    $total = mysqli_query($conn,"SELECT * FROM attendance WHERE student_id='".$student['id']."'");
    $total_count = mysqli_num_rows($total);
    $present = mysqli_query($conn,"SELECT * FROM attendance WHERE student_id='".$student['id']."' AND status='Present'");
    $present_count = mysqli_num_rows($present);
    $percent = ($total_count>0)? round(($present_count/$total_count)*100,2) : 0;
    echo "<tr><td>{$student['id']}</td><td>{$student['name']}</td><td>{$student['course']}</td><td>{$percent}%</td></tr>";
}
?>
</table>

</div>

</body>
</html>
