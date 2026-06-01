<?php

include ("connect.php");
session_start();

$variationID = $_GET['variationID'];

$query = "SELECT COUNT(*) FROM purchase_order_detail WHERE variationID = $variationID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This product is being used in purchase product details and cannot be deleted.');</script>";
    echo "<script>window.location='Product_Detail.php';</script>";
}else {

$deleteBrand="delete from product_variations where variationID = $variationID";

$result = mysqli_query($connect,$deleteBrand);
if($result){
	echo "<script>window.alert('Brand data successfully deleted!')</script>";
    echo "<script>window.location='Product_Detail.php';</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
    echo "<script>window.location='Product_Detail.php';</script>";
}
}

?>