<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products
$sql = "SELECT id, name, description, price, image FROM productslist";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if products exist and display them
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="product">
            <img src="' . $row["image"] . '" alt="' . $row["name"] . '">
            <h3>' . $row["name"] . '</h3>
            <p>' . $row["description"] . '</p>
            <p>Price: $' . $row["price"] . '</p>
            <a href="product_detail.php?id=' . $row["id"] . '" class="cta-button">View Details</a>
        </div>';
    }
} else {
    echo '<p>No products available.</p>';
}

// Close connection
$conn->close();
?>
