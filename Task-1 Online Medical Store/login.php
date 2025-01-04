<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Bind the result
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start session and redirect
            session_start();
            $_SESSION['user_id'] = $id;
            header("Location: account.html");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>
