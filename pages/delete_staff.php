<?php

include ("connect.php");
session_start();


$staffID = $_GET['id'];
$deleteBrand="delete from staff where staffID = $staffID";

$result = mysqli_query($connect,$deleteBrand);
if($result){
	echo "<script>window.alert('Staff data successfully deleted!')</script>";
    echo "<script>window.location='sign-up.php';</script>";
}else{
	echo"<script>window.alert('Unsuccessfully Deleted!')</script>";
    echo "<script>window.location='sign-up.php';</script>";
}


?>