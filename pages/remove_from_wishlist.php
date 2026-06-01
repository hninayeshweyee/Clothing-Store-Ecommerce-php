<?php
session_start();
include("connect.php");

// Check if productID is provided and the user is logged in
if (isset($_SESSION['customerID']) && isset($_GET['productID'])) {
    $customerID = $_SESSION['customerID'];
    $productID = $_GET['productID'];

    // Check the database connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Prepare and execute the DELETE query to remove the product from the wishlist
    $stmt = $connect->prepare("DELETE FROM wishlist WHERE customerID = ? AND productID = ?");
    $stmt->bind_param("ii", $customerID, $productID);

    if ($stmt->execute()) {
        // Product removed successfully
        $_SESSION['message'] = "Product removed from wishlist.";
    } else {
        // Error removing product
        $_SESSION['message'] = "Error removing product from wishlist. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
    $connect->close();
} else {
    // Invalid request
    $_SESSION['message'] = "Invalid request. Please try again.";
}

// Redirect back to the wishlist page
header("Location: wishlist.php");
exit();
?>
