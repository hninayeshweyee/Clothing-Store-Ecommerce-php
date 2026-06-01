<?php

session_start();
include("connect.php");
include('Order_Functions.php');

            
if (isset($_GET['Add'])) {
    $productID = $_GET['productID'];
    $sizeID = $_GET['size'];
    $colorID = $_GET['color'];
    $purchasePrice = $_GET['txtPurchasePrice'];
    $purchaseQty = $_GET['txtPurchaseQty'];
    $TotalAmount = $_GET['txtTotalAmount'];
  
    // Correct function name
    addToCart($productID, $sizeID, $colorID, $purchasePrice, $purchaseQty);
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
    <title>Wint Clothing Store</title>

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

    <!-- Shop Details Section Begin -->

<section class="shop-details">
<form action="Clothing_Details.php" method="GET" enctype="multipart/form-data"  id="purchaseForm">
<?php

$productID = $_GET['productID'];  // Get the productID from the URL
$colorID = isset($_GET['colorID']) ? $_GET['colorID'] : ''; 
$query = "
SELECT pv.variationID, p.productID, p.productName, b.brandName, pv.productPrice, pv.image_1, pv.image_2, 
pv.productQuantity, p.description, s.sizeName, c.colorName, c.image AS colorImage
FROM product p
JOIN brand b ON p.brandID = b.brandID
JOIN product_variations pv ON p.productID = pv.productID
JOIN size s ON pv.sizeID = s.sizeID
JOIN color c ON pv.colorID = c.colorID
WHERE p.productID = '$productID'
";
$sql = mysqli_query($connect, $query);

if ($sql && mysqli_num_rows($sql) > 0) {
    $product = mysqli_fetch_assoc($sql);
    $productName = $product['productName'];
    $brandName = $product['brandName'];
    $productPrice = $product['productPrice'];
    $productDes = $product['description'];
    $productImage = $product['image_1'];
    $productImage2 = $product['image_2'];
    $productQty = $product['productQuantity'];
    $colorName = $product['colorName'];
    $productId = $product['productID'];
    $variationId = $product['variationID'];
}
?>
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./user_index.php">Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Clothing Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" id="clothing-image">
                                <img id="clothing-image" src="<?php echo $productImage; ?>" alt="">
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                            <div class="product__thumb__pic set-bg" id="clothing-image-2">
                                <img id="clothing-image-2" src="<?php echo $productImage2; ?>" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img id="product-image" src="<?php echo $productImage; ?>" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img id="product-image-2" src="<?php echo $productImage2; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                    <input type="hidden" name="txtvariationID" class="form-control" value="0" required>
                    <input type="hidden" name="productID" value="<?php echo $productId; ?>">
                    <input type="hidden" name="colorID" value="<?php echo $colorID; ?>">
                    <input type="hidden" name="txtPurchasePrice" value="<?php echo $productPrice; ?>">
                    <input type="hidden" name="txtTotalAmount" value="<?php echo $TotalAmount; ?>">
                        <h4 style="display:flex; justify-content: left;"><?php echo $productName; ?></h4>
                        <h5 style="display:flex; justify-content: left;">Brand: <?php echo $brandName; ?></h5>
                        <h5 style="display:flex; justify-content: left; margin:10px 0px;">Description: <?php echo $productDes; ?></h5>
                        <h4 style="display:flex; justify-content: left;">Price: <?php echo $productPrice; ?></h4>
                        <div class="product__details__option" style="display:flex; justify-content:left;">
                            <?php
                            // SQL to get sizes based on the product ID
                      
                            $sqlSizes = "
                            SELECT s.sizeID, s.sizeName 
                            FROM product_variations pv
                            JOIN size s ON pv.sizeID = s.sizeID
                            WHERE pv.productID = $productId
                            GROUP BY s.sizeID";
                            $sizeResult = $connect->query($sqlSizes);

                            // SQL to get colors based on the product ID
                            $sqlColors = "
                            SELECT c.colorID, c.colorName, c.image 
                            FROM product_variations pv
                            JOIN color c ON pv.colorID = c.colorID
                            WHERE pv.productID = $productId
                            GROUP BY c.colorID
                            ";
                            $colorResult = $connect->query($sqlColors);
                            ?>

                            <!-- Color Options -->
                            <div class="product__details__option__color" style="display:flex; justify-content:left;">
                                <span>Color:</span>
                                
                                <?php
                                if ($colorResult->num_rows > 0) {
                                    while ($color = $colorResult->fetch_assoc()) {
                                        echo "
                                        <label for='color-{$color['colorID']}' class='color-label' style='cursor: pointer;'>
                                            <input type='radio' name='color' id='color-{$color['colorID']}' value='{$color['colorID']}' data-image='{$color['image']}' hidden>
                                            <img src='{$color['image']}' alt='{$color['colorName']}' class='color-image' style='width:33px; height:33px; border-radius:33px;'/>
                                        </label>
                                        ";
                                    }
                                } else {
                                    echo "<p>No colors available</p>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Size Options -->
                        <!-- <div class="product__details__option" style="display:flex; justify-content:left;"> -->
                            <div class="product__details__option__size" id="size-options"style="display:flex; justify-content:left; padding:0px;">
                               
                                <?php
                                if ($sizeResult->num_rows > 0) {
                                    while ($size = $sizeResult->fetch_assoc()) {
                                        echo "
                                        <label for='size-{$size['sizeID']}'>{$size['sizeName']}
                                            <input type='radio' name='size' id='size-{$size['sizeID']}' value='{$size['sizeID']}'>
                                        </label>
                                        ";
                                    }
                                } else {
                                    echo "<p>No sizes available</p>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
            
    







    <input type="hidden" name="txtProductID" value="<?php echo $productID; ?>">
    <input type="hidden" name="sizeID" value="<?php echo $sizeID; ?>">
    <input type="hidden" name="colorName" value="<?php echo $colorID; ?>">
    <input type="hidden" name="price" value="<?php echo $productPrice; ?>">
    <input type="hidden" name="productName" value="<?php echo $productName; ?>">
    <input type="hidden" name="productImage" value="<?php echo $productImage; ?>">
    
    <div class="product__details__cart__option" style="display:flex; justify-content:left;">
        <div class="quantity">
            <input type="number" name="txtPurchaseQty" value="1" min="1" max="<?php echo $productQty; ?>" <?php if ($productQty <= 0) echo 'disabled'; ?> readable>
        </div>
        <input type="submit"  id="addtocart" name="Add" class="primary-btn" value="Add to Cart" min="1">
    </div>
    </form>



                        <!-- Wishlist Option -->
                        <div class="product__details__btns__option" style="display:flex; justify-content: left;">
                        <form action="add_to_wishlist.php" method="POST">
    <input type="hidden" name="productID" value="<?php echo $productId; ?>">
    <input type="hidden" name="colorID" value="<?php echo $colorID; ?>">
    <input type="hidden" name="sizeID" value="<?php echo $sizeID; ?>">
    <a><i class="fa fa-heart"></i><input type="submit" value="Add to Wishlist" style="border: none; outline: none; text-transform: uppercase; letter-spacing:2px;"></a>
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            

                            
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



    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

<script>
    $(document).ready(function() {
    // When a color label is clicked
    $('.color-label').on('click', function() {
        // Remove the 'selected' class from all color labels
        $('.color-label').removeClass('selected');
        
        // Add the 'selected' class to the clicked color label
        $(this).addClass('selected');
    });
});

document.getElementById('addtocart').addEventListener('click', function (e) {
        // Check if a color is selected
        const selectedColor = document.querySelector('input[name="color"]:checked');
        if (!selectedColor) {
            alert('Please select a color before adding to cart.');
            e.preventDefault(); // Prevent default action (like form submission or other actions)
            return;
        }

        // Check if a size is selected (optional)
        const selectedSize = document.querySelector('input[name="size"]:checked');
        if (!selectedSize) {
            alert('Please select a size before adding to cart.');
            e.preventDefault(); // Prevent default action
            return;
        }

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
    

<!-- JavaScript -->
<!-- Show Qty in shop icon  -->

<?php include 'footer.php'; ?>
</body>

</html>