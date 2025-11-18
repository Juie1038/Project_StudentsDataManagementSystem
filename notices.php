<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Notices</title>
<link rel="stylesheet" href="style.css">
<style>
body{font-family:Arial;padding:20px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
textarea{width:100%;padding:5px;}
input[type="submit"]{padding:6px 12px;margin-top:5px;background:#2c3e50;color:white;border:none;}
.action-btn{padding:4px 8px;margin:2px;text-decoration:none;background:#2c3e50;color:white;border-radius:4px;}
.add-form{margin-bottom:20px;border:1px solid #ccc;padding:15px;border-radius:5px;}
</style>
</head>
<body>

<div class="add-form">
<h2>Add Notice</h2>
<form method="post">
<textarea name="notice" placeholder="Enter notice..." required></textarea>
<input type="submit" name="add" value="Add Notice">
</form>
</div>

<?php
if(isset($_POST['add'])){
    $notice = $_POST['notice'];
    mysqli_query($conn,"INSERT INTO notices (notice) VALUES ('$notice')");
}

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM notices WHERE id='$id'");
}

// Fetch notices
$res = mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
?>

<table>
<tr><th>ID</th><th>Notice</th><th>Actions</th></tr>
<?php
while($row=mysqli_fetch_assoc($res)){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['notice']}</td>
    <td>
        <a class='action-btn' href='notices.php?delete={$row['id']}' onclick=\"return confirm('Delete notice?')\">Delete</a>
    </td>
    </tr>";
}
?>
</table>

</body>
</html>
