<?php 
session_start();
include "../db_conn.php";

$page = 'adminbook';

function build_calendar($month, $year){

    $mysqli = new mysqli("localhost","root","","users_db");
    $stmt = $mysqli->prepare('select * from appointment where MONTH(date) =? AND YEAR(date) =?');
    $stmt->bind_param('ss',$month, $year);
    $appointment= array();
    if($stmt->execute()){
      $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row =$result->fetch_assoc()){
                $appointment[] = $row['date'];
            }
            $stmt->close();
        }
      }
	$daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	$firstDayOfMonth = mktime(0,0,0, $month, 1, $year);
	$numberDays = date('t', $firstDayOfMonth);
	$dateComponents = getdate($firstDayOfMonth);
	$monthName = $dateComponents['month'];
	$dayOfWeek = $dateComponents['wday'];
	$dateToday = date("Y-m-d");
	

	$prev_month = date('m',mktime(0,0,0, $month-1, 1, $year));
	$prev_year = date('Y',mktime(0,0,0, $month-1, 1, $year));
	$next_month = date('m',mktime(0,0,0, $month+1, 1, $year));
	$next_year = date('Y',mktime(0,0,0, $month+1, 1, $year));
    $calendar = "<center><br><h1>Select Appointment Date</h1><br>";
    $calendar = "<br><center><h1>Select Appointment Date</h1><h2</h2>";
    $calendar.= "<a style='background-color: #89CFF0; font-size: 25px;' class='btn btn-primary btn-xs' href='userappointment.php?month=".$prev_month."&year=".$prev_year."'> <<< </a> ";
    $calendar.= "&nbsp;&nbsp;<B style='font-size: 25px;' class=''>$monthName $year</B> ";
    $calendar.= "&nbsp;&nbsp;<a style='background-color: #89CFF0; font-size: 25px;' class='btn btn-primary btn-xs'href='testbi.php?month=".$next_month."&year=".$next_year."'> >>><br> </a></center>";
	$calendar.="<br><br><center><div class='table-responsive'><table class='table table-bordered'>";
	$calendar.="<tr>";
	foreach($daysOfWeek as $day){
		$calendar.="<th class='table-dark'>$day</th>";
	}

	$calendar.="</tr><tr>";
	$currentDay =1;
	if($daysOfWeek >0){
		for($k =0; $k < $dayOfWeek; $k++){
			$calendar.="<td class='empty'></td>";
		}
	}
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
	while($currentDay <= $numberDays){
		if($dayOfWeek == 7){
			$dayOfWeek = 0;
			$calendar.="</tr><tr>";
		}

		$currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
		$date = "$year-$month-$currentDayRel";
        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date==date('Y-m-d')? "today" : "";
        if($dayname=='sunday'){
			$calendar.="<td><h3>$currentDay</h3><br><h6>CLOSE</h6><p></p>";
		   }elseif($date<date('Y-m-d')){
            $calendar.="<td><h3>$currentDay</h3>";
        }else{
          
        $totalbookings = checkSlots($mysqli,$date);
        if($totalbookings==10){
          $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>All Booked</a>";
        }else{
            $availableslots = 10 - $totalbookings;
            $calendar.="<td class='$today'>
            <h3>$currentDay</h3> <a href='test.php?date=".$date."' class='btn btn-success btn-xs'>Book</a>
            <br><small><i>$availableslots slots available</i></small>";
        }
    }
    
		$currentDay++;
		$dayOfWeek++;
	}

    if($dayOfWeek<7){
		$remainingDays = 7 - $dayOfWeek;
		for($i=0; $i<$remainingDays; $i++){
			$calendar.="<td class='empty'></td>";
		}
	}

    $calendar.="</tr></table></div></center>";

	 echo $calendar;

}
function checkSlots($mysqli,$date){
    $stmt = $mysqli->prepare("select * from appointment where date =?");
    $stmt->bind_param('s',$date);
    $totalbookings= 0;
    if($stmt->execute()){
      $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row =$result->fetch_assoc()){
               $totalbookings++;
            }
            $stmt->close();
        }
      }
      return $totalbookings;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>RideCare: Book to Us Now!</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">
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

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <div class="row align-items-md-stretch">
      <div class="col-md-8">
        <div class="h-100 p-5 text-white bg-info rounded-3">
        <?php
   $dateComponents = getDate();
   if(isset($_GET['month'])&& isset($_GET['year'])){
	$month = $_GET['month'];
	$year = $_GET['year'];
   }else{
	$month = $dateComponents['mon'];
	$year = $dateComponents['year'];
   }
   echo build_calendar($month, $year);
   ?>	
        </div>
      </div>
      <?php


  
if(isset($_GET['date'])){
    $date = $_GET['date'];

}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $shop = $_POST['shop'];
    $service = $_POST['service'];
    $email = $_POST['email'];
    
    
    $sql2 = "INSERT INTO appointment(email, name, date,shop,service) VALUES('$email', '$name','$date','$shop','$service')";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
    echo '<script language="javascript" type="text/javascript"> 
    alert("The Booking is Successfully Saved");
    window.location = "../userhome.php";
    </script>';
           }else {
		        exit();
           }
		}
    
?>
      <div class="col-md-4">
        <div class="h-100 p-5 bg-light border rounded-3">
        <form action="" method="post" class="form">
        <H4>APPOINTMENT DETAILS</H4><BR>
            <label class="form-label">Selected Book Date</label><br><br>
            <input disabled class="form-control" disabled id="name" name="name" type="text" value="  -- Selected Date -- ">
            <br><br>
            <label class="form-label">Enter your Email</label><br><br>
            <input disabled class="form-control" id="email" name="email" type="text" >
            <br><br>
            <label class="form-label">Enter your Full Name</label><br><br>
            <input disabled class="form-control" required id="name" name="name" type="text">
            <br><br>
            <label class="form-label">Enter your Phone Number</label><br><br>
            <input disabled class="form-control" required id="mobile" name="mobile" type="mobile">
            <br><br>
            <label class="form-label">Service Request</label><br><br>
            <select disabled class="form-select" required name="service">
                <option class="col-md-8 fs-4" required selected >Select Service</option>
                <option value="BODY PLASTIC COVER REPLACEMENT">BODY PLASTIC COVER REPLACEMENT</option>
                <option value="BRAKE SHOE/PAD REPLACEMENT">BRAKE SHOE/PAD REPLACEMENT</option>
                <option value="BRAKE/CLUTCH/THROTTLE CABLE REPLACEMENT">BRAKE/CLUTCH/THROTTLE CABLE REPLACEMENT</option>
                <option value="CARBURATOR CLEANING">CARBURATOR CLEANING</option>
                <option value="CHANGE OIL">CHANGE OIL</option>
                <option value="CHANGE OIL/TUNE-UP">CHANGE OIL/TUNE-UP</option>
            </select><br><br><br>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </div>
      </div>
    </div></form>
    

   
  </div>
</main>

    
  </body>
</html>

