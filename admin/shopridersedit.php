<?php 
session_start();
include "../db_conn.php";
if(isset($_GET['email'])){
    $email = $_GET['email'];
}


if(isset($_POST['update_profile'])){
   
    $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
    $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_mobile = mysqli_real_escape_string($conn, $_POST['update_mobile']);
    
 
    mysqli_query($conn, "UPDATE `user` SET firstname = '$update_firstname', lastname = '$update_lastname', 
    email = '$update_email', mobile='$update_mobile' WHERE email = '$update_email'") or die('query failed');


   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

if(!empty($update_image)){
   if($update_image_size > 2000000){
      $message[] = 'image is too large';
   }else{
      $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$update_image' WHERE email = '$email'") or die('query failed');
      if($image_update_query){
         move_uploaded_file($update_image_tmp_name, $update_image_folder);
      }
      
   }
}
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"> 
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<title>RideCare (ADMIN): RIDERS</title>
    <style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
	background-color: white;
}

.wrapper{
    padding: 30px 50px;
    border: 1px solid #ddd;
    border-radius: 15px;
    margin: 10px auto;
    max-width: 600px;
}
h4{
    letter-spacing: -1px;
    font-weight: 400;
}
.img{
    width: 70px;
    height: 70px;
    border-radius: 6px;
    object-fit: cover;
}
#img-section p,#deactivate p{
    font-size: 12px;
    color: #777;
    margin-bottom: 10px;
    text-align: justify;
}
#img-section b,#img-section button,#deactivate b{
    font-size: 14px; 
}

label{
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 500;
    color: #777;
    padding-left: 3px;
}

.form-control{
    border-radius: 10px;
}

input[placeholder]{
    font-weight: 500;
}
.form-control:focus{
    box-shadow: none;
    border: 1.5px solid #0779e4;
}
select{
    display: block;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    height: 40px;
    padding: 5px 10px;
    /* -webkit-appearance: none; */
}

select:focus{
    outline: none;
}
.button{
    background-color: #fff;
    color: #0779e4;
}
.button:hover{
    background-color: #0779e4;
    color: #fff;
}
.btn-primary{
    background-color: #0779e4;
}
.danger{
    background-color: #fff;
    color: #e20404;
    border: 1px solid #ddd;
}
.danger:hover{
    background-color: #e20404;
    color: #fff;
}
@media(max-width:576px){
    .wrapper{
        padding: 25px 20px;
    }
    #deactivate{
        line-height: 18px;
    }
}
</style>
<?php include '../inc/sidebarshop.php';  ?>
<main>
<div class="table-data">
<div class="order">
<form id="form signup" action="" method="POST" class="form" enctype="multipart/form-data">
<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Account settings</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
    <?php
                       if(isset($_GET['email']))
					 
                        {
                            $email = mysqli_real_escape_string($conn, $_GET['email']);
                            $query = "SELECT * FROM user WHERE email='$email' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $user = mysqli_fetch_array($query_run);
                                ?>
    <?php
         if($user['image'] == ''){
            echo '<img class="img";
            src="images/default-avatar.png">';
         }else{
            echo '<img class="img" src="uploaded_img/'.$user['image'].'">'; }
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
                <label for="firstname">First Name</label>
                <input required class="bg-light form-control" id="update_firstname" name="update_firstname" type="text" value="<?= $user['firstname']; ?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lastname">Last Name</label>
                <input required class="bg-light form-control" id="update_lastname" name="update_lastname" type="text" value="<?php echo $user['lastname'];?>">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label for="email">Email Address</label>
                <input required class="bg-light form-control" id="update_email" name="update_email" type="text" value="<?php echo $user['email'];?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="phone">Phone Number</label>
                <input required class="bg-light form-control" id="update_mobile" name="update_mobile" type="tel" pattern="[0]{1}[0-9]{10}" value="<?php echo $user['mobile'];?>">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6">
                <label>Gender</label>
            <select required name="gender" class="bg-light">
            <option disabled selected><?php echo $user['gender'];?></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Others</option>
            </select>
            </div>
            <div class="col-md-6 pt-md-0 pt-3" id="lang">
                <label for="language">Language</label>
                <div class="arrow">
                    <select name="language" id="language" class="bg-light">
                        <option value="english" selected>English</option>
                        <option value="english_us">English (United States)</option>
                        <option value="enguk">English UK</option>
                        <option value="arab">Arabic</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="py-3 pb-4 border-bottom">
        <button class="btn btn-primary mr-3" type="submit" value="update_profile" name="update_profile">Save Changes</button>
      <button class="btn border button"><a href="shopriders.php">Back</a></button>
        </div>
    </div>
    <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
    </form>
</div>
          
<?php
if (isset($_POST['update_profile'])){

   $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_mobile = mysqli_real_escape_string($conn, $_POST['update_mobile']);
    
 
    mysqli_query($conn, "UPDATE `user` SET firstname = '$update_firstname', lastname = '$update_lastname',
    email = '$update_email', mobile='$update_mobile' WHERE email = '$email'") or die('query failed');
     ?>
     <script>
     swal({
      title: "Account Update is Success",
      text: "",
      icon: "success",
      button: "Okay!",
   });
    </script>  
<?php


   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

if(!empty($update_image)){
   if($update_image_size > 2000000){
      $message[] = 'image is too large';
   }else{
      $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$update_image' WHERE email = '$email'") or die('query failed');
      if($image_update_query){
         move_uploaded_file($update_image_tmp_name, $update_image_folder);
      }
      
   }
}
}
 ?>

</head>
<body>
    
</body>
</html>