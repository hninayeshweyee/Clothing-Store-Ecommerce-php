<?php
session_start();
include('connect.php');

// Check if the customer is logged in
if (!isset($_SESSION['customerID'])) {
    echo "<script>window.alert('Please Login.')</script>";
    echo "<script>window.location='user-sign-in.php'</script>";
    exit();
}

$orderID = isset($_SESSION['orderID']) ? $_SESSION['orderID'] : null;
$customerID = $_SESSION['customerID'];

if (!$orderID) {
    echo "<script>window.alert('No order information found.')</script>";
    echo "<script>window.location='index.php'</script>";
    exit();
}

// Fetch order details
try {
    $pdo = new PDO("mysql:host=localhost;dbname=wint_clothing_store", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get order info
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE orderID = :orderID AND customerID = :customerID");
    $stmt->execute(['orderID' => $orderID, 'customerID' => $customerID]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get order detail items
    $stmt2 = $pdo->prepare("SELECT od.*, p.productName, pv.sizeID, pv.colorID
                            FROM order_detail od 
                            JOIN product_variations pv ON od.variationID = pv.variationID
                            JOIN product p ON pv.productID = p.productID
                            WHERE od.orderID = :orderID");
    $stmt2->execute(['orderID' => $orderID]);
    $orderItems = $stmt2->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="order-success-container">
        <h1>Thank You for Your Order!</h1>
        <p>Your order has been successfully placed. Below are the details of your order:</p>

        <h2>Order #<?php echo $order['orderID']; ?></h2>
        <p><strong>Order Date:</strong> <?php echo $order['orderDate']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo number_format($order['totalAmount'], 2); ?></p>
        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>

        <h3>Shipping Information</h3>
        <p><strong>Location:</strong> <?php echo $order['location']; ?></p>
        <p><strong>Phone:</strong> <?php echo $order['phoneNumber']; ?></p>

        <h3>Order Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['productName']); ?></td>
                        <td><?php echo htmlspecialchars($item['sizeID']); ?></td>
                        <td><?php echo htmlspecialchars($item['colorID']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['purchasePrice'], 2); ?></td>
                        <td>$<?php echo number_format($item['purchasePrice'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Thank you for shopping with us!</h3>
        <p>If you have any questions, feel free to <a href="contact-us.php">contact us</a>.</p>

        <a href="shop.php">Continue Shopping</a>
    </div>

</body>
</html>

