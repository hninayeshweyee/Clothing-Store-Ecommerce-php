<?php

include ("connect.php");
session_start();

$productID = $_GET['productID'];
$query = "SELECT COUNT(*) FROM product_variations WHERE productID = $productID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This product is being used in product details and cannot be deleted.');</script>";
    echo "<script>window.location='Product_Entry.php';</script>";
}else {
$deleteProduct="delete from product where productID = $productID";

$result = mysqli_query($connect,$deleteProduct);
if($result){
	echo "<script>window.alert('Product data successfully deleted!')</script>";
	echo "<script>window.location='Product_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Product_Entry.php'</script>";
}
}
?>