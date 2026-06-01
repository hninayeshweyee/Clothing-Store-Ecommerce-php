<?php 
session_start();
include('connect.php');

if(isset($_POST['btnSave']))
{
    $txtcolorName=$_POST['txtcolorName'];

$fileproductImage1=$_FILES['txtcolorImage']['name'];
$folder="../images/ColorImage/";
$FileName1=$folder. '_' . $fileproductImage1;
$copy=copy($_FILES['txtcolorImage']['tmp_name'],$FileName1);
if(!$copy)
{
  echo "<p>Cannot Copy Image</p>";
  exit();
}

else
{
  $query = "INSERT INTO color (colorName, image) VALUES ('$txtcolorName', '$FileName1')";

  if (mysqli_query($connect, $query)) {
      echo "<script>window.alert('Color Entry Successful');</script>";
      echo "<script>window.location='Color_Entry.php';</script>";
  } else {
      echo "<script>window.alert('Error In Color Entry');</script>";
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" colors="76x76" href="../assets/img/apple-icon.png">
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

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../images/Wint_Logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white" style="font-color: 20px; padding-left: 0px;">W.I.N.T</span>
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
          <a class="nav-link text-white" href="../pages/Size_Entry.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Manage Size</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-warning" href="../pages/Color_Entry.php">
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
          <a class="nav-link text-white " href="../pages/Product_Entry.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Color</li>
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
          <h6 class="font-weight-bolder mb-0">Manage Color</h6>
        </nav>
        <form action="Color_Entry.php" method="POST">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            <input type="text" name="txtSearch" placeholder="Type here..." class="form-control" style="background-color: white;">
            <button type="submit" name="search-info" style="border: none; font-color:10px; padding-left: 10px;"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
            
          </div>
          </form>

          
           
       
             

          
        
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
 
      <div class="row">
      <div class="col-md-4">
            <form action="Color_Entry.php" method="POST" enctype="multipart/form-data">
        <div class="card-header pb-0 px-3">
              <h6 class="mb-0" style="padding-bottom: 15px">Color Entry</h6>
            </div>
        <div class="input-group input-group-outline mb-3">
            
                <input type="text" name="txtcolorName" class="form-control" placeholder="Enter your Color Name" style="background-color:white;" required>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label>Image</label>
                    <input type="file" name="txtcolorImage" required>
                </div>
                  
                  <div class="text-center">
                    <input type="submit" name="btnSave" value="Save" class="btn" style="background-color: #FFBD61; color: black; display:flex; justify-context:center; padding: 10px 50px;">  
                    
                  </div>
            </form>
        </div>
        



        
        </div>
        <div class="col-md-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Color Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">

              <?php
                    

                    if (isset($_POST['search-info'])) {
                      $name = $_POST['txtSearch'];
                      $cquery = "select * from color where colorName like '%$name%'";
                      $cresult = mysqli_query($connect, $cquery);
                      $crow = mysqli_num_rows($cresult);
          
                      if ($crow == 0) {
                          echo "<p>There is no information!</p>";
                      } else {
                          for ($i = 0; $i < $crow; $i++) {
                              $carr = mysqli_fetch_array($cresult);
          
                              $colorID = $carr['colorID'];
                              $colorName = $carr['colorName'];
                              $colorImage = $carr['image'];
                           
                              echo"<li class='list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg'>  
                              <div class='d-flex flex-column' style='display: flex; justify-content: center; align-items: center;'>
                              <span class='text-dark font-weight-bold ms-sm-2'>$colorName</span>
                              
                                <div style='width: 60px; height: 60px; overflow: hidden;'>
                                    <img src='$colorImage'  style='width: 100%; height: 100%; object-fit: cover;'>
                                </div>
                                
                            </div>
                            <div class='ms-auto text-end'>
                    <a class='btn btn-link text-danger text-gradient px-3 mb-0' href='Color_Delete.php?colorID=$colorID'><i class='material-icons text-sm me-2'>delete</i>Delete</a>
                    <a class='btn btn-link text-dark px-3 mb-0' href='Color_Update.php?colorID=$colorID'><i class='material-icons text-sm me-2'>edit</i>Edit</a>
                  </div>
                            
                          </li>
                                 ";
                             
                         
                              }
                         } 
                      }
                  
                  else {
                      $dquery = "select * from color order by colorID DESC";
                      $dresult = mysqli_query($connect, $dquery);
                      $count = mysqli_num_rows($dresult);
          
                      if ($count == 0) {
                          echo "<div class='no-information'><p>There is no information!</p></div>";
                      } else {
                          for ($i = 0; $i < $count; $i++) {
          
                              $darr = mysqli_fetch_array($dresult);
                              $colorID = $darr['colorID'];
                              $colorName = $darr['colorName'];
                              $colorImage = $darr['image'];
                             
                              
                              echo"<li class='list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg'>  
                              <div class='d-flex flex-column' style='display: flex; justify-content: center; align-items: center;'>
                              <span class='text-dark font-weight-bold ms-sm-2'>$colorName</span>
                               <div style='width: 60px; height: 60px; overflow: hidden;'>
                                    <img src='$colorImage'  style='width: 100%; height: 100%; object-fit: cover;'>
                                </div>
                            </div>
                            <div class='ms-auto text-end'>
                    <a class='btn btn-link text-danger text-gradient px-3 mb-0' href='color_Delete.php?colorID=$colorID'><i class='material-icons text-sm me-2'>delete</i>Delete</a>
                    <a class='btn btn-link text-dark px-3 mb-0' href='Color_Update.php?colorID=$colorID'><i class='material-icons text-sm me-2'>edit</i>Edit</a>
                  </div>
                            
                          </li>
                                 ";
                      
                          }
                      }
                  }
                ?>
              </ul>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>