<?php 
include("connect.php");
// Start the session

// Function to find product index by unique key
function findProductIndex($uniqueKey) {
    if (isset($_SESSION['PurchaseFunctions'])) {
        foreach ($_SESSION['PurchaseFunctions'] as $index => $item) {
            if ($item['uniqueKey'] === $uniqueKey) {
                return $index;  // Found, return index
            }
        }
    }
    return -1;  // Not found
}

// Function to add product to cart
function addToCart($productID, $sizeID, $colorID, $purchasePrice, $purchaseQty) {
    $conn = mysqli_connect('localhost', 'root', '', 'wint_clothing_store');

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $query = "
SELECT pv.*, p.productName 
FROM product_variations pv
JOIN product p ON pv.productID = p.productID
WHERE pv.productID = '$productID' AND pv.sizeID = '$sizeID' AND pv.colorID = '$colorID';
";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) < 1) {
        echo "<p>Product variation not found.</p>";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    $productName = $row['productName'];  // Assuming productName exists in the table
    $image = $row['image_1'];

    if ($purchaseQty < 1) {
        echo "<script>alert('Purchase quantity must be at least 1');</script>";
        echo "<script>window.location='Purchase_Order.php';</script>";
        exit();
    }

    // Create a unique key for the product
    $uniqueKey = "$productID-$sizeID-$colorID";

    // Initialize session array if not set
    if (!isset($_SESSION['PurchaseFunctions'])) {
        $_SESSION['PurchaseFunctions'] = array();
    }

    // Check if product already exists
    $productIndex = findProductIndex($uniqueKey);

    if ($productIndex === -1) {
        // Add a new product entry
        $_SESSION['PurchaseFunctions'][] = array(
            'uniqueKey'     => $uniqueKey,
            'productID'     => $productID,
            'productName'   => $productName,
            'purchasePrice' => $purchasePrice,
            'quantity'      => $purchaseQty,
            'image_1'       => $image,
            'sizeID'        => $sizeID,
            'colorID'       => $colorID
        );
    } else {
        // Update quantity of existing product
        $_SESSION['PurchaseFunctions'][$productIndex]['quantity'] += $purchaseQty;
    }

    mysqli_close($conn); // Close database connection

    echo "<script>window.location='Purchase_Order.php';</script>";
}



function RemoveProduct($ProductID)
{
	$Index=IndexOf($ProductID);
	unset($_SESSION['PurchaseFunctions'][$Index]);
	$_SESSION['PurchaseFunctions']=array_values($_SESSION['PurchaseFunctions']);

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function ClearAll()
{	
	unset($_SESSION['PurchaseFunctions']);
	echo "<script>window.location='Purchase_Order.php'</script>";
}

// function calculateTotalAmount()
// {
//     $totalAmount = 0;

//     if (isset($_SESSION['PurchaseFunctions']) && is_array($_SESSION['PurchaseFunctions'])) 
//     {
//         $size = count($_SESSION['PurchaseFunctions']);

//         for ($i = 0; $i < $size; $i++) {
//             $purchasePrice = $_SESSION['PurchaseFunctions'][$i]['Purchase_Amount'];
//             $purchaseQty = $_SESSION['PurchaseFunctions'][$i]['Purchase_Quantity'];
//             $totalAmount += ($purchasePrice * $purchaseQty);
//         }
//     }
    
//     return $totalAmount;
// }

function CalculateTotalAmount()
{
	$TotalAmount=0;

	if (isset($_SESSION['PurchaseFunctions'])) 
	{
		$size=count($_SESSION['PurchaseFunctions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$PurchasePrice=$_SESSION['PurchaseFunctions'][$i]['purchasePrice'];
		$PurchaseQty=$_SESSION['PurchaseFunctions'][$i]['quantity'];
		$TotalAmount+=($PurchasePrice * $PurchaseQty);
	}
	return $TotalAmount;

	}

	else 
	{
		echo "<script>window.alert('Error in Functions')</script>";

	}



}

	


function CalculateTotalQuantity()
{
	$TotalQuantity=0;
	$size=count($_SESSION['PurchaseFunctions']);

	for ($i=0; $i <$size ; $i++) 
	{ 
		$Purchase_Quantity=$_SESSION['PurchaseFunctions'][$i]['quantity'];
		$TotalQuantity+=$Purchase_Quantity;
	}
	return $TotalQuantity;
}

function CalculateVAT()
{
	$VAT=0;
	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function IndexOf($ProductID)
{
	if (!isset($_SESSION['PurchaseFunctions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['PurchaseFunctions']);

	if ($size < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$size;$i++) 
	{ 
		if($ProductID == $_SESSION['PurchaseFunctions'][$i]['productID']) 
		{
			return $i;
		}
	}
	return -1;
}

?>