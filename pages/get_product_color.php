<?php
session_start();
include("connect.php");

if (isset($_POST['colorID']) && isset($_POST['productID'])) {
    $colorID = $_POST['colorID'];
    $productID = $_POST['productID'];

    // Query to get color-specific product images
    $colorQuery = "
        SELECT pv.image_1, pv.image_2
        FROM product_variations pv
        WHERE pv.productID = '$productID' AND pv.colorID = '$colorID'
    ";
    $colorResult = mysqli_query($connect, $colorQuery);

    $images = [];
    if ($colorResult && mysqli_num_rows($colorResult) > 0) {
        $colorData = mysqli_fetch_assoc($colorResult);
        $images['image1'] = $colorData['image_1'];
        $images['image2'] = $colorData['image_2'];
    }

    // Query to get sizes based on the selected color
    $sizeQuery = "
        SELECT s.sizeID, s.sizeName 
        FROM product_variations pv
        JOIN size s ON pv.sizeID = s.sizeID
        WHERE pv.productID = '$productID' AND pv.colorID = '$colorID'
        GROUP BY s.sizeID
    ";
    $sizeResult = mysqli_query($connect, $sizeQuery);

    $sizesHtml = '';
    if ($sizeResult && mysqli_num_rows($sizeResult) > 0) {
        while ($size = mysqli_fetch_assoc($sizeResult)) {
            $sizesHtml .= "
            
        <div class='product__details__option>
            <div class='product__details__option__size'>
                <label for='size-{$size['sizeID']}'>{$size['sizeName']}
                    <input type='radio' name='size' id='size-{$size['sizeID']}' value='{$size['sizeID']}'>
                </label>
            </div>
            </div>
               
                
            ";
        }
    } else {
        $sizesHtml = "<p>No sizes available for this color.</p>";
    }

    // Send the response back to the JavaScript as JSON
    echo json_encode([
        'success' => true,
        'image1' => $images['image1'] ?? '',
        'image2' => $images['image2'] ?? '',
        'sizesHtml' => $sizesHtml
    ]);
}
?>

