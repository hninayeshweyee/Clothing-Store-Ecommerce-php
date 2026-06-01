<?php

include ("connect.php");
session_start();

$brandID = $_GET['brandID'];

$query = "SELECT COUNT(*) FROM product WHERE brandID = $brandID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This brand is being used in products and cannot be deleted.');</script>";
    echo "<script>window.location='Brand_Entry.php';</script>";
}else {

$deleteBrand="delete from brand where brandID = $brandID";

$result = mysqli_query($connect,$deleteBrand);
if($result){
	echo "<script>window.alert('Brand data successfully deleted!')</script>";
	echo "<script>window.location='Brand_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Brand_Entry.php'</script>";
}
}

?>