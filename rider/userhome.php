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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RideCare: Home</title>
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <script defer src="script.js"></script>
</head>
<body>
    <!-- Navbar-->
<?php $page = 'userhome'; include '../inc/header.php';  ?>
    <!-- Home -->
    
    <section class="home" id="home">
        <div class="home-text">
            <h1>We Have Everything <br> Your <span>Motorcycle</span> Need </h1>
            <br><br>
            <!-- Home Button -->
            <a href="userappointment.php" class="btn-book">Book Now</a>
            <br><br>
            <div class="motorcycle-select">
                <div id="yamaha"></div>
                <div id="honda"></div>
                <div id="suzuki"></div>
            </div>
        </div>
        <script>
            let yamahaBtn= document.getElementById("yamaha");
            let hondaBtn= document.getElementById("honda");
            let suzukiBtn= document.getElementById("suzuki");
            let home = document.getElementById("home");

            yamahaBtn.onclick = function(){
                home.style.backgroundImage= "url(../css/images/fazzio.png)";
            }
            hondaBtn.onclick = function(){
                home.style.backgroundImage= "url(../css/images/pcx.png)";
            }
            suzukiBtn.onclick = function(){
                home.style.backgroundImage= "url(../css/images/burgman.png)"
            }

        </script>
    </section>
    <!-- Service -->
    <br><br><br>
    <section class="service" id="service">
        <div class="servicegif">
        <h1>Services We Offer</h1>
            <div class="row">
                <div class="service-col">
                    <h3>Change Oil</h3>
                    <p>Normally, engine oil is changed anywhere between 1500 kilometers to 3000 kilometers, 
                    or every one month, it depends whichever comes first.</p>
                </div>
                <div class="service-col">
                    <h3>FI Cleaning</h3>
                    <p>Regular maintenance on the FI system includes fuel injector cleaning and fuel filter 
                    replacement. Over time, particulates from the fuel can accumulate on the fuel filter and on
                    the nozzle of the injectors, causing a decrease in fuelling performance. As such, cleaning 
                    and replacement of these parts are typically done every 15,000 kilometers to 25,000 
                    kilometers.</p>
                </div>
                <div class="service-col">
                    <h3>Valve Timing and Clearance</h3>
                    <p>Ensuring proper valve timing and valve clearances allow for your motorcycle to draw in 
                    air and fuel properly while pumping out the right amount of exhaust gasses in a timely 
                    manner.</p>
                </div>
            </div></div>
    </section>

    <!-- Dealers -->
    <section class="dealers" id="dealers">
        <h1>Dealers</h1>
        <a>"Motorcycle dealers play a vital role in the motorcycle industry by facilitating the purchase, 
        maintenance, and customization of motorcycles, as well as providing a range of related products 
        and services to enhance the overall riding experience.</a>
        <div class="row">
            <div class="dealers-col">
                <img src="../css/images/dealer1.jpg">
                <div class="layer">
                    <h3>YAMAHA</h3>
                </div>
            </div>
            <div class="dealers-col">
                <img src="../css/images/dealer2.jpg">
                <div class="layer">
                    <h3>MOTORTRADE</h3>
                </div>
            </div>
            <div class="dealers-col">
                <img src="../css/images/dealer3.jpg">
                <div class="layer">
                    <h3>HONDA</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action-->
    <div class="row">
    <section class="cta" id="home">
        <h1>Book your Online Appointment Anytime and Anywhere Now!</h1>
        <a href="usercontact.php" class="btn btn-danger">CONTACT US</a>
        </div>
    </section>

 

    <script>
  let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');
window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');
        if(top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
            });
        };
    });
};
</script>

</body>
</html>

<?php 
}else{
     header("Location: ../index.php");
     exit();
}
include '../inc/footer.php'; ?>