<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Order_Functions.php');

// Ensure the user is logged in
if (!isset($_SESSION['customerID'])) {
    echo "<script>window.alert('Please Login.')</script>";
    echo "<script>window.location='user-sign-in.php'</script>";
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnOrder'])) {
    $customerID = $_SESSION['customerID'];

    // Order data from the form
    $orderData = [
        'orderDate'   => $_POST['txtOrderDate'],
        'subTotal'    => $_POST['txtSubTotal'],
        'tax'         => $_POST['txtTax'],
        'totalAmount' => $_POST['txtTotalAmount'],
        'status'      => 'Pending',
        'location'    => $_POST['txtLocation'],
        'phone'       => $_POST['txtPhone'],
        'remark'      => $_POST['txtRemark'],
        'paymentType' => $_POST['txtPaymentType'],
        'customerID'  => $customerID
    ];

    try {
        // Initialize PDO connection
        $pdo = new PDO("mysql:host=localhost;dbname=wint_clothing_store", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin transaction
        $pdo->beginTransaction();

        // Insert into orders table
        $orderID = insertOrder($pdo, $orderData);

        // Insert into order_detail table
        if (isset($_SESSION['PurchaseFunctions']) && !empty($_SESSION['PurchaseFunctions'])) {
            foreach ($_SESSION['PurchaseFunctions'] as $item) {
                $variationID = getVariationID($pdo, $item['productID'], $item['sizeID'], $item['colorID']);
                if ($variationID) {
                    insertOrderDetail($pdo, $orderID, $variationID, $item['quantity'], $item['purchasePrice']);
                } else {
                    echo "Variation not found for ProductID: {$item['productID']}<br>";
                }
            }
        } else {
            echo "No items in the cart.<br>";
        }

        // Commit the transaction
        $pdo->commit();

        // Clear the cart
        unset($_SESSION['PurchaseFunctions']);
        echo "<script>localStorage.removeItem('cartItems');</script>";

        echo "<script>
    alert('Order placed successfully! Thank you for shopping with us.');
    window.location.href = 'shop.php';
</script>";

    } catch (PDOException $e) {
        // Rollback the transaction if an error occurs
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    
}

// Function to insert order data
function insertOrder($pdo, $orderData) {
    $sql = "INSERT INTO orders (orderDate, subTotal, tax, totalAmount, status, location, phoneNumber, remarks, paymentType, customerID) 
            VALUES (:orderDate, :subTotal, :tax, :totalAmount, :status, :location, :phone, :remark, :paymentType, :customerID)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($orderData);
    return $pdo->lastInsertId(); // Return the last inserted orderID
}

// Function to get the variationID
function getVariationID($pdo, $productID, $sizeID, $colorID) {
    $sql = "SELECT variationID FROM product_variations WHERE productID = :productID AND sizeID = :sizeID AND colorID = :colorID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['productID' => $productID, 'sizeID' => $sizeID, 'colorID' => $colorID]);
    $variation = $stmt->fetch(PDO::FETCH_ASSOC);
    return $variation ? $variation['variationID'] : null;
}

// Function to insert order details into the order_detail table
function insertOrderDetail($pdo, $orderID, $variationID, $quantity, $purchasePrice) {
    $sql = "INSERT INTO order_detail (orderID, variationID, quantity, purchasePrice) 
            VALUES (:orderID, :variationID, :quantity, :purchasePrice)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'orderID' => $orderID,
        'variationID' => $variationID,
        'quantity' => $quantity,
        'purchasePrice' => $purchasePrice
    ]);
}
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
    echo"
                    <a href='../pages/user-sign-in.php'>Log Out</a>
                ";

}else{
    echo"
                    <a href='../pages/user-sign-in.php'>Sign In</a>
           ";

}

?>

            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
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
                            <!-- <div class="header__top__links">
                                <a href="../pages/user-sign-in.php">Sign in</a>
                            </div> -->

                            <?php

            include("connect.php");

            if(isset($_SESSION['customerName'])){
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
                            <li><a href="../pages/kid.php">Kid</a></li>
                            <li class="active"><a href="../pages/shop.php">Shop</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            
                            <li><a href="./contact.html">Contacts</a></li>
                        </ul>
                    </nav>

                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="#"><img src="img/icon/heart.png" alt=""></a>
                        <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./user_index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <?php

    ?>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="Check-Out.php" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                    <input type="hidden" name="txtvariationID" />
                                        <p>Your OrderID</p>
                                        <input type="text" name="txtOrderID" value="<?php echo AutoID('orders', 'orderID', 'Or-', 6); ?>" readonly/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                    
                                        <p>Your Name<span></span></p>
                                        <input type="text" name="txtCustomerName" value="<?php echo $_SESSION['customerName'] ?>" readonly/> 
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Order Date<span></span></p>
                                        <input type="text" name="txtOrderDate" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone Number<span>*</span></p>
                                        <input type="text" name="txtPhone" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Location<span>*</span></p>
                                <input type="text" name="txtLocation" required>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Remark</p>
                                <input type="text" name="txtRemark">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                
                                    <?php  
                if (isset($_SESSION['PurchaseFunctions'])) {
                    $size = count($_SESSION['PurchaseFunctions']);
                    for ($i = 0; $i < $size; $i++) {
                        $ProductID = $_SESSION['PurchaseFunctions'][$i]['productID'];
                        $Image = $_SESSION['PurchaseFunctions'][$i]['image_1'];
                        $ProductModel = $_SESSION['PurchaseFunctions'][$i]['productName'];
                        $PurchasePrice = $_SESSION['PurchaseFunctions'][$i]['purchasePrice'];
                        $PurchaseQty = $_SESSION['PurchaseFunctions'][$i]['quantity'];
                        $SubTotal = $PurchasePrice * $PurchaseQty;
                      
                    }
                }
                ?>
                                
                                <ul class="checkout__total__all" >
                                    <li style="display:flex; justify-content:space-between;">Subtotal : <?php echo CalculateTotalAmount(); ?></li>
                                    <li style="display:flex; justify-content:space-between;">Total : <?php echo CalculateTotalAmount()+CalculateVAT() ?></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    
                                        <input type="radio" name="txtPaymentType" value="Kpay" on click="showPaymentTable()" checked>Kpay
                                        <input type="radio" name="txtPaymentType" value="WavePay" on click="showPaymentTable()" checked>WavePay
                                        <input type="radio" name="txtPaymentType" value="OK$" on click="showPaymentTable()" checked>OK$
                                        <input type="hidden" name="txtTotalAmount" value="<?php echo CalculateTotalAmount()+CalculateVAT() ?>" readonly/>
                                        <input type="hidden" name="txtSubTotal" class="form-control" value="<?php echo CalculateTotalAmount(); ?>" readonly/>
                                        <input type="hidden" name="txtTax" class="form-control" value="<?php echo CalculateVAT() ?>" readonly> 
                                </div>

                                <button type="submit" name='btnOrder' id="check-out-btn" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Get the Save button
        const saveButton = document.getElementById('btnSave');
        
        // Add click event listener to the Save button
        saveButton.addEventListener('click', function(event) {
            const supplierSelect = document.getElementById('supplier'); // Supplier select element
            if (!supplierSelect.value) {
                alert("Please select a supplier to save the purchase.");
                event.preventDefault(); // Prevent form submission if no supplier is selected
            }
        });
    });
</script>

<script>

</script>
</body>

</html>