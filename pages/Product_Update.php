<?php
session_start();
include("connect.php");

if(!isset($_SESSION['staffID']))
    {
        echo "<script>window.alert('Please Login.')</script>";
        echo "<script>window.location='sign-in.php'</script>";
    }

            $sName= $_SESSION['staffName'];



//Data Update
if (isset($_POST['btnUpdate'])) {
    $txtproductID = $_POST['txtproductID'];
	$txtproductName = $_POST['txtproductName'];
    // $txtproductPrice = $_POST['txtproductPrice'];
    // $txtproductQuantity = $_POST['txtproductQuantity'];
    $txtproductDescription = $_POST['txtproductDescription'];
    $txtbrandID = $_POST['txtbrandID'];
    $txtcategoryID= $_POST['txtcategoryID'];
    // $folder = "../images/ProductImage/";

    // if ($_FILES['photo1']['name']) {
    //     $filePhoto1 = $_FILES['photo1']['name'];
    //     $fileName1 = $folder . $filePhoto1;
    //     $copy1 = copy($_FILES['photo1']['tmp_name'], $fileName1);

    //     if (!$copy1) {
    //         echo "<p>Image cannot upload</p>";
    //         exit();
    //     }
    // } else {

    //     $fileName1 = $_POST['existingPhoto1'];
    // }

    // if ($_FILES['photo2']['name']) {
    //     $filePhoto2 = $_FILES['photo2']['name'];
    //     $fileName2 = $folder . $filePhoto2;
    //     $copy2 = copy($_FILES['photo2']['tmp_name'], $fileName2);

    //     if (!$copy2) {
    //         echo "<p>Image cannot upload</p>";
    //         exit();
    //     }
    // } else {

    //     $fileName2 = $_POST['existingPhoto2'];
    // }


    // if ($_FILES['image_3']['name']) {
    //     $filePhoto3 = $_FILES['image_3']['name'];
    //     $fileName3 = $folder . $filePhoto3;
    //     $copy3 = copy($_FILES['image_3']['tmp_name'], $fileName3);

    //     if (!$copy3) {
    //         echo "<p>Image cannot upload</p>";
    //         exit();
    //     }
    // } else {

    //     $fileName3 = $_POST['existingPhoto3'];
    // }

	$UpdateProduct="update product set productName = '$txtproductName', description = '$txtproductDescription', brandID = '$txtbrandID', categoryID = '$txtcategoryID'  where productID = '$txtproductID'";

	$result = mysqli_query($connect,$UpdateProduct);

	if ($result) {
		// code...
		echo"<script>window.alert('Product Data Successfully Update!')</script>";
		echo"<script>window.location='Product_Entry.php'</script>";

	}else{
		echo"<script>window.alert('Unsuccessfully Update!')</script>";
		echo"<script>window.location='Product_Entry.php'</script>";
	}	
}

$productID=$_GET['productID'];

$query="select * from product where productID = $productID";

$result=mysqli_query($connect,$query);

