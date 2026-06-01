<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (isset($_SESSION['customerID']) && !empty($_SESSION['customerID'])) {
    // Ensure required data is present and valid
    if (isset($_POST['productID']) && !empty($_POST['productID'])) {
        $productID = $_POST['productID'];
        $customerID = $_SESSION['customerID'];

        // Check connection
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }

        // Check if the item is already in the wishlist
        $stmt = $connect->prepare("SELECT * FROM wishlist WHERE customerID = ? AND productID = ?");
        $stmt->bind_param("ii", $customerID, $productID); // Correct binding for two integers
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the item is already in the wishlist
            $message = "This item is already in your wishlist.";
        } else {
            // Insert the item into the wishlist
            $insertStmt = $connect->prepare("INSERT INTO wishlist (customerID, productID) VALUES (?, ?)");
            $insertStmt->bind_param("ii", $customerID, $productID); // Correct binding for two integers

            if ($insertStmt->execute()) {
                $message = "Product added to wishlist successfully.";
            } else {
                // Log the error for debugging
                error_log("Error adding to wishlist: " . $insertStmt->error);
                $message = "Error adding to wishlist. Please try again later.";
            }

            $insertStmt->close();
        }

        $stmt->close();
        $connect->close();

        // JavaScript alert for success/failure
        echo "<script type='text/javascript'>alert('$message');</script>";

        // Redirect back to the previous page or a default page if HTTP_REFERER is not set
        $redirectURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default-page.php';
        echo "<script type='text/javascript'>window.location.href = '$redirectURL';</script>";
        exit;
    } else {
        echo "Error: Missing required fields.";
    }
} else {
    echo "Error: Please login first.";
}
?>
