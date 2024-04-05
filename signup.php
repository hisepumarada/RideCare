<?php 
session_start(); 
include "db_conn.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>RideCare: SignUp</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"><link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<style>
  
      .b-example-divider {
  height: 3rem;
  background-color: rgba(0, 0, 0, .1);
  border: solid rgba(0, 0, 0, .15);
  border-width: 1px 0;
  box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.form-control-dark {
  color: #fff;
  background-color: var(--bs-dark);
  border-color: var(--bs-gray);
}
.form-control-dark:focus {
  color: #fff;
  background-color: var(--bs-dark);
  border-color: #fff;
  box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
}

.bi {
  vertical-align: -.125em;
  fill: currentColor;
}

.text-small {
  font-size: 85%;
}

.dropdown-toggle {
  outline: 0;
}

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .logo{
    font-size: 30px;
    font-weight: 700;
    color: var(--text-color);  
}
.logo span{
    color: var(--main-color);
}
    
.row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}

.row-space {
  -webkit-box-pack: justify;
  -webkit-justify-content: space-between;
  -moz-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

.col-2 {
  width: -webkit-calc((100% - 30px) / 2);
  width: -moz-calc((100% - 30px) / 2);
  width: calc((100% - 30px) / 2);
}

@media (max-width: 767px) {
  .col-2 {
    width: 100%;
  }
}

html {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

* {
  padding: 0;
  margin: 0;
}

*, *:before, *:after {
  -webkit-box-sizing: inherit;
  -moz-box-sizing: inherit;
  box-sizing: inherit;
}
body,
h1, h2, h3, h4, h5, h6,
blockquote, p, pre,
dl, dd, ol, ul,
figure,
hr,
fieldset, legend {
  margin: 0;
  padding: 0;
}
.page-wrapper {
  min-height: 100vh;
}

body {
  font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;
  font-weight: 400;
  font-size: 14px;
}

h1, h2, h3, h4, h5, h6 {
  font-weight: 400;
}

h1 {
  font-size: 36px;
}

h2 {
  font-size: 30px;
}

h3 {
  font-size: 24px;
}

h4 {
  font-size: 18px;
}

h5 {
  font-size: 15px;
}

h6 {
  font-size: 13px;
}



.p-t-100 {
  padding-top: 100px;
}

.p-t-130 {
  padding-top: 130px;
}

.p-t-180 {
  padding-top: 180px;
}

.p-t-20 {
  padding-top: 20px;
}

.p-t-15 {
  padding-top: 15px;
}

.p-t-10 {
  padding-top: 10px;
}

.p-t-30 {
  padding-top: 30px;
}

.p-b-100 {
  padding-bottom: 100px;
}

.m-r-45 {
  margin-right: 45px;
}

.wrapper {
  margin: 0 auto;
}

.wrapper--w960 {
  max-width: 960px;
}

.wrapper--w780 {
  max-width: 780px;
}

.wrapper--w680 {
  max-width: 680px;
}


input {
  outline: none;
  margin: 0;
  border: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  width: 100%;
  font-size: 14px;
  font-family: inherit;
}

.input--style-4 {
  line-height: 50px;
  background: #fafafa;
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  padding: 0 20px;
  font-size: 16px;
  color: #666;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.input--style-4::-webkit-input-placeholder {
  /* WebKit, Blink, Edge */
  color: #666;
}

.input--style-4:-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  color: #666;
  opacity: 1;
}

.input--style-4::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  color: #666;
  opacity: 1;
}

.input--style-4:-ms-input-placeholder {
  /* Internet Explorer 10-11 */
  color: #666;
}

.input--style-4:-ms-input-placeholder {
  /* Microsoft Edge */
  color: #666;
}

.label {
  font-size: 16px;
  color: #555;
  text-transform: capitalize;
  display: block;
  margin-bottom: 5px;
}

.radio-container {
  display: inline-block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  font-size: 16px;
  color: #666;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.radio-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.radio-container input:checked ~ .checkmark {
  background-color: #e5e5e5;
}

.radio-container input:checked ~ .checkmark:after {
  display: block;
}

