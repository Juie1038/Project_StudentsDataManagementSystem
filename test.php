<?php
include 'db_connect.php';

$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "<h2>✅ Connected! Tables found:</h2><ul>";
  while ($row = mysqli_fetch_array($result)) {
    echo "<li>" . $row[0] . "</li>";
  }
  echo "</ul>";
} else {
  echo "❌ Connection or Query Error: " . mysqli_error($conn);
}
?>

