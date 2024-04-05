<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script defer src="script.js"></script>
</head>
<style>
    /* Modal style */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1000; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal content */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Close button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');
.container .heading{
    text-align: center;
    padding-bottom: 15px;
    color:black;
    text-shadow: 0 5px 10px rgba(0,0,0,.2);
    font-size: 50px;
}

.container .box-container{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap:15px;
}

.container .box-container .box{
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    border-radius: 5px;
    background: #fff;
    text-align: center;
    padding:30px 20px;
}

.container .box-container .box img{
    height:80px;
}

.container .box-container .box h3{
    color:#444;
    font-size: 22px;
    padding:10px 0;
}

.container .box-container .box p{
    color:#777;
    font-size: 15px;
    line-height: 1.8;
}

.container .box-container .box .btn{
    margin-top: 10px;
    display: inline-block;
    background:#333;
    color:#fff;
    font-size: 17px;
    border-radius: 5px;
    padding: 8px 25px;
}

.container .box-container .box .btn:hover{
    letter-spacing: 1px;
}

.container .box-container .box:hover{
    box-shadow: 0 10px 15px rgba(0,0,0,.3);
    transform: scale(1.03);
}
.motorcycle-image {
            display: block;
            margin: 10px auto;
            width: 20%; /* Set the width to fill the container */
            max-width: 100px; /* Limit the maximum width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px;
        }
@media (max-width:768px){
    .container{
        padding:20px;
    }
}
</style>

<body>
<?php include '../inc/header.php'; ?> 
<br><br>

<div class="container">
<a href="uservehicleadd.php" class="btn btn-primary"><i class="bx bx-plus"></i> Add Motorcycle Vehicle</a>

<br><br>
    <h1 class="heading">MOTORCYCLE VEHICLE</h1> 
<br><br>
<div class="box-container">
<?php 
$book = mysqli_query($conn,"SELECT * FROM vehicle WHERE usertype_id='$usertype_id'") or die(mysqli_error($conn));
if($book)
{
    if(mysqli_num_rows($book) > 0)
    {
        foreach($book as $row) 
        {
?>  
                <div class="box">
                    <h3><?= $row['vehicle']; ?></h3>
                    <?php 
                    if (!empty($row['image'])) {
                        // If the image exists, display it
                        echo '<img class="motorcycle-image" src="../uploaded_img/'.$row['image'].'" alt="Motorcycle Image">';
                    } else {
                        // If the image does not exist, display a default image
                        echo '<img class="motorcycle-image" src="../css/images/user.png" alt="Motorcycle Image">';
                    }
                    ?>
                    <a href='uservehicledetails.php?vehicle=<?= $row['id']; ?>' class="btn">Read More</a>
                </div>
<?php
        }
    }
}
?>
        </div>
    </div>
<!-- Modal -->
<div id="addVehicleModal" class="modal">
  <div class="modal-content">
    <!-- Close button -->
    <span class="close">&times;</span>
    <!-- Modal content -->
    <p>Add Motorcycle Vehicle Content</p>
  </div>
</div>
    <br><br>    <br><br>
    <?php include "../inc/footer.php"; ?>  
</body>
</html>