.radio-container .checkmark:after {
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 12px;
  height: 12px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  background: #57b846;
}

.checkmark {
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #e5e5e5;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.input-group {
  position: relative;
  margin-bottom: 22px;
}


.title {
  font-size: 24px;
  color: #525252;
  font-weight: 400;
  margin-bottom: 40px;
}

.card {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: #fff;
}

.card-4 {
  background: #fff;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
}

.card-4 .card-body {
  padding: 57px 65px;
  padding-bottom: 65px;
}

@media (max-width: 767px) {
  .card-4 .card-body {
    padding: 50px 40px;
  }
}
.modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .close-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            float: right;
        }
</style>

  </head>
  
  
<main>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-4 mb-1">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="50" role="img" aria-label="Bootstrap"><img src="css/images/ridecare-high-resolution-logo-transparent.png"  width="200" height="40" ></svg>
      </a>
      <div class="col-md-3 text-end">
        <a type="button" class="btn btn-outline-primary" href="login.php">Login</a>
      </div>
    </header>
  </div>
  
</main>

<body>
<div class="page-wrapper bg-gra-02 p-t-140 p-b-100 font-poppins" style="
    background-image: url(css/images/indian-motorbike-banner.jpg);">
  <br>
        <div class="wrapper wrapper--w680 ">
            <div class="card card-4">
                <div class="card-body fw-bold bg-dark-subtle rounded">
               <center><h1 class="fw-bold">Ride<Span style="color: red; ">Care</span></h1>
                    <h2 class="title fw-bold">Registration Form</h2></center> 
                    <form method="POST" class="form" enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label ">first name</label>
                                    <input required class="input--style-4" type="text" id="firstname" name="firstname" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input required class="input--style-4" type="text" id="lastname" name="lastname" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input required class="input--style-4" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" id="email" name="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input required class="input--style-4" pattern="^(09|\+639)\d{9}$" type="text" id="mobile" name="mobile" placeholder="Phone Number 09 or +639">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Address(City)</label>
                                    <div class="input-group-icon">
                                        <input required class="input--style-4 js-datepicker" type="text" id="address" name="address" placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-30">Male
                                            <input type="radio" checked="checked" name="gender"  value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container m-r-30">Female
                                            <input type="radio" name="gender"  value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container m-r-30">Others
                                            <input type="radio" name="gender"  value="other">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input required class="input--style-4" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password"
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input required class="input--style-4" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Check Password" 
    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" id="password2" name="password2">
                                </div>
                            </div>
                        </div>
                        <div class="input">
            <label class="terms">
                <input class="terms" type="checkbox" required id="acceptTerms" name="acceptTerms">
            </label> <button onclick="openDialog()">I accept the Terms and Conditions</button>
        </div>
                        <div class="p-t-15">
                            <button class="btn btn-primary fs-5" name="submit" id="submit" type="submit">Sign Up</button>
                            <a href="index.php" class="ml-auto p-2 fs-7">Already has account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <br><br>
   
   
    

