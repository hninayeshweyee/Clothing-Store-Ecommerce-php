<?php

include ("connect.php");
session_start();

$categoryID = $_GET['categoryID'];
$query = "SELECT COUNT(*) FROM product WHERE categoryID = $categoryID";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$productCount = $row[0];
if ($productCount > 0) {
    echo "<script>alert('This category is being used in products and cannot be deleted.');</script>";
    echo "<script>window.location='Category_Entry.php';</script>";
}else {
$deleteCategory="delete from category where categoryID = $categoryID";

$result = mysqli_query($connect,$deleteCategory);
if($result){
	echo "<script>window.alert('Category data successfully deleted!')</script>";
	echo "<script>window.location='Category_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Category_Entry.php'</script>";
}
}

?>