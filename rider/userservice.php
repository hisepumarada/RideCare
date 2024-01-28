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
            <div class="row">
                <div class="service-col">
                    <h3>BODY PLASTIC COVER REPLACEMENT</h3>
                    <p>Body plastic cover replacement involves the removal of damaged or existing plastic 
                    panels on a motorcycle and their replacement with new ones.</p>
                </div>
                <div class="service-col">
                    <h3>BRAKE SHOE/PAD REPLACEMENT</h3>
                    <p>Brake shoe/pad replacement is an essential part of motorcycle maintenance, as it 
                    ensures that your brakes remain effective and safe.</p>
                </div>
                <div class="service-col">
                    <h3>BRAKE/THROTTLE CABLE REPLACEMENT</h3>
                    <p>Both brake and throttle cable replacement are crucial maintenance tasks to ensure the 
                    safety and functionality of your motorcycle. Properly functioning cables are essential
                    for controlling the speed and stopping power of the motorcycle.</p>
                </div>
            </div>
            <div class="row">
                <div class="service-col">
                    <h3>CARBURATOR CLEANING</h3>
                    <p>Cleaning the carburetor is essential to maintain the engine's performance and 
                    responsiveness. It can help prevent stalling, misfires, and other issues that can be 
                    caused by a dirty or clogged carburetor.
                    </p>
                </div>
                <div class="service-col">
                    <h3>CHANGE OIL</h3>
                    <p>Normally, engine oil is changed anywhere between 1500 kilometers to 3000 kilometers, 
                    or every one month, it depends whichever comes first.</p>
                </div>
                <div class="service-col">
                    <h3>CVT CLEANING</h3>
                    <p>Regular cleaning and maintenance help ensure optimal performance, prevent wear and tear, 
                    and extend the lifespan of the CVT transmission.</p>
                </div>
            </div>
            <div class="row">
                <div class="service-col">
                    <h3>FI CLEANING</h3>
                    <p>Regular maintenance on the FI system includes fuel injector cleaning and fuel filter 
                    replacement. Over time, particulates from the fuel can accumulate on the fuel filter and on
                    the nozzle of the injectors, causing a decrease in fuelling performance.</p>
                </div>
                <div class="service-col">
                    <h3>FRONT SUSPENSION TUNING</h3>
                    <p> Properly tuned front suspension can significantly enhance a motorcycle's ride quality,
                    handling, and safety.</p>
                </div>
                <div class="service-col">
                    <h3>MAJOR OVERHAUL</h3>
                    <p>To restore the motorcycle to a condition that is as close to factory specifications as 
                    possible, ensuring that it operates safely and reliably.</p>
                </div>
            </div>
            <div class="row">
                <div class="service-col">
                    <h3>MINOR ELECTRICAL CHECK-UP</h3>
                    <p> To ensure the motorcycle's electrical system is in good working order and that there 
                    are no potential safety hazards or issues that could lead to a breakdown</p>
                </div>
                <div class="service-col">
                    <h3>TOP OVERHAUL</h3>
                    <p>A top overhaul is typically performed when there are specific issues with the upper 
                    part of the engine, such as poor compression, valve problems, or oil leaks. It is a 
                    cost-effective way to address these issues without completely rebuilding the entire 
                    engine.</p>
                </div>
                <div class="service-col">
                    <h3>TUNE-UP</h3>
                    <p>Performing regular tune-ups can help maintain the vehicle's performance, extend its 
                    lifespan, and prevent more significant and costly mechanical issues.</p>
                </div>
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