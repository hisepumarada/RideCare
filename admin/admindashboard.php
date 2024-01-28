<?php 
session_start();
include "../db_conn.php";
$page = 'admindashboard';
$username = $_SESSION['username'];
if (isset($_SESSION['username'])) {

	$DATE = date("Y-m-d");function build_calendar($month, $year){
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
	
		$daysOfWeek = array('SUN','MON','TUE','WED','THU','FRI','SAT');
		$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
		$numberDays = date('t',$firstDayOfMonth);
		$dateComponents = getdate($firstDayOfMonth);
		$monthName = $dateComponents['month'];
		$dayOfWeek = $dateComponents['wday'];
		$prev_month = date('m',mktime(0,0,0, $month-1, 1, $year));
		$prev_year = date('Y',mktime(0,0,0, $month-1, 1, $year));
		$next_month = date('m',mktime(0,0,0, $month+1, 1, $year));
		$next_year = date('Y',mktime(0,0,0, $month+1, 1, $year));
		$calendar = "<center><h1 style='font-size: 40px;'>Appointment Calendar</h1></center><br>";
		$calendar.= "<h1 style='color: black; text-transform: uppercase; font-weight: bold; font-size: 30px;' href='admindashboard.php?month=".date('m')."&year=".date('Y')."'>$monthName, $year</h1>";
		$calendar.= "<a style='color: black; float: right;' href='admindashboard.php?month=".$next_month."&year=".$next_year."'> &nbsp; &nbsp;NEXT > </a>";
		$calendar.= "<a style='color: black; float: right;'  href='admindashboard.php?month=".$prev_month."&year=".$prev_year."'> < PREV </a>";
		$calendar.="<center><div class='table-responsive'><table class='table table-bordered'>";
		$calendar .= "<br><tr>";
		foreach($daysOfWeek as $day) {
			 $calendar .= "<th style='background-color: dark; text-align: center;'>$day</th>";
		} 
		$currentDay = 1;
		$calendar .= "</tr><tr>";
		if ($dayOfWeek > 0) { 
			for($k=0;$k<$dayOfWeek;$k++){
				   $calendar .= "<td style='width: 100px; height: 50px; text-align: center;' class='empty'></td>"; 
			}
		}
		$month = str_pad($month, 2, "0", STR_PAD_LEFT);
		while ($currentDay <= $numberDays) {
			 if ($dayOfWeek == 7) {
				  $dayOfWeek = 0;
				  $calendar .= "</tr><tr>";
			 }
			 $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
			 $date = "$year-$month-$currentDayRel";
			 
			   $dayname = strtolower(date('l', strtotime($date)));
			   $eventNum = 0;
			   $today = $date==date('Y-m-d')? "today" : "";	
			if($dayname=='sunday'){
				$calendar.="<td style='width: 100px; height: 50px; text-align: center;' class='$today'>
				<br><p>$currentDay</p><br><br><br></td>";
			}else{		
			$totalbookings = checkSlots($mysqli,$date);
			if($totalbookings==10){
				$calendar .= "<td style='width: 100px; height: 50px; text-align: center;' class='$today'>
				<p style='color: green;' href='adminviewbook.php?date=".$date."'><p>$currentDay</p><br>$totalbookings clients</p>";
			}else{
				$availableslots = $totalbookings;
				$calendar .= "<td style='width: 100px; height: 50px; text-align: center;' class='$today'>
				<p style='color: black;' href='adminviewbook.php?date=".$date."'><p>$currentDay</p>
				<br><p style='color: green;'>$availableslots client </p></p>";
			} 
		}
			 $calendar .="</td>";
			 $currentDay++;
			 $dayOfWeek++;
		}
		if ($dayOfWeek != 7) { 
			 $remainingDays = 7 - $dayOfWeek;
			   for($l=0;$l<$remainingDays;$l++){
				   $calendar .= "<td style='width: 100px; height: 50px; text-align: center;' class='empty'></td>"; 
			}
		}
		$calendar .= "</tr>";
		$calendar .= "</table>";
	
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	
	<!-- My CSS -->
	<title>RideCare (ADMIN): DASHBOARD</title>
</head>
<body>


	<!-- SIDEBAR -->
<?php include '../inc/sidebaradmin.php';  ?>
	<!-- SIDEBAR -->
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>


			<div class="table-data">
				<div class="order">
					
					<table>
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
   ?></table>
				</div>
				
        
        
        
        <div class="todo">
					<div class="head">
					<h3>Appointment for Today</h3>
					<a type="button" style="color: black;" class="btn btn-outline-primary" href="adminbook.php">Click for details</a>
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
							</tr>
						</thead>
            <?php 
        $riders = mysqli_query($conn,"SELECT * FROM appointment WHERE DATE = CURDATE()") or die(mysqli_error($conn));
        if($riders)
        {
            if(mysqli_num_rows($riders) > 0)
            {
                foreach($riders as $row) 
                {
             ?>
						<tbody>
							<tr>
								<td>
									<p><?= $row['name']; ?></p>
								</td>
								<td><?= $row['email']; ?></td>
							<td><span class="status <?php {echo $row['status'];}?>"><?= $row['status']; ?></span></td>

							</tr>
              <?php }}else
                                    {
                                        echo "<td colspan='6' style='font-size: 40px; text-align: center;'><br><br>No Record Found for Today<br><br><br></td>
										<td></td>";
                                    }}?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>
<?php 
}else{
     header("Location: adminindex.php");
     exit();
}
 ?>