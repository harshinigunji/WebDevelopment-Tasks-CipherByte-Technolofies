<?php
session_start();
include 'db.php'; // Include your database connection file

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Basic validation
if (empty($username) || empty($password)) {
    echo 'Username and password cannot be empty';
    exit();
}

// Prepare and execute the SQL statement
$sql = "SELECT * FROM admins WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user with the given username exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['admin_id'] = $user['id'];

        // Redirect to the admin dashboard
        header('Location: admin.html');
        exit();
    } else {
        echo 'Invalid password';
    }
} else {
    echo 'Invalid username';
}

$stmt->close();
$conn->close();
?>
