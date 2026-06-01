<?php

include ("connect.php");
session_start();

$sizeID = $_GET['sizeID'];
$query = "SELECT COUNT(*) FROM product_variations WHERE sizeID = $sizeID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This size is being used in product details and cannot be deleted.');</script>";
    echo "<script>window.location='Size_Entry.php';</script>";
}else {
$deleteSize="delete from size where sizeID = $sizeID";

$result = mysqli_query($connect,$deleteSize);
if($result){
	echo "<script>window.alert('Size data successfully deleted!')</script>";
	echo "<script>window.location='Size_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Size_Entry.php'</script>";
}
}

?>