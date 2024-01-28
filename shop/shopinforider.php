<?php 
session_start();
include "../db_conn.php";
$page = 'shopriders';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleshop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<title>RideCare SHOP: Rider Information</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>
<style>

.img {
            width: 300px; /* Set the width as per your requirement */
            height: auto; /* Maintain aspect ratio */
        }

     
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 50%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
<body>	

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Rider Information</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopriders.php">Riders</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Main Menu</a>
						</li>	
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Rider Information</a>
						</li>				
					</ul>
				</div>
			</div>

            <div class="table-data">
				<div class="order">
			<form id="form signup" action="" method="POST" class="form" enctype="multipart/form-data">
    <h1 class="pb-4 border-bottom">Motorcycle Vehicle</h1>
    <div class="d-flex align-items-start py-3 border-bottom">
    <?php
    if(isset($_GET['usertype_id']))
                {
      $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
      $select = mysqli_query($conn, "SELECT * FROM user WHERE usertype_id = '$usertype_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }?>
    <?php
         if($fetch['image'] == ''){
            echo '<img class="img";
            src="../images/default-avatar.png">';
         }else{
            echo '<img class="img" src="../uploaded_img/'.$fetch['image'].'">'; }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>'; } } ?> 
        <div class="pl-sm-4 pl-2" id="img-section">
            <b>Profile Photo</b>
            <p>Accepted file type .png. Less than 1MB</p>
            <input class="btn button border" type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box"></input>
        </div></div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="fname">First Name</label>
                <input required class="bg-light form-control" id="update_fname" name="update_fname" type="text" value="<?php echo $fetch['firstname'];?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lname">Last Name</label>
                <input required class="bg-light form-control" id="update_lname" name="update_lname" type="text" value="<?php echo $fetch['lastname'];?>">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label for="mobile">Mobile Number</label>
                <input required class="bg-light form-control" id="update_mobile" name="update_mobile" type="tel" pattern="[0]{1}[0-9]{10}" value="<?php echo $fetch['mobile'];?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="email">Email Address</label>
                <input required class="bg-light form-control" id="update_email" name="update_email" type="text"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $fetch['email'];?>">
            </div>
        </div>
        <div class="row py-2">
		<div class="col-md-6">
                <label for="address">Home Address</label>
                <input required class="bg-light form-control" id="update_address" name="update_address" type="text" value="<?php echo $fetch['address'];?>">
            </div>
        <div class="col-md-6 pt-md-0 pt-3">
            <label for="gender">Gender</label>
            <select required name="update_gender" class="bg-light form-control">
            <option selected><?php echo $fetch['gender'];?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
            </select>
         </div>
        </div>
        <div class="py-3 pb-4 border-bottom">
        <button class="btn btn-primary mr-3" type="submit" value="update_profile" name="update_profile">Save Changes</button>
      <button class="btn border button">Cancel</button>
        </div>
    </div>
    </form>
	<?php
    }
?>
</div>
			</div> 
		
<?php
if (isset($_POST['update_profile'])){

   $update_fname = mysqli_real_escape_string($conn, $_POST['update_fname']); 
   $update_lname = mysqli_real_escape_string($conn, $_POST['update_lname']);
   $update_mobile = mysqli_real_escape_string($conn, $_POST['update_mobile']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
   $update_gender = mysqli_real_escape_string($conn, $_POST['update_gender']);    
 
    mysqli_query($conn, "UPDATE `user` SET firstname = '$update_fname', lastname = '$update_lname',
    mobile = '$update_mobile', email = '$update_email' , address = '$update_address' , gender = '$update_gender' WHERE usertype_id = '$usertype_id'") or die('query failed');
     ?>
     <script>
     swal({
      title: "Rider Update is Success",
      text: "",
      icon: "success",
      button: "Okay!",
   }).then(function() {
    window.location = "shopinforider.php?usertype_id=<?php echo $fetch['usertype_id'];?>";
});
    </script>  
<?php


   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

if(!empty($update_image)){
   if($update_image_size > 20000000000000){
      $message[] = 'image is too large';
   }else{
      $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$update_image' WHERE usertype_id = '$usertype_id'") or die('query failed');
      if($image_update_query){
         move_uploaded_file($update_image_tmp_name, $update_image_folder);
      }
      
   }
}
}
 ?>
</head>
<body>
    
