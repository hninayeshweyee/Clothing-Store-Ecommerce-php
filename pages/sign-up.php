<?php  
session_start();
include('connect.php');

if (isset($_POST['btnSave'])) {
    $txtStaffName = $_POST['txtStaffName'];
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];
    $txtPhone = $_POST['txtPhone'];
    $cboRole = $_POST['cboRole'];
    $txtAddress = $_POST['txtAddress'];
    $Status = "Active";

    // Password validation
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/', $txtPassword)) {
        echo "<script>window.alert('Password must be 8-20 characters long and include at least one uppercase letter, one lowercase letter, and one special character.')</script>";
        echo "<script>window.location='sign-up.php'</script>";
        exit();
    }

    // Image upload ----------
    $Image = $_FILES['fileStaffImage']['name'];
    $Folder = "../images/StaffImage";
    $FileName = $Folder . '_' . $Image;
    $copy = copy($_FILES['fileStaffImage']['tmp_name'], $FileName);
    if (!$copy) {
        echo "<p>Cannot Upload</p>";
        exit();
    }

    $query = "SELECT email FROM Staff WHERE email='$txtEmail'";
    $ret = mysqli_query($connect, $query);
    $count = mysqli_num_rows($ret);
    if ($count > 0) {
        echo "<script>window.alert('Email Already Exist')</script>";
        echo "<script>window.location='sign-in.php'</script>";
    } else {
        $query = "INSERT INTO staff
                (staffName, email, address, phoneNumber, password, role, image, status) 
                VALUES
                ('$txtStaffName','$txtEmail','$txtAddress','$txtPhone','$txtPassword','$cboRole','$FileName','$Status')";

        $result = mysqli_query($connect, $query);

        if ($result) { // Check Condition True 
            echo "<script>window.alert('Staff Registration Completed.')</script>";
            echo "<script>window.location='sign-up.php'</script>";
        } else {
            echo "<p>Error in Staff Entry: " . mysqli_error($connect) . "</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <title>Staff Enrty</title>
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
          <a class="nav-link text-white" href="../pages/Supplier_Entry.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Staff Entry</li>
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
          <h6 class="font-weight-bolder mb-0">Manage Staff</h6>
        </nav>
        <form action="Supplier_Entry.php" method="POST">
          </form>

          
           
       
             

          
        
    </nav>
    <!-- End Navbar -->

    <section>
      <div class="page-header">
        <div class="container">
          <div class="row">
            <!-- <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../images/signupimage.jpg'); background-size: cover;">
              </div>
            </div> -->
            <div class=" d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header" style="padding-bottom:0;">
                  <h4 class="font-weight-bolder">Staff Entry</h4>
                </div>
                <div class="card-body" style="background-color: white;">
                  <form role="form" action="sign-up.php" method="post" enctype="multipart/form-data">
                  <label class="form-label font-weight-bolder mb-0">Staff Name :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" name="txtStaffName" class="form-control" placeholder="Enter Your Staff Name" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Staff Email :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="email" name="txtEmail" class="form-control" placeholder="Enter Your Staff Email" required> 
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Staff Phone Number :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="number" name="txtPhone" class="form-control" placeholder="Enter Your Staff Phone Number" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Choose Staff Role:</label>
                    <div class="input-group input-group-outline mb-3">
                      
                      <select type="combobox" name="cboRole" class="form-control" required>
                        <option>Choose Role</option>
                        <option>Website Admin</option>
                        <option>Sale Staff</option>
                        <option>Digital Marketing Staff</option>
                      </select>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Password :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="txtPassword" class="form-control" placeholder="Password" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Choose Photo :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="file" name="fileStaffImage" class="form-control" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Staff Address :</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="address" name="txtAddress" class="form-control" placeholder="Address" required>
                    </div>
                    <div class="text-center">
                      <input type="submit" name="btnSave" value="Save" class="btn btn-lg  btn-lg w-100 mt-4 mb-0" style="background-color: #FFBD61; color: black;">  
                    </div>
                  </form>
                </div>

                <div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Product Details Information</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Staff Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                    $query = "SELECT * FROM staff 
                              ORDER BY staffID DESC";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Staff Image' width='50' height='50'></td>";
                            echo "<td>" . htmlspecialchars($row['staffName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                            
                            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                            
                            echo "<td>
                                <a href='edit_staff.php?id=" . $row['staffID'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_staff.php?id=" . $row['staffID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this staff?\")'>Delete</a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No staff data available.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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