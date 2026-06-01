<?php
session_start();
include("connect.php");

if (isset($_POST['remove']) && isset($_POST['productID'])) {
    $productID = $_POST['productID'];
    $customerID = $_SESSION['customerID']; // Assuming customerID is stored in the session

    // Check if the customerID is valid
    if (!empty($customerID) && !empty($productID)) {
        // Remove product from the wishlist
        $stmt = $connect->prepare("DELETE FROM wishlist WHERE customerID = ? AND productID = ?");
        $stmt->bind_param("ii", $customerID, $productID);
        
        if ($stmt->execute()) {
            // Successfully removed the product
            $_SESSION['message'] = "Product removed from your wishlist.";
        } else {
            // Error removing the product
            $_SESSION['message'] = "There was an error removing the product. Please try again.";
        }
        
        $stmt->close();
    } else {
        $_SESSION['message'] = "Invalid product or user.";
    }
    
    // Redirect to wishlist page after removing the product
    header("Location: Wishlist.php");
    exit;
}


// Function to calculate the total cart count
function calculateCartCount() {
    if (isset($_SESSION['PurchaseFunctions']) && count($_SESSION['PurchaseFunctions']) > 0) {
        $TotalQuantity = 0;
        $size = count($_SESSION['PurchaseFunctions']);

        for ($i = 0; $i < $size; $i++) {
            $Purchase_Quantity = $_SESSION['PurchaseFunctions'][$i]['quantity'];
            $TotalQuantity += $Purchase_Quantity;
        }
        return $TotalQuantity;
    } else {
        return 0;
    }
}
$totalCartCount = calculateCartCount();

// Display success or error message if set
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying it
}


?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
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
                            <li><a href="../pages/shop.php">Shop</a></li>
                            
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

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option" style="margin-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./user_index.php">Home</a>
                        <span>Favourite Lists</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<?php
if (isset($_SESSION['customerID']) && !empty($_SESSION['customerID'])) {
    $customerID = $_SESSION['customerID'];

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Fetch products from wishlist
    $stmt = $connect->prepare("
    SELECT p.productID, p.productName, pv.productPrice, pv.image_1
    FROM wishlist w
    JOIN product p ON w.productID = p.productID
    JOIN product_variations pv ON p.productID = pv.productID
    WHERE w.customerID = ?
    GROUP BY p.productID, p.productName
    ORDER BY w.wishlistID DESC
");
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<div class="container">
    <div class="row">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                $productName = htmlspecialchars($row['productName']);
                $price = number_format($row['productPrice'], 2);
                $imageUrl = htmlspecialchars($row['image_1']);
                $productID = $row['productID'];
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item" style="display:flex; flex-direction:column; align-items:center;">
                        <div class="product__item__pic set-bg" style="width: 250px; height: 350px;">
                            <a href="Clothing_Details.php?productID=<?= $productID ?>">
                                <img src="<?= $imageUrl ?>" style="object-fit: cover; width: 250px; height: 350px;">
                            </a>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $productName ?></h6>
                            <a href="Clothing_Details.php?productID=<?= $productID ?>" class="add-cart">+ View Details</a>
                            <h5><?= $price ?> MMK</h5>
                            <!-- Remove button -->
                            <form action="Wishlist.php" method="POST">
                                <input type="hidden" name="productID" value="<?= $productID ?>">
                                <button type="submit" name="remove" class="remove-btn">Remove</button>
                            </form>
                        </div>
                    </div>
                
                </div>
                    
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found in your wishlist.</p>
        <?php endif; ?>
    </div>
    
    
</div>

<?php
    $stmt->close();
    $connect->close();
} else {
    echo "Please Login first.";
}


?>


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
<?php include 'footer.php'; ?>
</body>
</html>
