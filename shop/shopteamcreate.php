<?php 
session_start(); 
include "../db_conn.php";
$page = 'shopteam';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleshop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<title>RideCare SHOP: Create Staff</title>
    <?php include "../inc/sidebarshop.php";   ?>
		<main>
        <div class="head-title">
				<div class="left">
					<h1>Team</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="shopteam.php">Team</a>
						</li>
					</ul>
                    </div>
			</div>
			<div class="table-data">
				<div class="order">
<form id="form signup" action="" method="POST" class="form" enctype="multipart/form-data">
    <h4 class="pb-4 border-bottom">Staff Create</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
    <img class="img" src="../css/images/default-avatar.png">
          
        <div class="pl-sm-4 pl-2" id="img-section">
            <b>Profile Photo</b>
            <p>Accepted file type .png. Less than 1MB</p>
            <input required class="btn button border" type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box"></input>
        </div></div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="firstname">First Name</label>
                <input required class="bg-light form-control" id="firstname" name="firstname" type="text">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lastname">Last Name</label>
                <input required class="bg-light form-control" id="lastname" name="lastname" type="text">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label for="email">Email Address</label>
                <input required class="bg-light form-control" id="email" name="email" type="text">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="phone">Phone Number</label>
                <input required class="bg-light form-control" id="mobile" name="mobile" type="number" pattern="[0]{1}[0-9]{10}">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6 pt-md-0 pt-3" id="lang">
                <label>Gender</label>
                <div class="arrow">
                    <select required name="gender" id="gender" class="bg-light">
                        <option selected>Select Gender</option>
						<option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div> 
        <div class="col-md-6 pt-md-0 pt-3" id="lang">
                <label>Role</label>
                <div class="arrow">
                    <select required name="role" id="role" class="bg-light">
                        <option selected>Select Role</option>
						<option value="Mechanic">Mechanic</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
            </div> 
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label for="email">Password</label>
                <input required class="bg-light form-control" id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                 title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="phone">Re-Password</label>
                <input required class="bg-light form-control" id="password2" name="password2" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
        </div>
        <div class="py-3 pb-4 border-bottom">
        <button class="btn btn-primary mr-3" type="submit" value="submit" name="submit">Create User</button>
        <button class="btn border button"><a href="shopteam.php">Back</a></button>
        </div>
    </div>
    </form>
</div>
					</div>
		</main>
		<!-- MAIN -->
	</section>
<?php 	
if (isset($_POST['email'])) {

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
$role = validate($_POST['role']);
$mobile = validate($_POST['mobile']);
$gender = validate($_POST['gender']);
$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'uploaded_img/'.$image;

// Hashing the password
$passwordHash = md5($password);

$select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');

if (mysqli_num_rows($select) > 0) {
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
} else {
    if ($password !== $password2) {
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
       }elseif($image_size > 200000){
		?>
		<script>
		swal({
		 title: "Image is too large!",
		 text: "",
		 icon: "warning",
		 button: "Okay",
	   });
	   </script>  
	<?php
       }else{
          $insert = mysqli_query($conn, "INSERT INTO `user`(email, password, firstname, lastname, role, mobile, gender, image, usertype) 
		  VALUES('$email', '$password', '$firstname','$lastname','$role',  '$mobile', '$gender', '$image', 'shop')") or die('query failed');
          if($insert){
             move_uploaded_file($image_tmp_name, $image_folder);
             ?>
            <script>
            swal({
             title: "Registration is Success",
             text: "Welcome to RideCare!",
             icon: "success",
             button: "Okay!",
           }).then(function() {
    window.location = "shopteam.php";
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
	
	<?php 
    
}

}}}
?>
</head>
<body>