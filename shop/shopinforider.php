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
/* General styles */
.form {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.form h1 {
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.form label {
    font-weight: bold;
}

.form input[type="text"],
.form input[type="tel"],
.form input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form input[type="file"] {
    margin-top: 10px;
}

.form .row {
    margin-bottom: 15px;
}

/* Image section styles */
#img-section {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.message {
    color: red;
    margin-top: 5px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .form {
        padding: 10px;
    }
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
</div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="fname">First Name</label>
                <input readonly class="bg-light form-control" id="update_fname" name="update_fname" type="text" value="<?php echo $fetch['firstname'];?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lname">Last Name</label>
                <input readonly class="bg-light form-control" id="update_lname" name="update_lname" type="text" value="<?php echo $fetch['lastname'];?>">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label for="mobile">Mobile Number</label>
                <input readonly class="bg-light form-control" id="update_mobile" name="update_mobile" type="tel" pattern="[0]{1}[0-9]{10}" value="<?php echo $fetch['mobile'];?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="email">Email Address</label>
                <input readonly class="bg-light form-control" id="update_email" name="update_email" type="text"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $fetch['email'];?>">
            </div>
        </div>
        <div class="row py-2">
		<div class="col-md-6">
                <label for="address">Home Address</label>
                <input readonly class="bg-light form-control" id="update_address" name="update_address" type="text" value="<?php echo $fetch['address'];?>">
            </div>
        <div class="col-md-6 pt-md-0 pt-3">
            <label for="gender">Gender</label>
            <input readonly class="bg-light form-control" id="update_address" name="update_address" type="text" value="<?php echo $fetch['gender'];?>">
         </div>
        </div>
    </div>
    </form>
	<?php
    }
?>
</div>
</div> 
	
</head>
<body>
    
