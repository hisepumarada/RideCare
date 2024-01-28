<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];
?>
<!DOCTYPE html>
<html><head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideCare: Account Settings</title>
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="script.js"></script>
<style>
body{
margin-top:20px;
background:#F0F8FF;
}
.card {
margin-bottom: 1.5rem;
box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.card {
position: relative;
display: -ms-flexbox;
display: flex;
-ms-flex-direction: column;
flex-direction: column;
min-width: 0;
word-wrap: break-word;
background-color: #fff;
background-clip: border-box;
border: 1px solid #e5e9f2;
border-radius: .2rem;
}
.card-header:first-child {
border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
}
.card-header {
border-bottom-width: 1px;
}
.card-header {
padding: .75rem 1.25rem;
margin-bottom: 0;
color: inherit;
background-color: #fff;
border-bottom: 1px solid #e5e9f2;
}</style></head>

<body>
<?php include '../inc/header.php'; ?>   
 
<div class="container p-0">
<div class="row">
<div class="col-md-5 col-xl-4">
<div class="card">
<div class="card-header">
<h5 class="card-title mb-0">Profile Settings</h5>
</div>
<div class="list-group list-group-flush" role="tablist">
<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
Account
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
Password
</a>

</div>
</div>
</div>
<div class="col-md-7 col-xl-8">
<div class="tab-content">
<div class="tab-pane fade show active" id="account" role="tabpanel">
<div class="card">
<div class="card-header">
<div class="card-actions float-right">
<div class="dropdown show">
<a href="#" data-toggle="dropdown" data-display="static">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
<circle cx="12" cy="12" r="1"></circle>
<circle cx="19" cy="12" r="1"></circle>
<circle cx="5" cy="12" r="1"></circle>
</svg>
</a>
</div>
</div>
<h5 class="card-title mb-0">Public info</h5>
</div>
<div class="card-body">
<form id="form signup" action="" method="POST" class="form" enctype="multipart/form-data">
<?php
      $select = mysqli_query($conn, "SELECT * FROM user WHERE usertype_id = '$usertype_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }?>
    <?php
         if($fetch['image'] == ''){
            echo '<img class="img"; style="width: 100px; height: 100px;"
            src="../css/images/default-avatar.png">';
         }else{
            echo '<img class="img" style="float: left; height: 100px; width: 100px;"src="../uploaded_img/'.$fetch['image'].'">'; }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>'; } } ?> 
     <div class="">
            &nbsp;&nbsp;<b>Profile Photo</b>
            &nbsp;&nbsp;&nbsp;<p>Accepted file type .png. Less than 1MB</p>
            &nbsp;&nbsp;<input class="btn button border" type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box"></input>
        </div>  <br>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputFirstName">First name</label>
<input class="form-control" id="update_firstname" name="update_firstname" type="text" value="<?php echo $fetch['firstname'];?>">
</div>
<div class="form-group col-md-6">
<label for="inputLastName">Last name</label>
<input class="form-control" id="update_lastname" name="update_lastname" type="text" value="<?php echo $fetch['lastname'];?>">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputFirstName">Email</label>
<input class="form-control" id="update_email" name="update_email" type="text" value="<?php echo $fetch['email'];?>">
</div>
<div class="form-group col-md-6">
<label for="inputLastName">Mobile Number</label>
<input class="form-control" id="update_mobile" name="update_mobile" type="tel" pattern="[0]{1}[0-9]{10}" value="<?php echo $fetch['mobile'];?>">
</div>
<div class="form-group col-md-6">
<label>Gender</label>
            <select required name="gender" class="form-control">
            <option disabled selected><?php echo $fetch['gender'];?></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Others</option>
            </select>
</div>
<div class="form-group col-md-6">
<label for="inputLastName">ID Type</label>
<input class="form-control">
</div>
</div>
<button type="submit" class="btn btn-primary" value="update_profile" name="update_profile">Save changes</button>
</form>
<?php
if (isset($_POST['update_profile'])){

   $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_mobile = mysqli_real_escape_string($conn, $_POST['update_mobile']);
   
   
 
    mysqli_query($conn, "UPDATE `user` SET firstname = '$update_firstname', lastname = '$update_lastname',
    email = '$update_email', mobile='$update_mobile' WHERE usertype_id = '$usertype_id'") or die('query failed');
     ?>
     <script>
     swal({
      title: "Account Update is Success",
      text: "",
      icon: "success",
      button: "Okay!",
   }).then(function() {
    window.location = "userchangedetails.php";
});
    </script>   
<?php


   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = '../uploaded_img/'.$update_image;

if(!empty($update_image)){
   if($update_image_size > 2000000){
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

</div>
</div>
</div>
<div class="tab-pane fade" id="password" role="tabpanel">
<div class="card">
<div class="card-body">
<h5 class="card-title">Password Settings</h5><br>
<form action="" method="post" class="form">
<div class="form-group">
<label for="inputPasswordCurrent">Current password</label>
<input  class="form-control" type="password" name="op" id="op" placeholder="Old Password">
</div>
<div class="form-group">
<label for="inputPasswordNew">New password</label>
<input class="form-control" type="password" name="np" id="np" placeholder="New Password">
</div>
<div class="form-group">
<label for="inputPasswordNew2">Verify password</label>
<input class="form-control" type="password" name="c_np" id="c_np" placeholder="Confirm New Password">
</div><br>
<button class="btn btn-primary" type="submit" id="submit" name="submit">Save changes</button>
</form>

<?php 
if (isset($_SESSION['email'])) {
    if (isset($_POST['op']) && isset($_POST['np'])
        && isset($_POST['c_np'])) {
    
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
    
        $op = validate($_POST['op']);
        $np = validate($_POST['np']);
        $c_np = validate($_POST['c_np']);
        
        if(empty($op)){
          ?>
            <script>
            swal({
             title: "Please Input Password",
             text: "Old Password is required",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
        }else if(empty($np)){
            ?>
            <script>
            swal({
             title: "Please Input Password",
             text: "New Password is required",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
        }else if($np !== $c_np){
            ?>
            <script>
            swal({
             title: "Password does not match",
             text: "",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
        }else {
            // hashing the password
            $op = md5($op);
            $np = md5($np);
       
    
            $sql = "SELECT password FROM user WHERE email='$email' AND password='$op'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) === 1){
                
            $sql_2 = "UPDATE user SET password='$np' WHERE email='$email'";
            mysqli_query($conn, $sql_2);
            ?>
            <script>
            swal({
             title: "Change Password is Success",
             text: "",
             icon: "success",
             button: "Okay!",
            }).then(function() {
    window.location = "userchangedetails.php";
});
           </script>   
    <?php
            }else {
                ?>
            <script>
            swal({
             title: "Incorrect Password",
             text: "",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
            }
    
        }
     }
    }
?>
</div>
</div>
</div></div>
</div> <script type="text/javascript"></script>          

</div></div><br><br>
<?php include '../inc/footer.php'; ?>

</body>
</html>
