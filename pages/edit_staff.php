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
    $txtstaffID = $_POST['txtstaffID'];
	$txtstaffName = $_POST['txtstaffName'];
    $txtstaffEmail = $_POST['txtstaffEmail'];
    $txtstaffPhone = $_POST['txtstaffPhone'];
    $txtpassword = $_POST['txtpassword'];
    $txtrole = $_POST['txtstaffRole'];
    $txtaddress = $_POST['txtaddress'];

     // Password validation
     if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/', $txtpassword)) {
        echo "<script>window.alert('Password must be 8-20 characters long and include at least one uppercase letter, one lowercase letter, and one special character.')</script>";
        echo "<script>window.location='sign-up.php'</script>";
        exit();
    }
    $folder = "../images/ProductImage/";

    if ($_FILES['photo1']['name']) {
        $filePhoto1 = $_FILES['photo1']['name'];
        $fileName1 = $folder . $filePhoto1;
        $copy1 = copy($_FILES['photo1']['tmp_name'], $fileName1);

        if (!$copy1) {
            echo "<p>Image cannot upload</p>";
            exit();
        }
    } else {

        $fileName1 = $_POST['existingPhoto1'];
    }


	$UpdateStaff="update staff set staffName = '$txtstaffName', email = '$txtstaffEmail', address = '$txtaddress', phoneNumber = '$txtstaffPhone', role = '$txtrole',password = '$txtpassword', image='$fileName1'  where staffID = '$txtstaffID'";

	$result = mysqli_query($connect,$UpdateStaff);

	if ($result) {
		// code...
		echo"<script>window.alert('Staff Data Successfully Update!')</script>";
		echo"<script>window.location='sign-up.php'</script>";

	}else{
		echo"<script>window.alert('Unsuccessfully Update!')</script>";
		echo"<script>window.location='sign-up.php'</script>";
	}	
}

$staffID=$_GET['id'];

$query="select * from staff where staffID = $staffID";

$result=mysqli_query($connect,$query);

$arr=mysqli_fetch_array($result);

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
          <a class="nav-link text-white active bg-gradient-warning" href="../pages/sign-up.php">
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
            <form action="edit_staff.php" method="POST" enctype="multipart/form-data">
        <div class="card-header pb-0 px-3" style="padding-top: 0px;">
              <h6 class="mb-0" style="padding-bottom: 15px">Staff Update</h6>
            </div>
        <div class="input-group input-group-outline mb-3">
                <label>Staff Name :</label>
                <div class="input-group input-group-outline mb-3">   
                    <input type="text" name="txtstaffName" class="form-control" value="<?php echo $arr['staffName']?>" style="background-color:white;" required>
                </div>

                <label>Email :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtstaffEmail" class="form-control" value="<?php echo $arr['email']?>" style="background-color:white;">
                </div>

                <label>Phone Number :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtstaffPhone" class="form-control" value="<?php echo $arr['phoneNumber']?>" style="background-color:white;">
                </div>

                
                <label>Choose Staff Role :</label>
                <div class="input-group input-group-outline mb-3">
                    <br>
                    
                    <select name="txtstaffRole" class="form-control">
                        <option value="Website Admin" <?php echo ($arr['role'] === 'Website Admin') ? 'selected' : ''; ?>>Website Admin</option>
                        <option value="Sale Staff" <?php echo ($arr['role'] === 'Sale Staff') ? 'selected' : ''; ?>>Sale Staff</option>
                        <option value="Digital Marketing Staff" <?php echo ($arr['role'] === 'Digital Marketing Staff') ? 'selected' : ''; ?>>Digital Marketing Staff</option>
                    </select>
                </div>
                            
                <label>Password :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtpassword"class="form-control" value="<?php echo $arr['password']?>" style="background-color:white;" required>
                </div>

                <div class="input-group input-group-outline mb-3">
                    <label> Image :</label>
                    <input type="file" name="photo1" accept="images/*" onchange="loadFile1(event)">
                <input type="hidden" name="existingPhoto1" value="<?php echo $arr['image'] ?>">
                <br>
                <p><img id="output1" style="width: 120px; height:100px;" src="<?php echo $arr['image'] ?>"/></p>
                <script>
                    var loadFile1 = function(event) {
                        var image = document.getElementById('output1');
                        image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                </div> 
                
                <label>Address :</label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtaddress"class="form-control" value="<?php echo $arr['address']?>" style="background-color:white;" required>
                </div>
                <input type="hidden" name="txtstaffID" value="<?php echo $arr['staffID']?>">
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