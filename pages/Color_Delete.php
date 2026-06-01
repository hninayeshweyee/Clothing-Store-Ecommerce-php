<?php

include ("connect.php");
session_start();

$colorID = $_GET['colorID'];
$query = "SELECT COUNT(*) FROM product_variations WHERE colorID = $colorID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This color is being used in products and cannot be deleted.');</script>";
    echo "<script>window.location='Color_Entry.php';</script>";
}else {
$deleteColor="delete from color where colorID = $colorID";

$result = mysqli_query($connect,$deleteColor);
if($result){
	echo "<script>window.alert('Color data successfully deleted!')</script>";
	echo "<script>window.location='Color_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Color_Entry.php'</script>";
}
}

?>