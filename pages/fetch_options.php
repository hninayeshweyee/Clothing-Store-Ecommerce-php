<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=wint_clothing_store", "root", "");

// Get the parameters from the GET request
$productID = isset($_GET['productID']) ? intval($_GET['productID']) : null;
$sizeID = isset($_GET['sizeID']) ? intval($_GET['sizeID']) : null;
$colorID = isset($_GET['colorID']) ? intval($_GET['colorID']) : null;

$response = [
    'sizes' => [],
    'colors' => []
];

if ($productID) {
    // Case 1: Fetch sizes and colors for the selected product
    if (!$sizeID && !$colorID) {
        // Fetch available sizes for the product
        $sizesQuery = $pdo->prepare("
            SELECT DISTINCT size.sizeID, size.sizeName
            FROM size
            JOIN product_variations pv ON size.sizeID = pv.sizeID
            WHERE pv.productID = :productID
        ");
        $sizesQuery->execute(['productID' => $productID]);

        // Fetch available colors for the product
        $colorsQuery = $pdo->prepare("
            SELECT DISTINCT color.colorID, color.colorName
            FROM color
            JOIN product_variations pv ON color.colorID = pv.colorID
            WHERE pv.productID = :productID
        ");
        $colorsQuery->execute(['productID' => $productID]);

        $response['sizes'] = $sizesQuery->fetchAll(PDO::FETCH_ASSOC);
        $response['colors'] = $colorsQuery->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($sizeID) {
        // Case 2: Fetch colors based on the selected size
        $colorsQuery = $pdo->prepare("
            SELECT DISTINCT color.colorID, color.colorName
            FROM color
            JOIN product_variations pv ON color.colorID = pv.colorID
            WHERE pv.productID = :productID AND pv.sizeID = :sizeID
        ");
        $colorsQuery->execute(['productID' => $productID, 'sizeID' => $sizeID]);

        $response['colors'] = $colorsQuery->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($colorID) {
        // Case 3: Fetch sizes based on the selected color
        $sizesQuery = $pdo->prepare("
            SELECT DISTINCT size.sizeID, size.sizeName
            FROM size
            JOIN product_variations pv ON size.sizeID = pv.sizeID
            WHERE pv.productID = :productID AND pv.colorID = :colorID
        ");
        $sizesQuery->execute(['productID' => $productID, 'colorID' => $colorID]);

        $response['sizes'] = $sizesQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}

echo json_encode($response);
?>
