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



if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType == 1) 
	{
		$lstProductID=$_POST['lstProductID'];

		$query="SELECT po.*, s.supplierID,s.supplierName 
				FROM purchase po, supplier s
				WHERE po.purchaseID='$lstProductID'
				AND po.supplierID=s.supplierID
				ORDER BY po.purchaseID DESC"; 
		$result=mysqli_query($connect,$query);
		$count=mysqli_num_rows($result);

     // Calculate the total amount
    $totalQuery = "SELECT SUM(po.totalAmount) AS totalAmount 
    FROM purchase po 
    WHERE po.purchaseID='$lstProductID'";
    $totalResult = mysqli_query($connect, $totalQuery);
    $row = mysqli_fetch_assoc($totalResult);
    $totalAmount = $row['totalAmount'] ?? 0;
  }
	elseif($rdoSearchType == 2) 
	{
		$txtFrom=date('Y-m-d',strtotime($_POST['txtFrom']));
		$txtTo=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="SELECT po.*, s.supplierID,s.supplierName 
				FROM purchase po, supplier s
				WHERE po.purchaseDate BETWEEN '$txtFrom' AND '$txtTo'
				AND po.supplierID=s.supplierID
				ORDER BY po.purchaseID DESC"; 
		$result=mysqli_query($connect,$query);
		$count=mysqli_num_rows($result);
    // Calculate the total amount
    $totalQuery = "SELECT SUM(po.totalAmount) AS totalAmount 
    FROM purchase po 
    WHERE po.purchaseDate BETWEEN '$txtFrom' AND '$txtTo'";
    $totalResult = mysqli_query($connect, $totalQuery);
    $row = mysqli_fetch_assoc($totalResult);
    $totalAmount = $row['totalAmount'] ?? 0;
	}
	else
	{
		$cboStatus=$_POST['cboStatus'];

		$query="SELECT po.*, s.supplierID,s.supplierName 
				FROM purchase po, supplier s
				WHERE po.status='$cboStatus'
				AND po.supplierID=s.supplierID
				ORDER BY po.purchaseID DESC"; 
		$result=mysqli_query($connect,$query);
		$count=mysqli_num_rows($result);
     // Calculate the total amount
    $totalQuery = "SELECT SUM(po.totalAmount) AS totalAmount 
    FROM purchase po 
    WHERE po.status='$cboStatus'";
    $totalResult = mysqli_query($connect, $totalQuery);
    $row = mysqli_fetch_assoc($totalResult);
    $totalAmount = $row['totalAmount'] ?? 0;
	}

}		
else if(isset($_POST['btnShowAll'])) 
{
	$query="SELECT po.*, s.supplierID,s.supplierName 
			FROM purchase po, supplier s
			WHERE po.supplierID=s.supplierID
			ORDER BY po.purchaseID DESC"; 
	$result=mysqli_query($connect,$query);
	$count=mysqli_num_rows($result);
  // Calculate the total amount
  $totalQuery = "SELECT SUM(po.totalAmount) AS totalAmount 
  FROM purchase po";
  $totalResult = mysqli_query($connect, $totalQuery);
  $row = mysqli_fetch_assoc($totalResult);
  $totalAmount = $row['totalAmount'] ?? 0;

}
else
{
	$TodayDate=date('Y-m-d');

	$query="SELECT po.*, s.supplierID,s.supplierName 
			FROM purchase po, supplier s
			WHERE po.purchaseDate='$TodayDate'
			AND po.supplierID=s.supplierID
			ORDER BY po.purchaseID DESC"; 
	$result=mysqli_query($connect,$query);
	$count=mysqli_num_rows($result);
   // Calculate the total amount
   $totalQuery = "SELECT SUM(po.totalAmount) AS totalAmount 
   FROM purchase po 
   WHERE po.purchaseDate='$TodayDate'";
$totalResult = mysqli_query($connect, $totalQuery);
$row = mysqli_fetch_assoc($totalResult);
$totalAmount = $row['totalAmount'] ?? 0;
	
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
          <a class="nav-link text-white" href="../pages/Purchase_Order.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Purchase Order</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-warning " href="../pages/Purchase_Order.php">
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
          <a class='nav-link text-white' href='../pages/sign-up.php'>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Purchase Order List</li>
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
          <!-- <h6 class="font-weight-bolder mb-0">Manage Purchase</h6> -->
        </nav>

  
    </nav>
    <!-- End Navbar -->

        <form action="Purchase_Order_List.php" method="post">
            <fieldset>
            <legend class="text-dark">Search Option :</legend>
            <table cellpadding="5px">
            <tr>
            	<td class="input-group input-group-outline mb-3 text-dark" >
            	<input type="radio" name="rdoSearchType" value="1" checked/>Search By PO_ID

            	<input list="lstProductID" type="text" class="form-control" name="lstProductID" style="border: 1px solid gray; margin-left: 10px; background-color:white;">
            		<datalist id="lstProductID">
            		<?php  
            		$POquery="SELECT * FROM Purchase";
            		$ret=mysqli_query($connect,$POquery);
            		$POcount=mysqli_num_rows($ret);

            		for($z=0;$z<$POcount;$z++) 
            		{ 
            			$POrow=mysqli_fetch_array($ret);
            			$Purchase_ID=$POrow['purchaseID'];
            			echo "<option value='$Purchase_ID'>";
            		}
            		?>
            		</datalist>
            	</td>
            	<td class="input-group input-group-outline mb-3 text-dark" style="display:flex; align-item:center;">
            		<input type="radio" name="rdoSearchType" value="2"/>Search By Date
            		<br/>
            		<b style="margin-left: 20px;">From :</b>
            		<input type="text" class="form-control" name="txtFrom" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" style="border: 1px solid gray; margin-left: 10px; background-color:white;"/>
            		<b style="margin-left: 20px;">To :</b>
            		<input type="text" class="form-control" name="txtTo" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" style="border: 1px solid gray; margin-left: 10px;  background-color:white;"/>
            	</td>
            	<td class="input-group input-group-outline mb-3 text-dark">
            		<input type="radio" name="rdoSearchType" value="3"/>Search By Status
            		<br/>
            		<select name="cboStatus" style="margin-left: 20px;">
            			<option>Pending</option>
            			<option>Confirmed</option>
            		</select>
            	</td>
            	
            </tr>

            <td class="input-group input-group-outline mb-3 text-dark">
            	<input type="submit" name="btnSearch" value="Search" class="btn" style="background-color: #FFBD61; color: black; margin:10px;"/>
            	<input type="submit" name="btnShowAll" value="Show All" class="btn" style="background-color: #FFBD61; color: black; margin:10px; border-radius:4px;"/>
            	<input type="reset" value="Clear" class="btn" style="background-color: #FFBD61; color: black; margin:10px; border-radius: 4px;;"/>
            	</td>
            </table>
            </fieldset>
                
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
            <legend>Search Result :</legend>
            <?php  
            if($count<1) 
            {
            	echo "<p>No Purchase Order Found.</p>";
            }
            else
            {
            ?>
            	<table class="table align-items-center mb-0">
            	<tr>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PurchaseOrder_ID</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Supplier_Name</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Amount</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">GrandTotal</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            		<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">~</th>
            	</tr>
            	<?php 
            	for ($i=0;$i<$count;$i++) 
            	{ 
            		$row=mysqli_fetch_array($result);
            		$Purchase_ID=$row['purchaseID'];
                
            		echo "<tr>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>$Purchase_ID</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['purchaseDate'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['supplierName'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['subTotal'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['totalAmount'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'>" . $row['status'] . "</td>";
            		echo "<td class='text-xs font-weight-bold mb-0 align-middle text-center text-sm'><a href='Purchase_Order_Detail.php?purchaseID=$Purchase_ID'>Details</a></td>";
            		echo "</tr>";
            	}			
            	 ?>
            	</table>
              <p><strong>Total Amount:</strong> <?php echo number_format($totalAmount, 2); ?></p>
            <?php
            }
            ?>
            </div>
            </div>

        </form>

    <!-- <form action="Purchase_Order_List.php" method="POST">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            <input type="text" name="txtSearch" placeholder="Type here..." class="form-control" style="background-color: white;">
            <button type="submit" name="search-info" style="border: none; font-size:10px; padding-left: 10px;"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>

        
          <div class="input-group input-group-outline">
          <b>From  :</b>
		    <input type="text" name="txtFrom" class="form-control" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly/>
	    </div>
            
            <div class="input-group input-group-outline">
            <b>To  :</b>
		    <input type="text" name="txtTo" class="form-control" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly/>
	        </div>
            
          </div>
          </form> -->
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
</body>

</html>