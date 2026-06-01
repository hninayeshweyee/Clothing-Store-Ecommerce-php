<?php

session_start();
include("connect.php");

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
    <!-- Header Section Begin -->
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
                            <!-- <div class="header__top__links">
                                <a href="../pages/user-sign-in.php">Sign in</a>
                            </div> -->

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
                            <li class="active"><a href="../pages/user_index.php">Home</a></li>
                            <li><a href="../pages/men.php">Men</a></li>
                            <li><a href="../pages/women.php">Women</a></li>
                            <li><a href="../pages/kid.php">Kid</a></li>
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

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/home/home5.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Collection</h6>
                                <h2>Discover a world where fashion meets comfort</h2>
                                <p>Whether you’re looking to elevate your wardrobe, find timeless classics, or embrace the latest trends, we’ve got you covered.</p>
                                <a href="shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="www.facebook.com"><i class="fa fa-facebook"></i></a>
                                    <a href="www.twitter.com"><i class="fa fa-twitter"></i></a>
                                    <a href="www.pinterest.com"><i class="fa fa-pinterest"></i></a>
                                    <a href="www.instagram"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/home/home4.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                                <h6>Collection</h6>
                                <h2>Discover a world where fashion meets comfort</h2>
                                <p>Whether you’re looking to elevate your wardrobe, find timeless classics, or embrace the latest trends, we’ve got you covered.</p>
                                <a href="shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="www.facebook.com"><i class="fa fa-facebook"></i></a>
                                    <a href="www.twitter.com"><i class="fa fa-twitter"></i></a>
                                    <a href="www.pinterest.com"><i class="fa fa-pinterest"></i></a>
                                    <a href="www.instagram"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner1.jpg" alt="" style="width:500px; height:450px;">
                        </div>
                        <div class="banner__item__text">
                            <h2>Trendy Collections</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner2.jpg" alt="">
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->

    <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".kids">KIDS</li>
                    <li data-filter=".men">MEN</li>
                    <li data-filter=".women">WOMEN</li>
                </ul>
            </div>
        </div>
        <?php
        $categories = ['Kids', 'Men', 'Women'];

        echo '<div class="row product__filter">';

        foreach ($categories as $category) {
            $sql = "SELECT p.*, c.categoryName, pv.*
                    FROM product_variations pv
                    JOIN product p ON pv.productID = p.productID
                    JOIN category c ON p.categoryID = c.categoryID
                    WHERE c.categoryName = '$category'
                    GROUP BY p.productName
                    LIMIT 4";

            $result = $connect->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productName = htmlspecialchars($row['productName']);
                    $price = number_format($row['productPrice'], 2);
                    $imageUrl = htmlspecialchars($row['image_1']);
                    $productID = htmlspecialchars($row['productID']);

                    echo '<div class="col-lg-3 col-md-6 col-sm-6 mix ' . strtolower($category) . '" style="' . ($category == 'Kids' ? 'display:block;' : 'display:none;') . '">';
                    echo '<div class="product__item" style="display:flex; flex-direction:column; align-items:center;">';

                    // Product Image with Link
                    echo '<div class="product__item__pic set-bg" style="width: 250px; height: 350px;">';
                    echo '<a href="Clothing_Details.php?productID=' . $productID . '">';
                    echo '<img src="' . $imageUrl . '" style="object-fit: cover; width: 250px; height: 350px;">';
                    echo '</a>';
                    echo '</div>';

                    // Product Details
                    echo '<div class="product__item__text">';
                    echo '<h6>' . $productName . '</h6>';
                    echo '<h5>' . $price . ' MMK</h5>';
                    echo '<a href="Clothing_Details.php?productID=' . $productID . '" class="add-cart">+ View Details</a>';
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found for ' . $category . '</p>';
            }
        }

        echo '</div>';
        $connect->close();
        ?>
    </div>
</section>

    <!-- Product Section End -->



    

    <!-- Categories Section Begin -->
    <!-- <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes.webp"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes4.jpeg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes5.webp"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/home/babyclothes6.webp"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Adorable Babywear for Every Little Adventure</h2>
                        <p>Wrap your little one in love! Discover adorable, comfy, and high-quality baby clothes for every precious moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/home/latest4.webp"></div>
                        <div class="blog__item__text">
                            <h5>It's the best time to buy brands.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/home/latest5.webp"></div>
                        <div class="blog__item__text">
                            <h5>This season is most anticipated arrivals from the best brand.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/home/latest6.webp"></div>
                        <div class="blog__item__text">
                            <h5>Discover the Newest Collection.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <!-- Footer Section Begin -->
    <!-- <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <img src="../images/Wint_Logo.png" alt="" style="width:150px; height:150px;">
                        </div>
                        <p>The customer is at the heart of our unique business model.</p>
                        <a href="#"><img src="img/icon/kpay_logo.webp" alt="" style="width:40px; height:40px;"></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                       
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                       
                    </div>
                </div>
            </div>
        </div>
    </footer> -->
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <!-- <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div> -->
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
    <?php include 'footer.php'; ?>
</body>

</html>