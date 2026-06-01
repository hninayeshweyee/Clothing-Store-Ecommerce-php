<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

// Display each item in the cart
$totalPrice = 0; // Variable to calculate total price
foreach ($_SESSION['cart'] as $item) {
    echo "Product: " . $item['productName'] . "<br>";
    echo "Size: " . $item['size'] . "<br>";
    echo "Color: " . $item['color'] . "<br>";
    echo "Price: $" . number_format($item['productPrice'], 2) . "<br>";
    echo "Quantity: " . $item['quantity'] . "<br><br>";

    // Add product price * quantity to total
    $totalPrice += $item['productPrice'] * $item['quantity'];
}

// Display the total number of items in the cart
$cartCount = count($_SESSION['cart']);
echo "Items in cart: <span>$cartCount</span><br>";

// Display total price of items in the cart
echo "Total Price: $" . number_format($totalPrice, 2);
?>
