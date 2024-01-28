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
<?php  $page = 'userabout'; include '../inc/header.php'; ?>
    <br><br><br>

    <!-- About Us Content -->
    <section class="about-us">
        <div class="row">
            <div class="about-col">
                <h1>We're commited to meet the quality</h1>
                <p>"Ride Care" represents a visionary solution within the motorcycle service industry, 
                    aiming to bridge the gap between motorcycle owners and service providers. 
                    This innovative system revolutionizes the traditional approach to service management, 
                    offering a comprehensive platform accessible via web and mobile applications. 
                    It empowers owners to effortlessly schedule maintenance, track service history, and 
                    communicate with service centers while optimizing operations for service providers through 
                    streamlined processes for appointment scheduling, inventory management, and customer engagement. 
                    With a strong emphasis on user experience, security, and adaptability, </p>
                    <h4>"Ride Care" aims to redefine the standards of efficiency and convenience within the motorcycle service ecosystem, creating a seamless and reliable experience for all stakeholders involved.</p></h4>
            </div>
            <div class="about-col">
                <img src="../css/images/about.jpg">
            </div>
        </div>
    </section>

    <?php include '../inc/footer.php';    ?>
</body>
</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>