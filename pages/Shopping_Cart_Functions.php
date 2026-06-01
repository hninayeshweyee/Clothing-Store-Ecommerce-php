<?php  

// Shopping_Cart_Functions.php

function AddShoppingCart($productID, $qty, $sizeID, $colorID) {
    include('connect.php');


	if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$Index=IndexOf($Product_ID);
		
		if($Index == -1) 
		{
			$size=count($_SESSION['ShoppingCartFunctions']);

			$_SESSION['ShoppingCartFunctions'][$size]['productID']=$productID;
			$_SESSION['ShoppingCartFunctions'][$size]['productName']=$productName;
			$_SESSION['ShoppingCartFunctions'][$size]['purchasePrice']=$purchasePrice;
			$_SESSION['ShoppingCartFunctions'][$size]['quantity']=$quantity;

		}
		else
		{
			$_SESSION['ShoppingCartFunctions'][$Index]['BuyQty']+=$BuyQty;
		}
	}
	else
	{
		$_SESSION['ShoppingCartFunctions']=array(); //Create Session Array

		$_SESSION['ShoppingCartFunctions'][0]['Product_ID']=$Product_ID;
		$_SESSION['ShoppingCartFunctions'][0]['Product_Name']=$Product_Name;
		$_SESSION['ShoppingCartFunctions'][0]['Product_Amount']=$Product_Amount;
		$_SESSION['ShoppingCartFunctions'][0]['BuyQty']=$BuyQty;
		$_SESSION['ShoppingCartFunctions'][0]['Product_Image_1']=$Product_Image_1;
	}
	echo "<script>window.location='Shopping_Cart.php'</script>";
}