$arr=mysqli_fetch_array($result);
$brandID = $arr['brandID'];
$categoryID = $arr['categoryID'];
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
    Brand
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
          <a class="nav-link text-white " href="../pages/Category_Entry.php">
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
          <a class="nav-link text-white active bg-gradient-warning" href="../pages/Product_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Product</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/Product_Detail.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Product Details</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/Purchase_Order.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Purchase Product</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Product</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Manage Product</h6>
        </nav>
        

          
           
       
             

          
        
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="col-md-5">
            <form action="Product_Update.php" method="POST" enctype="multipart/form-data">
        <div class="card-header pb-0 px-3" style="padding-top: 0px;">
              <h6 class="mb-0" style="padding-bottom: 15px">Product Update</h6>
            </div>
        <div class="input-group input-group-outline mb-3">
                <label>Product Name :</label>
                <div class="input-group input-group-outline mb-3">   
                    <input type="text" name="txtproductName" class="form-control" value="<?php echo $arr['productName']?>" style="background-color:white;" required>
                </div>

                <!-- <label>Product Price :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtproductPrice" class="form-control" value="<?php echo $arr['productPrice']?>" style="background-color:white;">
                </div> -->

                <!-- <label>Product Quantity :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtproductQuantity" class="form-control" value="<?php echo $arr['productQuantity']?>" style="background-color:white;"> 
                </div> -->

                <label>Description :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtproductDescription"class="form-control" value="<?php echo $arr['description']?>" style="background-color:white;" required>
                </div>
                
                <!-- <div class="input-group input-group-outline mb-3">
                    <label>Product Image1 :</label>
                    <input type="file" name="photo1" accept="images/*" onchange="loadFile1(event)">
                <input type="hidden" name="existingPhoto1" value="<?php echo $arr['image_1'] ?>">
                <br>
                <p><img id="output1" style="width: 120px; height:100px;" src="<?php echo $arr['image_1'] ?>"/></p>
                <script>
                    var loadFile1 = function(event) {
                        var image = document.getElementById('output1');
                        image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                </div> -->
                
                <!-- <div class="input-group input-group-outline mb-3">
                    <label>Product Image2 :</label>
                    <input type="file" name="photo2" accept="images/*" onchange="loadFile2(event)">
                    <br>
                <input type="hidden" name="existingPhoto2" value="<?php echo $arr['image_2'] ?>">
                <p><img id="output2" style="width: 120px; height:100px;" src="<?php echo $arr['image_2'] ?>"/></p>
                <script>
                    var loadFile2 = function(event) {
                        var image = document.getElementById('output2');
                        image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                </div> -->
                
                <!-- <div class="input-group input-group-outline mb-3">
                    <label>Product Image3</label>
                    <input type="file" name="photo2" accept="images/*" onchange="loadFile2(event)">
                <input type="hidden" name="existingPhoto3" value="<?php echo $arr['image_3'] ?>">
                <p><img id="output3" src="<?php echo $arr['image_3'] ?>"/></p>
                <script>
                    var loadFile2 = function(event) {
                        var image = document.getElementById('output3');
                        image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                </div> -->
                <label>Choose Brand :</label>
                <div class="input-group input-group-outline mb-3">
                    <br>
                    <?php

                    $show = "select * from brand where brandID = $brandID";
                    $bData = mysqli_query($connect, $show);
                    $bresult = mysqli_fetch_array($bData);
                    $bName = $bresult['brandName'];
                    ?>
                    <select name="txtbrandID" class="form-control">
                        <option value="<?php echo $arr['brandID']?>"><?php echo $bName; ?></option>
                        <?php

                        $brandquery = "select * from brand";
                        $result = mysqli_query($connect, $brandquery);
                        $count = mysqli_num_rows($result);

                        for ($i = 0; $i < $count; $i++) {
                        $arr1 = mysqli_fetch_array($result);
                        $bName = $arr1['brandName'];
                        $bId = $arr1['brandID'];
                        echo "<option value='$bId'>$bName</option>";
                    }
                    ?>
                    </select>
                </div>
                            
                <label>Choose Category : </label>
                <div class="input-group input-group-outline mb-3">
                    
                    
                    <?php

                    $show = "select * from category where categoryID = $categoryID";
                    $cData = mysqli_query($connect, $show);
                    $cresult = mysqli_fetch_array($cData);
                    $cName = $cresult['categoryName'];
                    ?>
                    
                    <select name="txtcategoryID" class="form-control">
                        <option value="<?php echo $arr['categoryID']?>"><?php echo $cName; ?></option>
                        <?php

                        $brandquery = "select * from category";
                        $result = mysqli_query($connect, $brandquery);
                        $count = mysqli_num_rows($result);

                        for ($i = 0; $i < $count; $i++) {
                        $arr1 = mysqli_fetch_array($result);
                        $cName = $arr1['categoryName'];
                        $cId = $arr1['categoryID'];
                        echo "<option value='$cId'>$cName</option>";
                    }
                    ?>
                    </select>
                </div> 

                <input type="hidden" name="txtproductID" value="<?php echo $arr['productID']?>">
                  </div>
                  
                  <div class="text-center">
                    <input type="submit" name="btnUpdate" value="Update" class="btn w-100 mb-2" style="background-color: #FFBD61; color: black;">  
                    
                  </div>
            </form>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>