<?php
include 'db.php'; // Include your database connection

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>