<?php
if (isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['email']) && isset($_POST['password2'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$password2 = validate($_POST['password2']);
	$firstname = validate($_POST['firstname']);
	$lastname = validate($_POST['lastname']);
  $address = validate($_POST['address']);
	$mobile = validate($_POST['mobile']);
	$gender = validate($_POST['gender']);
	
    
  $password = md5($password);
  
	// hashing the password

    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
       ?>
            <script>
            swal({
             title: "The Email is Already Taken",
             text: "Input Other Email",
             icon: "warning",
             button: "Okay",
           });
           </script>  
   <?php
   }else{
    if ($password != md5($_POST['password2'])) {
       ?>
       <script>
       swal({
        title: "Password is not Matched",
        text: "",
        icon: "warning",
        button: "Okay",
      });
      </script>  
   <?php
      }elseif($image_size > 2000000){
        ?>
        <script>
        swal({
         title: "Image is too large!",
         text: "",
         icon: "warning",
         button: "Okay",
       });
       </script>  
    <?php      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user`(email, password,  firstname, lastname, address, mobile, gender, image) 
         VALUES('$email', '$password', '$firstname','$lastname', '$address',  '$mobile', '$gender', '$image')") or die('query failed');
         if($insert){ 
            move_uploaded_file($image_tmp_name, $image_folder);?>
            <script>
            swal({
             title: "Registration is Success",
             text: "Welcome to RideCare!",
             icon: "success",
             button: "Okay!",
           }).then(function() {
    window.location = "index.php";
});
           </script>   
           
   <?php
         }else{?>
           <script>
   
           swal({
            title: "Failed",
            text: "Data not insertd",
            icon: "error",
            });

           </script>
   
   <?php          }{
   header("Location: index.php");
   exit();
   }
   
   }}
}
 

?>
<?php include"inc/footer.php";?>
</body>
</html>
<div class="modal" id="termsModal">
        <div class="modal-content">
        
        <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br> <br><br><br><br><br><br><br><br><br>
                   <h2>Welcome to RideCare! </h2>
                   <small>Before using our services, please carefully read and understand the following terms and conditions. By accessing or using RideCare, 
                    you agree to be bound by these terms. If you do not agree with any part of these terms, you may not use our services.</small>
                    <h2>1. Booking Maintenance Services</h2>

<p><strong>1.1 Eligibility:</strong> To use RideCare services, you must be at least 18 years old and possess the legal authority to enter into agreements.</p>

<p><strong>1.2 Service Booking:</strong> Users can book motorcycle maintenance services through our platform. By booking a service, you agree to provide accurate and up-to-date information.</p>

<p><strong>1.3 Service Confirmation:</strong> RideCare will confirm the booking details, including date, time, and location. Users are responsible for ensuring the accuracy of these details.</p>

<h2>2. Payments and Refunds</h2>

<p><strong>2.1 Payment:</strong> Users agree to pay the specified service fees as communicated during the booking process.</p>

<p><strong>2.2 Cancellation:</strong> Cancellation policies will be clearly communicated during the booking process. Users may be subject to cancellation fees.</p>

<p><strong>2.3 Refunds:</strong> Refund policies will be outlined during the booking process. Refunds, if applicable, will be processed in accordance with these policies.</p>

<h2>3. User Responsibilities</h2>

<p><strong>3.1 User Conduct:</strong> Users agree to behave responsibly and respectfully when interacting with RideCare and its service providers.</p>

<p><strong>3.2 Accuracy of Information:</strong> Users are responsible for providing accurate and truthful information during the booking process.</p>

<p><strong>3.3 User Account Security:</strong> Users are responsible for maintaining the security of their RideCare accounts and should not share login credentials.</p>

<h2>4. Limitation of Liability</h2>

<p><strong>4.1 Service Providers:</strong> RideCare is a platform connecting users with maintenance service providers. RideCare is not responsible for the actions or negligence of service providers.</p>

<p><strong>4.2 Indemnification:</strong> Users agree to indemnify and hold RideCare harmless from any claims, losses, or damages arising from their use of our services.</p>

<h2>5. Privacy Policy</h2>

<p><strong>5.1 Data Collection:</strong> RideCare collects and uses personal information in accordance with its Privacy Policy. By using our services, you consent to the collection and use of your information.</p>

<h2>6. Modifications to Terms</h2>

<p><strong>6.1 Updates:</strong> RideCare reserves the right to update these terms and conditions at any time. Users will be notified of significant changes.</p>

<p><strong>6.2 Continued Use:</strong> Continued use of RideCare services after changes to the terms constitutes acceptance of the modified terms.</p>

<h2>7. Contact Information</h2>

<p>For questions or concerns about these terms and conditions, please contact us at <a href="mailto:ridecare@gmail.com">RideCare@gmail.com</a> or call us at <a href="tel:+123456789">+6391967759</a>.</p>
<br><br><br><br><br><br><button class="close-btn" onclick="closeDialog()">CLOSE</button>
        </div>
    </div>
    <script>
        // JavaScript function to open the dialog
        function openDialog() {
            document.getElementById('termsModal').style.display = 'flex';
        }
        function closeDialog() {
            document.getElementById('termsModal').style.display = 'none';
        }
    </script>