<?php  
session_start(); 
include('connect.php');
include('AutoID_Functions.php');
include('Purchase_Order_Functions.php');
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




// Get the customerID from session (assuming customerID is stored in the session)
$customerID = $_SESSION['customerID']; 

// Fetch orders for the logged-in user (no search functionality)
$query = "SELECT po.*, s.customerID, s.customerName 
          FROM orders po, customer s
          WHERE po.customerID = '$customerID' 
          AND po.customerID = s.customerID
          Order By orderID DESC";
$result = mysqli_query($connect, $query);
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <!-- ...Font Awesome... -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>
    Wint Clothing Shop
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
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
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./user_index.php">Home</a>
                            <span>My Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        
  <form action="myorder.php" method="post">  
          
            	<table class="table align-items-center mb-0">
            	<tr>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order_ID</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CustomerName</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Amount</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">GrandTotal</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">~</th>
            	</tr>
            	<?php 
            	for ($i=0;$i<$count;$i++) 
            	{ 
            		$row=mysqli_fetch_array($result);
            		$Purchase_ID=$row['orderID'];
                
            		echo "<tr>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>$Purchase_ID</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['orderDate'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['customerName'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['subTotal'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['totalAmount'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['status'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'><a href='myorder_Detail.php?orderID=$Purchase_ID'>Details</a></td>";
            		echo "</tr>";
            	}			
            	 ?>
            	</table>
         
            

        </form>

    </main>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
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