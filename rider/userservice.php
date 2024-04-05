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
    <title> RideCare: Service </title>
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

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
<?php  $page = 'userservice'; include '../inc/header.php';?>
<body>

        
    <!-- Service -->
    <section class="userservice">
    <h1>Services We Offer</h1>
    <br><br><br>
    <div class="row">
    <?php 
        $service = mysqli_query($conn,"SELECT * FROM service WHERE status = 'Active'") or die(mysqli_error($conn));
        if($service)
        {
            if(mysqli_num_rows($service) > 0)
            {
                foreach($service as $row) 
                {
             ?> 
                <div class="service-col">
                    <h3><?= $row['name']; ?></h3>
                    <p><?= $row['description']; ?></p>
                </div>
                <?php
                }
            }
        }
    ?>  
    </div>
</section>

          
  
    <!-- Footer -->
<?php include '../inc/footer.php';    ?>
</body>
</html>

<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>