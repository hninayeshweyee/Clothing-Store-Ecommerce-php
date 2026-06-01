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


			
if(isset($_POST['btnConfirm'])) 
{
	$txtPurchaseID=$_POST['txtPurchaseID'];

	$query=mysqli_query($connect, "SELECT * FROM order_detail WHERE orderID='$txtPurchaseID'");

	while($row=mysqli_fetch_array($query)) 
	{
		$Product_ID=$row['variationID'];
		$Quantity=$row['quantity'];

		$UpdateQty="UPDATE product_variations
					SET productQuantity= productQuantity + '$Quantity'
					WHERE variationID='$Product_ID'
					";
		$ret=mysqli_query($connect,$UpdateQty);
	}

	$UpdateStatus="UPDATE orders
				   SET Status='Confirmed'
				   WHERE orderID='$txtPurchaseID'";
	$ret=mysqli_query($connect,$UpdateStatus);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Customer Order Successfully Confirmed.')</script>";
		echo "<script>window.location='Order_List.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Order Details" . mysqli_error($connection) . "</p>";
	}


}

$Purchase_ID = "";
if (isset($_GET['orderID'])) {
    $Purchase_ID = $_GET['orderID'];

    // Get the order details
    $query1 = "SELECT p.*, sup.customerID, sup.customerName
               FROM orders p
               JOIN customer sup ON p.customerID = sup.customerID
               WHERE p.orderID = '$Purchase_ID'";

    $result1 = mysqli_query($connect, $query1);
    $row1 = mysqli_fetch_array($result1);

    if (!$row1) {
        echo "<script>window.alert('ERROR: Order Not Found.')</script>";
        echo "<script>window.location='Order_List.php'</script>";
        exit;
    }

    // Get the order items details
    $query2 = "
        SELECT 
            po.orderDate, 
            pod.purchasePrice, 
            pod.quantity,
            v.variationID,
            p.productName, 
            s.sizeName,
            c.colorName,
            b.brandName
        FROM 
            order_detail pod
        INNER JOIN 
            orders po ON pod.orderID = po.orderID
        INNER JOIN 
            product_variations v ON pod.variationID = v.variationID
        INNER JOIN 
            product p ON v.productID = p.productID
        INNER JOIN 
            size s ON v.sizeID = s.sizeID
        INNER JOIN 
            color c ON v.colorID = c.colorID
        INNER JOIN 
            brand b ON p.brandID = b.brandID
        WHERE 
            po.orderID = '$Purchase_ID';
    ";

   //echo $query2;
	$result2=mysqli_query($connect,$query2);
	$count=mysqli_num_rows($result2);

}
else
{
	$PurchaseOrderID="";

	echo "<script>window.alert('ERROR : Purchase Order Details not Found.')</script>";
	echo "<script>window.location='Purchase_Order_List.php'</script>"; 
}


?>

<!DOCTYPE html>
<html>
<head>
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
</head>

<body class="g-sidenav-show bg-light">

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <form action="Order_Detail.php" method="POST">
      <div class="container my-4">
        <div class="d-flex align-items-center mb-4">
          <a href="../pages/Order_List.php" class="btn btn-link text-secondary">
            <i class="fa-solid fa-arrow-left-long"></i> Back
          </a>
          <h4 class="ms-3 text-dark">Order Detail Report for O_ID: <?php echo $Purchase_ID ?></h4>
        </div>

        <div class="card shadow-sm">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <p><strong>Order ID:</strong> <?php echo $Purchase_ID ?></p>
                <p><strong>Status:</strong> <?php echo $row1['status'] ?></p>
                <p><strong>Order Date:</strong> <?php echo $row1['orderDate'] ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Report Date:</strong> <?php echo date('Y-m-d') ?></p>
                <p><strong>Customer Name:</strong> <?php echo $row1['customerName'] ?></p>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Brand</th>
                    <th>Purchase Price</th>
                    <th>Quantity</th>
                    <th>Sub-Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                    for ($i=0; $i < $count ; $i++) { 
                      $row2 = mysqli_fetch_array($result2);
                      echo "<tr>";
                      echo "<td>" . $row2['variationID'] . "</td>";
                      echo "<td>" . $row2['productName'] . "</td>";
                      echo "<td>" . $row2['sizeName'] . "</td>";
                      echo "<td>" . $row2['colorName'] . "</td>";
                      echo "<td>" . ($row2['brandName'] ?? "Unknown") . "</td>";
                      echo "<td>" . $row2['purchasePrice'] . "</td>";
                      echo "<td>" . $row2['quantity'] . "</td>";
                      echo "<td>" . ($row2['purchasePrice'] * $row2['quantity']) . "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="row mt-4">
              <div class="col-md-4">
                <p><strong>Sub Total:</strong> <?php echo $row1['subTotal'] ?> MMK</p>
              </div>
              <div class="col-md-4">
                <p><strong>Tax Amount (VAT):</strong> <?php echo $row1['tax'] ?> MMK</p>
              </div>
              <div class="col-md-4">
                <p><strong>Grand Total:</strong> <?php echo $row1['totalAmount'] ?> MMK</p>
              </div>
            </div>

            <div class="mt-4">
              <input type="hidden" name="txtPurchaseID" value="<?php echo $Purchase_ID ?>" />
              <?php  
                if ($row1['status'] === "Pending") {
                  echo "<button type='submit' name='btnConfirm' class='btn btn-warning w-100' style='border-radius: 4px;'>Confirm</button>";
                } else {
                  echo "<button type='submit' name='btnConfirm' class='btn btn-warning w-100' style='border-radius: 4px;' disabled>Confirm</button>";
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Core JS Files -->
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
  </main>
</body>

</html>
	<!---Print--->
	<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
	<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
	<!---Print--->

