<?php
session_start();
include("connect.php");

if (isset($_POST['btnAdd'])) {
    // Get productID and other form data from the URL and POST request
    $productID = $_GET['productID'];
    $quantity = $_POST['quantity']; // Get quantity from the form
    $size = $_POST['size']; // Get selected size
    $color = $_POST['color']; // Get selected color

    // Query product details based on productID, size, and color
    $query = "
    SELECT p.productName, pv.productPrice
    FROM product p
    JOIN product_variations pv ON p.productID = pv.productID
    WHERE p.productID = '$productID' AND pv.sizeID = '$size' AND pv.colorID = '$color'
    ";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $productName = $product['productName'];
        $productPrice = $product['productPrice'];

        // Initialize the cart session if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['productID'] == $productID && $item['size'] == $size && $item['color'] == $color) {
                // Update quantity if the product is already in the cart
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If not found, add new product to the cart
        if (!$found) {
            $_SESSION['cart'][] = [
                'productID' => $productID,
                'productName' => $productName,
                'productPrice' => $productPrice,
                'quantity' => $quantity,
                'size' => $size,
                'color' => $color,
            ];
        }

        // Redirect back to the product page after adding to cart
        header('Location: ' . $_SERVER['PHP_SELF'] . '?productID=' . $productID);
        exit();
    } else {
        // Handle case where product details are not found
        echo "Product not found or incorrect variation.";
    }
}
?>
