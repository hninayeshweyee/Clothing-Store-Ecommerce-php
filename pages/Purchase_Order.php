<?php 
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Purchase_Order_Functions.php');

if(!isset($_SESSION['staffID']))
    {
        echo "<script>window.alert('Please Login.')</script>";
        echo "<script>window.location='sign-in.php'</script>";
    }

            $sName= $_SESSION['staffName'];


            if (isset($_POST['btnSave'])) {
              // Initialize PDO connection
              try {
                  $pdo = new PDO('mysql:host=localhost;dbname=wint_clothing_store', 'root', '');
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              } catch (PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                  exit();
              }
          
              // Get purchase order data
              $txtPurchaseDate = $_POST['txtPurchaseDate'];
              $txtSubTotal = $_POST['txtSubTotal'];
              $cboSupplierID = $_POST['cboSupplierID'];
              $Status = "Pending";
              $txtTax = $_POST['txtTax'];
              $txtTotalAmount = $_POST['txtTotalAmount'];
              $StaffID = $_SESSION['staffID'];
          
              try {
                  // Step 1: Insert into 'purchase' table and get the generated purchaseID
                  $stmt1 = $pdo->prepare("INSERT INTO `purchase` (`purchaseDate`, `staffID`, `subTotal`, `Tax`, `totalAmount`, `supplierID`, `status`)
                                          VALUES (:purchaseDate, :staffID, :subTotal, :Tax, :totalAmount, :supplierID, :status)");
                  $stmt1->execute([
                      'purchaseDate' => $txtPurchaseDate,
                      'staffID' => $StaffID,
                      'subTotal' => $txtSubTotal,
                      'Tax' => $txtTax,
                      'totalAmount' => $txtTotalAmount,
                      'supplierID' => $cboSupplierID,
                      'status' => $Status
                  ]);
          
                  // Fetch the last inserted purchaseID
                  $purchaseID = $pdo->lastInsertId();
          
                  // Step 2: Begin transaction for inserting into 'purchase_order_detail' and updating stock if necessary
                  $pdo->beginTransaction();
          
                  if (isset($_SESSION['PurchaseFunctions']) && !empty($_SESSION['PurchaseFunctions'])) {
                      $size = count($_SESSION['PurchaseFunctions']);
                      foreach ($_SESSION['PurchaseFunctions'] as $item) {
                          $ProductID = $item['productID'];
                          $SizeID = $item['sizeID'];
                          $ColorID = $item['colorID'];
                          $PurchasePrice = $item['purchasePrice'];
                          $PurchaseQty = $item['quantity'];
          
                          // Fetch variationID from product_variations using PDO
                          $stmt2 = $pdo->prepare("SELECT variationID FROM product_variations WHERE productID = :productID AND sizeID = :sizeID AND colorID = :colorID");
                          $stmt2->execute([
                              'productID' => $ProductID,
                              'sizeID' => $SizeID,
                              'colorID' => $ColorID
                          ]);
                          $variation = $stmt2->fetch(PDO::FETCH_ASSOC);
          
                          if ($variation) {
                              $variationID = $variation['variationID'];
          
                              // Step 3: Check if the combination of purchaseID and variationID already exists in purchase_order_detail
                              $stmt3 = $pdo->prepare("SELECT * FROM purchase_order_detail WHERE purchaseID = :purchaseID AND variationID = :variationID");
                              $stmt3->execute([
                                  'purchaseID' => $purchaseID,
                                  'variationID' => $variationID
                              ]);
          
                              if ($stmt3->rowCount() > 0) {
                                  // If combination exists, update the quantity and price
                                  $stmt4 = $pdo->prepare("UPDATE purchase_order_detail
                                                          SET quantity = quantity + :quantity,
                                                              purchasePrice = :purchasePrice
                                                          WHERE purchaseID = :purchaseID AND variationID = :variationID");
                                  $stmt4->execute([
                                      'purchaseID' => $purchaseID,
                                      'variationID' => $variationID,
                                      'quantity' => $PurchaseQty,
                                      'purchasePrice' => $PurchasePrice
                                  ]);
                              } else {
                                  // Insert a new entry if it doesn't exist
                                  $stmt5 = $pdo->prepare("INSERT INTO `purchase_order_detail` (`purchaseID`, `variationID`, `quantity`, `purchasePrice`)
                                                          VALUES (:purchaseID, :variationID, :quantity, :purchasePrice)");
                                  $stmt5->execute([
                                      'purchaseID' => $purchaseID,
                                      'variationID' => $variationID,
                                      'quantity' => $PurchaseQty,
                                      'purchasePrice' => $PurchasePrice
                                  ]);
                              }
          
                              // Step 4: Update product variations table
                              $stmt6 = $pdo->prepare("UPDATE product_variations
                                                      SET productQuantity = productQuantity + :quantity
                                                      WHERE variationID = :variationID");
                              $stmt6->execute([
                                  'quantity' => $PurchaseQty,
                                  'variationID' => $variationID
                              ]);
                          } else {
                              echo "Variation not found for ProductID: $ProductID, SizeID: $SizeID, ColorID: $ColorID.<br>";
                          }
                      }
                  } else {
                      echo "No items in session to process.<br>";
                  }
          
                  // Step 5: Commit the transaction
                  $pdo->commit();
                  echo "<script>window.alert('Purchase Order data saved successfully.')</script>";
                  unset($_SESSION['PurchaseFunctions']);
                  echo "<script>window.location='Purchase_Order.php'</script>";
              } catch (Exception $e) {
                  // Rollback transaction if any exception occurs
                  $pdo->rollBack();
                  echo "Error: " . $e->getMessage();
              }
          }
          
           
            
if (isset($_POST['btnAdd'])) {
  $productID = $_POST['cboProductID'];
  $sizeID = $_POST['cboSizeID'];
  $colorID = $_POST['cboColorID'];
  $purchasePrice = $_POST['txtPurchasePrice'];
  $purchaseQty = $_POST['txtPurchaseQty'];

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




 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <!-- ...Font Awesome... -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>
    Supplier
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
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../images/Wint_Logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white" style="font-size: 20px; padding-left: 0px;">W.I.N.T</span>
      </div>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Brand_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Brand</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Category_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/Size_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Size</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/Color_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Color</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/Supplier_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Supplier</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Product_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Product</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Product_Detail.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Product Details</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-warning " href="../pages/Purchase_Order.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Purchase Order</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Purchase_Order_List.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Purchase Order List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/Order_List.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Customer Order List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/sign-up.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Staff Registration</span>
          </a>
        </li>


        

        <?php

            include("connect.php");

            if(isset($_SESSION['staffName'])){
                echo"<li class='nav-item'>
          <a class='nav-link text-white' href='../pages/sign-in.php'>
            <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
              <i class='material-icons opacity-10'>assignment</i>
            </div>
            <span class='nav-link-text ms-1'>Log Out</span>
          </a>
        </li>";

            }else{
                echo"<li class='nav-item'>
          <a class='nav-link text-white' href='../pages/sign-in.php'>
            <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
              <i class='material-icons opacity-10'>login</i>
            </div>
            <span class='nav-link-text ms-1'>Sign In</span>
          </a>
        </li>";
                echo"<li class='nav-item'>
          <a class='nav-link text-white' href='../pages/sign-up.php'>
            <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
              <i class='material-icons opacity-10'>assignment</i>
            </div>
            <span class='nav-link-text ms-1'>Sign Up</span>
          </a>
        </li>";
            }

        ?>
        

      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Purchase Product</li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center" style="margin-left:150px;">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Manage Purchase</h6>
        </nav>
        <!-- <form action="Product_Entry.php" method="POST">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            <input type="text" name="txtSearch" placeholder="Type here..." class="form-control" style="background-color: white;">
            <button type="submit" name="search-info" style="border: none; font-size:10px; padding-left: 10px;"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
            
          </div>
          </form> -->

  
    </nav>
    <!-- End Navbar -->


    <div class="container-fluid py-4">
 
      <div class="row" style="display:flex; justify-content: space-around">
      <div class="col-md-8 mt-4" style="border: 1px solid #B2B1B9; padding: 30px; border-radius:10px; background-color:white;">
            <form action="Purchase_Order.php" method="POST" enctype="multipart/form-data"  id="purchaseForm">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0" style="padding-bottom: 15px">Purchase Product Info:</h6>
                </div>
                <label class="form-label font-weight-bolder mb-0">PurchaseID:</label>
                <div class="input-group input-group-outline mb-3">   

                    <input type="text" name="txtPurchaseID" class="form-control" value="<?php echo AutoID('purchase', 'purchaseID', 'PO-', 6); ?>" readonly>
                </div>

                <label class="form-label font-weight-bolder mb-0">PurchaseDate:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtPurchaseDate" class="form-control" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly>
                </div>

                <label class="form-label font-weight-bolder mb-0">Staff Name:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtStaffName" class="form-control" value="<?php echo $_SESSION['staffName'] ?>" readonly/> 
                </div>

                <label class="form-label font-weight-bolder mb-0">Sub Total:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="number" name="txtSubTotal" class="form-control" value="<?php echo CalculateTotalAmount(); ?>" readonly/> MMK
                </div>
                
                <label class="form-label font-weight-bolder mb-0">Tax:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="number" name="txtTax" class="form-control" value="<?php echo CalculateVAT() ?>" readonly> MMK
                </div>
                
                <label class="form-label font-weight-bolder mb-0">All Total:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="number" name="txtTotalAmount" class="form-control" value="<?php echo CalculateTotalAmount() + CalculateVAT() ?>" readonly/> MMK
                </div>
                
                <label class="form-label font-weight-bolder mb-0">Product ID and Name:</label>
                <div class="input-group input-group-outline mb-3">
                    <select name="cboProductID" id="product" class="form-control" >
                        <option></option>             
                        <?php
                        $pdo = new PDO("mysql:host=localhost;dbname=wint_clothing_store", "root", "");
                        $productsQuery = $pdo->query("SELECT pv.productID, p.productName 
                                  FROM product_variations pv
                                  JOIN product p ON pv.productID = p.productID
                                  GROUP BY pv.productID");
                        while ($row = $productsQuery->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['productID'] . "'>" . $row['productName'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <label class="form-label font-weight-bolder mb-0">Size:</label>
                <div class="input-group input-group-outline mb-3">
                    <select name="cboSizeID" id="size" class="form-control" >
                        <option> Select Product Size</option>             
                    </select>
                </div>
                <label class="form-label font-weight-bolder mb-0">Color :</label>
                <div class="input-group input-group-outline mb-3">
                    <select name="cboColorID" id="color" class="form-control" >
                        <option> Select Product Color </option>             
                    </select>
                </div>
                
                           
                <label class="form-label font-weight-bolder mb-0">Purchase Price:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="number" name="txtPurchasePrice" class="form-control" value="0" >
                </div>

                <label class="form-label font-weight-bolder mb-0">Purchase Quantity:</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="number" name="txtPurchaseQty" class="form-control" value="0" >
                </div>

                <div class="text-center">
                    <input type="submit" name="btnAdd" value="Add" class="btn w-100 my-4 mb-2" style="background-color: #FFBD61; color: black; margin:0px;">  
                    <a href="Purchase_Order.php?Action=ClearAll" class="btn w-100" style="padding:0px; margin:0px;">Clear All</a>
                </div>
                <input type="hidden" name="txtvariationID" class="form-control" value="0" required>
              
        </div>





        <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Information</h6>
              </div>
            </div> -->


            <div class="card-body px-0 pb-2">
            <form method="POST" action="Purchase_Order.php">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">SubTotal</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
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
                        echo "<tr>
                            <td>
                                <div class='d-flex px-2 py-1'>
                                    <div>
                                        <img src='$Image' class='avatar avatar-sm me-3 border-radius-lg' alt='product'>
                                    </div>
                                    <div class='d-flex flex-column justify-content-center'>
                                        <h6 class='mb-0 text-sm'>$ProductModel</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class='text-xs text-center font-weight-bold mb-0'>$PurchasePrice</p>
                            </td>
                            <td class='align-middle text-center text-sm'>
                                <p class='text-xs font-weight-bold mb-0'>$PurchaseQty</p>
                            </td>
                            <td class='align-middle text-center text-sm'>
                                <p class='text-xs font-weight-bold mb-0'>$SubTotal</p>
                            </td>
                            <td class='align-middle text-center'>
                                <a href='Purchase_Order.php?productID=$ProductID&Action=Remove' class='font-weight-bold text-xs' style='color: red;'>
                                    Remove
                                </a>
                            </td>
                        </tr>";
                    }
                }
                ?>
                <tr>
                    <td>
                        SupplierID:
                        <div class="input-group input-group-outline mb-3">
                            <select name="cboSupplierID" class="form-control" id="supplier">
                                <option></option>
                                <?php
                                $query_pro = "SELECT * FROM supplier";
                                $ret_pro = mysqli_query($connect, $query_pro);
                                $count_pro = mysqli_num_rows($ret_pro);
                                for ($i = 0; $i < $count_pro; $i++) {
                                    $row_pro = mysqli_fetch_array($ret_pro);
                                    $Supplier_ID = $row_pro['supplierID'];
                                    $Supplier_Name = $row_pro['supplierName'];
                                    echo "<option value='$Supplier_ID'>$Supplier_ID - $Supplier_Name</option>";
                                }


                              
                                ?>
                            </select>
                        </div>
                    </td>
                    <td style="display:flex; justify-content: center;">
                        <input type="submit" id="btnSave" name="btnSave" value="Save" class="btn w-100 my-4 mb-2" style="background-color: #FFBD61; color: black; margin:0px; "/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

            </div>
          </div>
        </div>
      </div>
    </div>
    
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
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
<script>
document.getElementById('product').addEventListener('change', function() {
    const productId = this.value;
    const sizeSelect = document.getElementById('size');
    const colorSelect = document.getElementById('color');

    // Disable size and color dropdowns initially
    sizeSelect.disabled = true;
    colorSelect.disabled = true;

    // Clear the size and color dropdowns before making a new request
    sizeSelect.innerHTML = '<option value="">Please select size</option>';
    colorSelect.innerHTML = '<option value="">Please select color</option>';

    if (productId) {
        // Fetch available sizes and colors for the selected product
        fetch('fetch_options.php?productID=' + productId)
            .then(response => response.json())
            .then(data => {
                // Populate sizes dropdown
                if (data.sizes.length > 0) {
                    data.sizes.forEach(size => {
                        sizeSelect.innerHTML += `<option value="${size.sizeID}">${size.sizeName}</option>`;
                    });
                    sizeSelect.disabled = false; // Enable size dropdown
                }

                // Populate colors dropdown
                if (data.colors.length > 0) {
                    data.colors.forEach(color => {
                        colorSelect.innerHTML += `<option value="${color.colorID}">${color.colorName}</option>`;
                    });
                    colorSelect.disabled = false; // Enable color dropdown
                }
            })
            .catch(error => console.error('Error fetching sizes and colors:', error));
    }
});

document.getElementById('size').addEventListener('change', function() {
    const productId = document.getElementById('product').value;
    const sizeId = this.value;
    const colorSelect = document.getElementById('color');

    // Clear the color dropdown before fetching new colors based on the selected size
    colorSelect.innerHTML = '<option value="">Please select color</option>';

    // Disable the color dropdown initially
    colorSelect.disabled = true;

    if (sizeId) {
        // Fetch available colors based on the selected size
        fetch('fetch_options.php?productID=' + productId + '&sizeID=' + sizeId)
            .then(response => response.json())
            .then(data => {
                // Populate colors dropdown with only the colors available for the selected size
                if (data.colors.length > 0) {
                    data.colors.forEach(color => {
                        colorSelect.innerHTML += `<option value="${color.colorID}">${color.colorName}</option>`;
                    });
                    colorSelect.disabled = false; // Enable color dropdown
                }
            })
            .catch(error => console.error('Error fetching colors for the selected size:', error));
    }
});



</script>
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


</body>

</html>