<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Management System</title>
<link rel="stylesheet" href="style.css">
<style>
body {font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(to right, #74ABE2, #5563DE); color: #fff; min-height: 100vh; display:flex; flex-direction:column;}
header {text-align:center; padding:40px 10px 20px;}
header h1 {font-size:42px; font-weight:bold; letter-spacing:1px;}
header p {font-size:18px; color:#e0e0e0;}
.menu {display:flex; justify-content:center; flex-wrap:wrap; gap:20px; margin-top:40px;}
.menu a {text-decoration:none; padding:20px 40px; background:white; color:#2b4b8a; font-size:18px; font-weight:bold; border-radius:10px; transition:0.3s; box-shadow:0 4px 8px rgba(0,0,0,0.2);}
.menu a:hover {background:#2b4b8a; color:white; transform:scale(1.05);}
footer {margin-top:auto; text-align:center; padding:15px; font-size:14px; color:#f0f0f0; background:rgba(0,0,0,0.1);}
.hero{text-align:center; margin-top:30px;}
.hero img{width:180px; border-radius:50%; box-shadow:0 4px 10px rgba(0,0,0,0.4); margin-bottom:20px;}
.hero h2{font-size:24px; color:#fdfdfd;}
</style>
</head>
<body>

<header>
<h1>🎓 Students Data Management System</h1>
<p>Manage Students, Teachers, Courses & More</p>
</header>

<section class="hero">
<img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Student Icon">
<h2>Welcome to the Official Admin Portal</h2>
</section>

<div class="menu">
<a href="students.php">📘 Manage Students</a>
<a href="teachers.php">👨‍🏫 Manage Teachers</a>
<a href="courses.php">📚 Manage Courses</a>
<a href="enroll.php">📝 Enroll Students</a>
<a href="attendance.php">📋 Attendance</a>
<a href="results.php">🖊️ Results</a>
<a href="retake.php">🔄 Retakes</a>
<a href="notices.php">📢 Notices</a>
<a href="class_routine.php">📅Class Routine</a>
<a href="exam_routine.php">📝 Exam Routine</a>
<a href="payment.php">💳Student Bill and Payment</a>
</div>

<footer>
© <?= date('Y') ?> Student Management System | Developed by Juie & Fatiha
</footer>

</body>
</html>
