<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("Order_Functions.php");

session_start();
include("connect.php");

// Get sort order from URL (default to 'asc')
$sortOrder = isset($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc']) ? $_GET['sort'] : 'asc';

// Search functionality
$searchTerm = '';
if (isset($_POST['search-info'])) {
    $searchTerm = mysqli_real_escape_string($connect, $_POST['txtSearch']);
}


// Filter by brand
$brandID = isset($_GET['brandID']) ? intval($_GET['brandID']) : null;
$whereClause = "WHERE 1";
if ($brandID) {
    $whereClause .= " AND brandID = $brandID";
}
if ($searchTerm) {
    $whereClause .= " AND productName LIKE '%$searchTerm%'";
}

// Query to fetch products with sorting
$sql = "SELECT p.*, pv.* 
        FROM product_variations pv
        JOIN product p ON pv.productID = p.productID
        $whereClause
        GROUP BY p.productName
        ORDER BY pv.productPrice $sortOrder";
$result = $connect->query($sql);

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
// **************************************************

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description">
    <meta name="keywords">
    <meta name="viewport">
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
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Section -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <!-- Search Bar -->
                    <div class="shop__sidebar__search">
                        <form action="shop.php" method="POST">
                            <input type="text" name="txtSearch" placeholder="Search...">
                            <button type="submit" name="search-info"><span class="icon_search"></span></button>
                        </form>
                    </div>

                    <!-- Categories and Filters -->
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <!-- Categories -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul class="nice-scroll">
                                                <li><a href="men.php">Men</a></li>
                                                <li><a href="women.php">Women</a></li>
                                                <li><a href="kid.php">Kids</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Branding -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php
                                                $brands = $connect->query("SELECT brandID, brandName FROM brand");
                                                while ($row = $brands->fetch_assoc()) {
                                                    echo '<li><a href="shop.php?brandID=' . $row['brandID'] . '">' . htmlspecialchars($row['brandName']) . '</a></li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Size Filter -->
                           
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Display -->
            <div class="col-lg-9">
                <div class="shop__product__option">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="shop__product__option__right">
                    <form action="shop.php" method="GET">
                        <p>Sort by Price:</p>
                        <select name="sort" id="sort-price" onchange="this.form.submit();">
                            <option value="asc" <?= $sortOrder == 'asc' ? 'selected' : ''; ?>>Low To High</option>
                            <option value="desc" <?= $sortOrder == 'desc' ? 'selected' : ''; ?>>High To Low</option>
                        </select>
                    </form>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php
                            $productName = htmlspecialchars($row['productName']);
                            $price = number_format($row['productPrice'], 2);
                            $imageUrl = htmlspecialchars($row['image_1']);
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item" style="display:flex; flex-direction:column; align-items:center;">
                                    <div class="product__item__pic set-bg" style="width: 250px; height: 350px;">
                                        <a href="Clothing_Details.php?productID=<?= $row['productID'] ?>">
                                            <img src="<?= $imageUrl ?>" style="object-fit: cover; width: 250px; height: 350px;">
                                        </a>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><?= $productName ?></h6>
                                        <a href="Clothing_Details.php?productID=<?= $row['productID'] ?>" class="add-cart">+ View Details</a>
                                        <h5><?= $price ?> MMK</h5>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No products found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

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
document.addEventListener('DOMContentLoaded', function () {
    const sortSelect = document.getElementById('sort-price');
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get('sort') || 'asc'; // Default to 'asc'
    sortSelect.value = currentSort;

    // Update the sort order when the dropdown changes
    sortSelect.addEventListener('change', function () {
        window.location.href = "shop.php?sort=" + sortSelect.value; // Update URL
    });
});
</script>

<script>
function addToWishlist(product_id) {
    // Send product ID to PHP script to add to wishlist
    var formData = new FormData();
    formData.append('product_id', product_id);
    
    fetch('add_to_wishlist.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert(data));
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>
