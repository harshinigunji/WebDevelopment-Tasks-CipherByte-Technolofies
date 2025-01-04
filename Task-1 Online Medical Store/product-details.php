<?php
include 'db.php'; // Include your database connection

// Initialize variables
$name = $description = $price = $image_url = '';
$product_id = 0;

// Check if the product_id is passed via URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Get product ID from URL

    // Prepare SQL query to fetch product details
    $stmt = $conn->prepare("SELECT name, description, price, image_url FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->store_result();

    // Bind result variables
    $stmt->bind_result($name, $description, $price, $image_url);

    // Fetch product details
    if ($stmt->fetch()) {
        // Product details fetched successfully
    } else {
        // Product not found
        $name = $description = $price = $image_url = '';
    }

    // Close statement
    $stmt->close();
} else {
    // No product ID provided
    $name = $description = $price = $image_url = '';
}

// Close the database connection
$conn->close();
?>
