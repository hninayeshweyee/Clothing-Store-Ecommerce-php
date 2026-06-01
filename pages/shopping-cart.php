<?php

session_start();
include("connect.php");
include('Order_Functions.php');

            
if (isset($_GET['Add'])) {
    $productID = $_GET['productID'];
    $sizeID = $_GET['size'];
	$purchasePrice = $_GET['txtPurchasePrice'];
    $colorID = $_GET['color'];
    $purchaseQty = $_GET['txtPurchaseQty'];
  
    // Correct function name
    addToCart($productID, $sizeID, $colorID,$purchasePrice, $purchaseQty);
  }
  if (isset($_GET['Action'])) 
  {
      $Action=$_GET['Action'];
  
      if ($Action === "Remove") 
      {
          $ProductID=$_GET['productID'];
          RemoveProduct($ProductID);
      }
      elseif($Action === "ClearAll") 
      {
          ClearAll();
      }
  }
  else
  {
      $Action="";
  }

  function calculateCartCount() {
    // Check if the session 'PurchaseFunctions' exists and is not empty
    if (isset($_SESSION['PurchaseFunctions']) && count($_SESSION['PurchaseFunctions']) > 0) {
        $TotalQuantity = 0;
        $size = count($_SESSION['PurchaseFunctions']);
    
        // Loop through the cart items to calculate total quantity
        for ($i = 0; $i < $size; $i++) { 
            $Purchase_Quantity = $_SESSION['PurchaseFunctions'][$i]['quantity'];
            $TotalQuantity += $Purchase_Quantity;
        }
        return $TotalQuantity; // Return the total quantity
    } else {
        return 0; // Return 0 if the cart is empty or not set
    }
}
// Return the total cart count as a response
// echo calculateCartCount();
  $totalCartCount = calculateCartCount();


?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wint Clothing Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
             <!-- Offcanvas Menu Begin -->
             <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
            <?php

include("connect.php");

if(isset($_SESSION['customerName'])){
    echo"<div class='header__top__links'>
                                <a href='../pages/myorder.php'>My Order</a>
                            </div>";
    echo"<div class='header__top__links'>
                    <a href='../pages/user-sign-in.php'>Log Out</a>
                </div>";

}else{
    echo"<div class='header__top__links'>
                    <a href='../pages/user-sign-in.php'>Sign In</a>
                </div>";

}

?>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="search.php" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="Wishlist.php"><img src="img/icon/heart.png" alt=""></a>
            <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>

    <!-- Offcanvas Menu End -->

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">

                            <?php

            include("connect.php");

            if(isset($_SESSION['customerName'])){
                echo"<div class='header__top__links'>
                                <a href='../pages/myorder.php'>My Order</a>
                            </div>";
                echo"<div class='header__top__links'>
                                <a href='../pages/user-sign-in.php'>Log Out</a>
                            </div>";

            }else{
                echo"<div class='header__top__links'>
                                <a href='../pages/user-sign-in.php'>Sign In</a>
                            </div>";
            
            }

        ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./user_index.php"><img src="../images/Wint_Logo.png" alt="" style="width:40px; height:40px;"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="../pages/user_index.php">Home</a></li>
                            <li><a href="../pages/men.php">Men</a></li>
                            <li><a href="../pages/women.php">Women</a></li>
                            <li><a href="../pages/kid.php">Kids</a></li>
                            <li class="active"><a href="../pages/shop.php">Shop</a></li>
                            
                            <li><a href="../pages/contact.php">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="search.php" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="Wishlist.php"><img src="img/icon/heart.png" alt=""></a>
                        <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span><?php echo $totalCartCount?></span></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

<!-- Breadcrumb Section -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./user_index.php">Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Shop Details Section Begin -->
<?php
//   if (isset($_SESSION['PurchaseFunctions']) && is_array($_SESSION['PurchaseFunctions'])) {
//     // Proceed with your logic
//     $total_quantity = count($_SESSION['PurchaseFunctions']); // Or your own calculation logic
// } else {
//     $total_quantity = 0; // Default to 0 if 'PurchaseFunctions' is not set
// }
  
