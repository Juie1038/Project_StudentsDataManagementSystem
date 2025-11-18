<?php
include('db_connect.php');

// ADD NEW ROUTINE
if(isset($_POST['add'])) {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $course = $_POST['course'];

    $insert = mysqli_query($conn, "INSERT INTO class_routine(day, time, Course) VALUES('$day','$time','$course')");
    if($insert){
        header("Location: class_routine.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// DELETE ROUTINE
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM class_routine WHERE id='$id'");
    header("Location: class_routine.php");
    exit;
}

// SEARCH ROUTINE
$search_query = "";
if(isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $search_query = "WHERE day LIKE '%$keyword%' OR time LIKE '%$keyword%' OR Course LIKE '%$keyword%'";
}

// FETCH ROUTINES
$result = mysqli_query($conn, "SELECT * FROM class_routine $search_query ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Routine</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: center; }
        th { background: #f2f2f2; }
        form { width: 400px; margin: 20px auto; }
        input, select { padding: 6px; margin: 6px 0; width: 100%; }
        input[type="submit"] { cursor: pointer; background: #4CAF50; color: white; border: none; }
        a.delete { color: red; text-decoration: none; }
        .search { width: 300px; margin: 10px auto; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Class Routine</h2>

<!-- Add Routine Form -->
<form method="POST" action="">
    <label>Day:</label>
    <select name="day" required>
        <option value="">Select Day</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
    </select>

    <label>Time:</label>
    <input type="text" name="time" placeholder="e.g., 10:00 AM - 11:00 AM" required>

    <label>Course:</label>
    <input type="text" name="course" placeholder="Course Name" required>

    <input type="submit" name="add" value="Add Routine">
</form>

<!-- Search Form -->
<form method="POST" class="search" action="">
    <input type="text" name="keyword" placeholder="Search by Day, Time, Course" required>
    <input type="submit" name="search" value="Search">
</form>

<!-- Routine Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Day</th>
        <th>Time</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo $row['time']; ?></td>
            <td><?php echo $row['Course']; ?></td>
            <td>
                <a href="class_routine.php?delete=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
