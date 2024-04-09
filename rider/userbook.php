<?php 
session_start(); 
include "../db_conn.php";

$usertype_id = $_SESSION['usertype_id'];
if (isset($_SESSION['usertype_id'])) {

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
  $calendar = "<br><center><h1>Select Appointment Date</h1><h2>$monthName $year</h2>";
  $calendar.= "<a style='background-color: #89CFF0; font-size: 25px;' class='btn btn-primary btn-xs' href='userappointment.php?month=".$prev_month."&year=".$prev_year."'> <<< </a> ";
  $calendar.= "&nbsp;&nbsp;<a style='background-color: #89CFF0; font-size: 25px;' class='btn btn-primary btn-xs' href='userappointment.php?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
  $calendar.= "&nbsp;&nbsp;<a style='background-color: #89CFF0; font-size: 25px;' class='btn btn-primary btn-xs'href='userappointment.php?month=".$next_month."&year=".$next_year."'> >>><br> </a></center>";
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
			$calendar.="<td><h3>$currentDay</h3><br><h6></h6><p></p>";
		   }elseif($date<date('Y-m-d')){
            $calendar.="<td><h3>$currentDay</h3>";
        }else{
          $totalbookings = checkSlots($mysqli, $date);
          
  if($totalbookings==10){
          $calendar.="<td class='$today'><center><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>All Booked</a>";
        }else{
            $availableslots = 99 - $totalbookings;
            $calendar.="<td class='$today'><center>
            <h3>$currentDay</h3> <a href='userbook.php?date=".$date."' class='btn btn-success btn-xs'>Book</a>
            <br>";
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
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideCare: Booking </title>
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <script defer src="script.js"></script>
<?php $page = 'userappointment';  include ('../inc/header.php');  ?>
</head>
<style>
        body {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }

        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            display: grid;
            grid-template-columns: 65% 35%; 
            gap: 20px;
        }
    </style>
  <body>
    
  <main>

  <div class="form-container">
            <form>
                <?php
                    $dateComponents = getDate();
                    if(isset($_GET['month']) && isset($_GET['year'])){
                        $month = $_GET['month'];
                        $year = $_GET['year'];
                    } else {
                        $month = $dateComponents['mon'];
                        $year = $dateComponents['year'];
                    }
                    echo build_calendar($month, $year);
                ?>
            </form>
            <?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $vehicle = mysqli_real_escape_string($conn, $_POST['vehicle']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $select = mysqli_query($conn, "SELECT * FROM appointment WHERE usertype_id = $usertype_id AND status = 'pending' OR status = 'approve'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        ?>
        <script>
            swal({
                title: "You have Appointment in Process!",
                text: "You can't book right now. Check your booking history.",
                icon: "warning",
                button: "Okay",
              }).then(function() {
                    window.location = "userhistorymenu.php";
                });
        </script> 
        <?php
    } else {
        $sql2 = "INSERT INTO appointment (usertype_id, email, name, date, vehicle, service, mobile) 
                 VALUES ('$usertype_id', '$email', '$name', '$date', '$vehicle', '$service', '$mobile')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            ?>
            <script>
                swal({
                    title: "Booking is Pending",
                    text: "Wait for the confirmation",
                    icon: "success",
                    button: "Okay",
                }).then(function() {
                    window.location = "userhistorymenu.php";
                });
            </script>
            <?php
        } else {
            exit();
        }
    }
}
?>
<?php
$select = mysqli_query($conn, "SELECT * FROM user WHERE usertype_id = '$usertype_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
   $fetch = mysqli_fetch_assoc($select);
}?>
        <form action="" method="post" class="form">
        <H3>APPOINTMENT DETAILS</H3><BR>
        <div class="form-group">  
            <label class="form-label">Selected Book Date</label><br>       
            <input readonly class="form-control" id="date" name="date" type="text" value="<?php echo date('F d, Y', strtotime($date)); ?>"/>
        </div>
        
            <div class="form-group"> 
            <label class="form-label">Enter your Full Name</label><br>
            <input readonly class="form-control" id="name" name="name" type="text" value="<?php echo $fetch['firstname'] . ' ' . $fetch['lastname']; ?>"/>
            </div>

            <div class="form-group">
            <label class="form-label">Enter your Email</label><br>
            <input readonly class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" type="email" value="<?php echo $fetch['email']?>"/>
            </div>
                
            <div class="form-group">
            <label  class="form-label">Enter your Phone Number</label><br>
            <input readonly class="form-control" pattern="^(09|\+639)\d{9}$" id="mobile" name="mobile" type="mobile"  placeholder="Phone Number (09 or 639)" value="<?php echo $fetch['mobile']; ?>"/>
            </div>
            <?php
              $select = mysqli_query($conn, "SELECT * FROM vehicle WHERE usertype_id = '$usertype_id'") or die('query failed');
              ?>
              <div class="form-group">
                  <label class="form-label">Motorcycle Vehicle <a class="btn btn-dark" href="uservehicleadd.php" type="submit" name="submit" style="color: white;">ADD MOTORCYCLE</a></label>
                  <br>
                  <select required class="form-select" id="vehicle" name="vehicle">
                      <option class="col-md-8 fs-6" selected disabled>Select Vehicle</option>
                      <?php
                      // Check if any rows are returned
                      if(mysqli_num_rows($select) > 0){
                          // Loop through each row
                          while($vehicle = mysqli_fetch_assoc($select)){
                              // Output option for each vehicle
                              echo '<option value="' . $vehicle['vehicle'] . '">' . $vehicle['vehicle'] . '</option>';
                          }
                      } else {
                          // If no vehicles found
                          echo '<option class="col-md-8 fs-4" disabled>No vehicles found</option>';
                      }
                      ?>
                  </select>            
              </div>
          
            <div class="form-group">
            <label  class="form-label">Service Request</label><br>
            <select required class="form-select" id="service" name="service">
                <option class="col-md-8 fs-6" selected disabled>Select Service</option>
              <?php
                // Execute query to fetch options from the status table
                $select = mysqli_query($conn, "SELECT * FROM service WHERE status = 'active'") or die('Query failed');

                // Check if there are rows returned from the query
                if(mysqli_num_rows($select) > 0) {
                    // Loop through each row of the result set
                    while($service = mysqli_fetch_assoc($select)) {
                        // Print the option element for each row
                        echo '<option value="' . $service['name'] . '">' . $service['name'] . '</option>';
                    }
                } else {
                    // If no rows are returned, display a default option
                    echo '<option disabled>No statuses found</option>';
                }
                ?>
              </select>
            </div>
            <br>
            <button class="btn btn-primary" type="submit" name="submit" style="float: right;">Submit</button>

            </div>
      </div>
    </div></form>   
    <br><br><br>

   
  </div>
  </div>

<?php include "../inc/footer.php"; ?>  

    
  </body>
</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>
 