?>
    <section class="shopping-cart spad">
    <form action="Clothing_Details.php" method="GET" enctype="multipart/form-data" id="purchaseForm">

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php if (isset($_SESSION['PurchaseFunctions']) && count($_SESSION['PurchaseFunctions']) > 0) { ?>
                        <div class="shopping__cart__table">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    foreach ($_SESSION['PurchaseFunctions'] as $item) {
                                        $ProductID = $item['productID'];
                                        $Image = $item['image_1'];
                                        $ProductModel = $item['productName'];
                                        $PurchasePrice = $item['purchasePrice'];
                                        $PurchaseQty = $item['quantity'];

                                        $SubTotal = $PurchasePrice * $PurchaseQty;

                                        echo "<tr>
                                                <td class='product__cart__item'>
                                                    <div class='product__cart__item__pic'>
                                                        <img src='$Image' alt='product' style='width: 50px; height:50px;'>
                                                    </div>
                                                    <div>
                                                        <h6>$ProductModel</h6>
                                                    </div>    
                                                </td>
                                                <td class='cart__price'>$PurchasePrice</td>
                                                <td><div class='quantity'><div>$PurchaseQty</div></div></td>
                                                <td class='cart__price'>$SubTotal</td>
                                                <td class='cart__close'>
                                                    <a href='shopping-cart.php?productID=$ProductID&Action=Remove' class='font-weight-bold text-xs' style='color: red;'>
                                                        <i class='fa fa-close'></i>
                                                    </a>
                                                </td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="shop.php">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                        </div>
                    <?php } else { ?>
                        <h6>Your cart is empty</h6>
                    <?php } ?>
                </div>

                <?php if (isset($_SESSION['PurchaseFunctions']) && count($_SESSION['PurchaseFunctions']) > 0) { ?>
                    <div class="col-lg-4">
                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Sub-Total: <b><?php echo CalculateTotalAmount() ?></b></li>
                                <li>VAT (5%): <b><?php echo CalculateVAT() ?></b></li>
                                <li>Total: <b><?php echo CalculateTotalAmount() + CalculateVAT() ?></b></li>
                            </ul>
                            <a href="Check-Out.php" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-4">
                        <!-- No total display when cart is empty -->
                    </div>
                <?php } ?>
            </div>
        </div>

    </form>
</section>

<!-- Shop Details Section End -->

<!-- JavaScript to Update Image and Sizes on Color Change -->
<script>
    $(document).ready(function () {
    // Listen for color selection change
    $('input[name="color"]').on('change', function () {
        var colorID = $(this).val();  // Get selected color ID
        
        // Send AJAX request to get images and sizes based on color selection
        $.ajax({
            url: 'get_product_color.php',  // Update with the correct PHP file
            method: 'POST',
            data: { colorID: colorID, productID: <?php echo $productId; ?> },
            success: function (response) {
                var data = JSON.parse(response);

                // Update product images based on the selected color
                if (data.success) {
                    $('#product-image').attr('src', data.image1);
                    $('#product-image-2').attr('src', data.image2);
                    $('#clothing-image img').attr('src', data.image1);
                    $('#clothing-image-2 img').attr('src', data.image2);

                    // Update available sizes based on the selected color
                    $('#size-options').html(data.sizesHtml || "<p>No sizes available</p>");

                }
            },
            error: function () {
                alert('Error retrieving data. Please try again.');
            }
        });
    });
});

</script>

<script>$(document).ready(function () {
    // Handle size selection
    $('body').on('change', 'input[name="size"]', function () {
        // Remove active class from all labels
        $('.product__details__option__size label').removeClass('active');
        
        // Add active class to the clicked size label
        $(this).closest('label').addClass('active');
    });
});
</script>



    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>


    </script>
    
    <?php include 'footer.php'; ?>
<!-- JavaScript -->

</body>

</html>