<?php

include ("connect.php");
session_start();

$supplierID = $_GET['supplierID'];

$deleteBrand="delete from supplier where supplierID = $supplierID";

$result = mysqli_query($connect,$deleteBrand);
if($result){
	echo "<script>window.alert('Supplier data successfully deleted!')</script>";
	echo "<script>window.location='Supplier_Entry.php'</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
	echo "<script>window.location='Supplier_Entry.php'</script>";
}

?>