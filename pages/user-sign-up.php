<?php  
include('connect.php');


if(isset($_POST['btnSave'])) 
{
	$txtCustomerName=$_POST['txtCustomerName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
  $txtConfirmPassword=$_POST['txtConfirmPassword'];
	$txtPhone=$_POST['txtPhone'];
	$cboGender=$_POST['cboGender'];
  $txtDateOfBirth=$_POST['txtDateOfBirth'];
	
  if ($txtPassword !== $txtConfirmPassword) {
    echo "<script>window.alert('Password and Confirm Password are not the same.')</script>";
    echo "<script>window.location='user-sign-up.php'</script>";
    exit();
}
  // Password validation
  if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/', $txtPassword)) {
    echo "<script>window.alert('Password must be 8-20 characters long and include at least one uppercase letter, one lowercase letter, and one special character.')</script>";
    echo "<script>window.location='user-sign-up.php'</script>";
    exit();
}

	//image upload ----------
	$Image=$_FILES ['fileCustomerImage']['name'];
	$Folder="../images/CustomerImage";
	$FileName=$Folder. '_'. $Image;
	$copy=copy($_FILES['fileCustomerImage']['tmp_name'],$FileName);
	if (!$copy)
	{
		echo "<p>Cannot Upload</p>";
		exit();
	}

	$query="SELECT email from customer
			where email='$txtEmail'";
	$ret=mysqli_query($connect,$query);
	$count=mysqli_num_rows($ret);
	if ($count>0)
	{
		echo "<script>window.alert('Email Already Exist')</script>";
		echo "<script>window.location='user-sign-in.php'</script>";

	}
	else
	{
		
		$query="INSERT INTO customer
				(customerName, email, phoneNumber, dateOfBirth, gender, password, image) 
				VALUES
				('$txtCustomerName','$txtEmail','$txtPhone','$txtDateOfBirth', '$cboGender', '$txtPassword','$FileName')";

		$result=mysqli_query($connect,$query);

		if($result) //Check Condition True 
		{
			echo "<script>window.alert('Customer Registration Completed.')</script>";
			echo "<script>window.location='user-sign-in.php'</script>";
		}
		else
		{
			echo "<p>Error in Staff Entry : " . mysqli_error($connect) . "</p>";
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
  <title>Customer Enrty</title>
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

<body class="">

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../images/signupimage.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                </div>
                <div class="card-body">
                  <form action="user-sign-up.php" method="post" enctype="multipart/form-data">
                  <label class="form-label font-weight-bolder mb-0">Name :</label>
                    <div class="input-group input-group-outline mb-3">
                    <input type="text" name="txtCustomerName" class="form-control" placeholder="Enter Your Name" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Email :</label>
                    <div class="input-group input-group-outline mb-3">
                    <input type="email" name="txtEmail" class="form-control" placeholder="Enter Your Email" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Phone Number:</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="number" name="txtPhone" class="form-control" placeholder="Enter Your Phone Number" required>
                    </div> 

                    <label class="form-label font-weight-bolder mb-0">Date Of Birth:</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="date" name="txtDateOfBirth" class="form-control" placeholder="Date Of Birth" required>
                    </div>
                    
                    <label class="form-label font-weight-bolder mb-0">Gender:</label>
                    <div class="input-group input-group-outline mb-3">
                      
                      <select type="combobox" name="cboGender" class="form-control" required>
                        <option></option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Password:</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="txtPassword" class="form-control" placeholder="Password" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Confirm Password:</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="txtConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                    </div>

                    <label class="form-label font-weight-bolder mb-0">Choose Your Profile Picture:</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="file" name="fileCustomerImage" class="form-control" required>
                    </div>
                    
                    <div class="text-center">
                      <input type="submit" name="btnSave" value="SignUp" class="btn btn-lg  btn-lg w-100 mt-4 mb-0" style="background-color: #FFBD61; color: black;">  
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="../pages/user-sign-in.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
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