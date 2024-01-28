<?php 
session_start();
include "../db_conn.php";
$page = 'adminreports';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<title>RideCare (ADMIN): MESSAGE</title>
<style>
	    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		.row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
</style>
<?php include '../inc/sidebaradmin.php';  ?>

<main>
			<div class="head-title">
				<div class="left">
					<h1>Reports</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="adminreports.php">Reports</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
					<?php 
	  $dash_post_query = "SELECT * FROM appointment WHERE status = 'process'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>In Process Appointment</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminbook.php">Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<?php
	  $dash_post_query = "SELECT * FROM user WHERE usertype ='rider'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>Total of Riders</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminriders.php">Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bxs-envelope' ></i>
					<span class="text">
					<?php
	  $dash_post_query = "SELECT * FROM message";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>Messages</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminmessage.php">Click for details</a>
					</span>
				</li>
			</ul>
      
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
					<?php 
	  $dash_post_query = "SELECT * FROM appointment WHERE status = 'process'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>In Process Appointment</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminbook.php">Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<?php
	  $dash_post_query = "SELECT * FROM user WHERE usertype ='rider'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>Total of Riders</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminriders.php">Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bxs-envelope' ></i>
					<span class="text">
					<?php
	  $dash_post_query = "SELECT * FROM message";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		<p>Messages</p>';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="adminmessage.php">Click for details</a>
					</span>
				</li>
			</ul>


</main>
</head>
<body>
    
</body>
</html>