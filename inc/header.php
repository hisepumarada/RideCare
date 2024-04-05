<?php 
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];
if (isset($_SESSION['usertype_id'])) {
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
    <title>RideCare</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
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
</style>
<body>
<main>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="userhome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-1" width="10" height="50" role="img" aria-label="Bootstrap"><img src="../css/images/ridecare-high-resolution-logo-transparent.png"  width="100" height="50" ></svg>
      </a>

      <ul class="nav nav-pills">
        <li style="font-size:20px;"class="nav-item "><a href="userhome.php" class="nav-link <?php if($page=='userhome'){echo 'active';}?>">Home</a></li>
        <li style="font-size:20px;"class="nav-item"><a href="userservice.php" class="nav-link <?php if($page=='userservice'){echo 'active';}?>">Service</a></li>
        <li style="font-size:20px;"class="nav-item"><a href="userappointment.php" class="nav-link <?php if($page=='userappointment'){echo 'active';}?>">Book</a></li>
        <li style="font-size:20px;"class="nav-item"><a href="usercontact.php" class="nav-link <?php if($page=='usercontact'){echo 'active';}?>">Contact</a></li>
        <li style="font-size:20px;"class="nav-item"><a href="userabout.php" class="nav-link <?php if($page=='userabout'){echo 'active';}?>">About</a></li>
      </ul>
  <?php 
                 $select = mysqli_query($conn, "SELECT * FROM user WHERE usertype_id = '$usertype_id'") or die('query failed');
                 $result = mysqli_fetch_assoc($select);
                ?>
      
    
      <div class="btn-group">
<button class="btn btn-secondary btn-lg" type="button" onclick="window.location.href='userprofile.php'">
<?php echo $result['firstname']; ?>  <?php echo $result['lastname']; ?>          &nbsp;&nbsp;
     <?php if($result['image'] == ''){
            echo '<img style="vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;" src="../css/images/default-avatar.png">';
         }else{
            echo '<img style="vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;"  src="../uploaded_img/'.$result['image'].'">'; }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>'; } } ?>
  </button>
  <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu ">
<li><a class="dropdown-item" href="userhistorymenu.php">Appointment History</a></li>
<li><a class="dropdown-item" href="uservehicle.php">Motorcycle Details</a></li>
<li><a class="dropdown-item" href="userpaymentsmenu.php">Payment History</a></li>
<li><a class="dropdown-item" href="userchangedetails.php">Account Settings</a></li>
<li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item"href="../logout.php">Logout</a></li>
  </div>
</div>
</header>
  
  
</main>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>
 