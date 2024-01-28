<?php 
session_start();
include "../db_conn.php";

$usertype_id = $_SESSION['usertype_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<html><head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideCare: Profile Details</title>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="script.js"></script>
    <title>RideCare: View Profile</title>
</head>
<style>
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
    </style>

<body>
<?php include("../inc/header.php");  ?>
<?php
      $select = mysqli_query($conn, "SELECT * FROM user WHERE usertype_id = '$usertype_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }?>
      <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="userhome.php">Home</a></li>
              <li class="breadcrumb-item"><a href="">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <?php
         if($fetch['image'] == ''){
            echo '<img class="" width="150"
            src="../css/images/default-avatar.png">';
         }else{
            echo '<img class="" width="150" 
            src="../uploaded_img/'.$fetch['image'].'">'; }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>'; } } ?>
                    <div class="mt-3">
                    <?php echo $result['firstname']; ?> <?php echo $result['lastname']; ?>
                      <p class="text-secondary mb-1"><?php echo $result['email']; ?>
                      <br><?php echo $result['mobile']; ?></p>
                      <button class="btn btn-primary"><a href="userchangedetails.php" style="color:white;">Edit</a></button>
                      <button class="btn btn-outline-primary"><a href="userbookhistory.php" style="color:black;">Book History</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
          </div>
        </div>
    </div>
    <?php  include '../inc/footer.php';   ?>
</body>
</html>
