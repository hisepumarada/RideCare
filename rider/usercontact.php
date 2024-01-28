<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];
if (isset($_SESSION['usertype_id'])) {

 ?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RideCare: About</title>
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
    #contatti{
  background-color: #70c3be;
  letter-spacing: 2px;
  }
#contatti a{
  color: #fff;
  text-decoration: none;
}


@media (max-width: 575.98px) {

  #contatti{padding-bottom: 800px;}
  #contatti .maps iframe{
    width: 100%;
    height: 450px;
  }
 }


@media (min-width: 576px) {

   #contatti{padding-bottom: 800px;}

   #contatti .maps iframe{
     width: 100%;
     height: 450px;
   }
 }

@media (min-width: 768px) {

  #contatti{padding-bottom: 350px;}

  #contatti .maps iframe{
    width: 100%;
    height: 850px;
  }
}

@media (min-width: 992px) {
  #contatti{padding-bottom: 200px;}

   #contatti .maps iframe{
     width: 100%;
     height: 700px;
   }
}


#author a{
  color: #fff;
  text-decoration: none;
    
}
</style>
<body>
<?php  $page = 'usercontact'; include '../inc/header.php'; ?>
 

    <div  id="contatti">
<div class="container mt-5" >
    <div class="row" style="height:550px; width:1400px;">
      <div class="col-md-5 maps" >
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.8961765052927!2d120.99097347376276!3d14.
        547929378366726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9674a3e5ab9%3A0xbd1406e10e089381!2s
        Motortrade%20Yamaha%203S!5e0!3m2!1sen!2sph!4v1698916504228!5m2!1sen!2sph" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
   
      <div class="col-md-7">
        <h2 class="text-uppercase mt-3 font-weight-bold text-white">CONTACT US</h2>
        <form action="" method="POST">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" name="firstname" placeholder="First Name" required>
              </div>
            </div><br>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" name="lastname" id="" placeholder="Last Name" required>
              </div>
            </div><br><br><br>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="email" class="form-control mt-2" name="email" placeholder="Email" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="number" class="form-control mt-2" name="mobile" placeholder="Mobile" required>
              </div>
            </div><br><br><br>
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" placeholder="Message" rows="3" required></textarea>
              </div>
            </div><br>
            <div class="col-12">
            <div class="form-group">
            </div>
            </div><br>
            <div class="col-12">
              <button class="btn btn-light" value="submit" name="submit" type="submit">Send Message</button>
            </div>
          </div>
        </form>
        <div class="text-white">
        <h2 class="text-uppercase mt-4 font-weight-bold">RideCare</h2>

        <i class="fas fa-phone mt-3"></i> <a href="tel:+">09648712335</a><br>
        <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+871) 2215</a><br>
        <i class="fa fa-envelope mt-3"></i> <a href="">ridecare@gmail.com</a><br>
        <i class="fas fa-globe mt-3"></i> Motortrade Yamaha 3s F.B. Harrison St, Pasay, 1300 Metro Manila<br>
        <i class="fas fa-globe mt-3"></i> Motortrade Yamaha 3s F.B. Harrison St, Pasay, 1300 Metro Manila<br>
        <div class="my-4">
        <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
        <a href=""><i class="fab fa-linkedin fa-3x"></i></a>
        </div>
        </div>
      </div>

    </div>
</div>
</div><br><br>
   <?php 

if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    
    
    $sql = "INSERT INTO message(email, firstname, lastname,message,date) VALUES('$email', '$firstname', '$lastname','$message',NOW())";
    $result = mysqli_query($conn, $sql);
    if ($result) {?>
        <script>
        swal({
         title: "Your message is success",
         text: "We will take care of it!",
         icon: "success",
         button: "Okay!",
       }).then(function() {
window.location = "userhome.php";
});
       </script>        
<?php
           }else {
			header("Location: usercontact.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
?>


    <?php include '../inc/footer.php';    ?>
</body>
</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>