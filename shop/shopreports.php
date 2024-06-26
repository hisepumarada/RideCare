<?php 
session_start();
include "../db_conn.php";
$page = 'shopreports';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleshop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<title>RideCare SHOP: Reports</title>
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
<?php include '../inc/sidebarshop.php';  ?>

<main>
  <h1>REPORTS</h1>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<p>Number of Appointments</p>
					<?php 
	  $dash_post_query = "SELECT * FROM appointment";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<p>Number of RideCare Users</p>
					<?php
	  $dash_post_query = "SELECT * FROM user WHERE usertype ='rider'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?>
					</span>
				</li>
				<li>
					<i class='bx bx-money' ></i>
					<span class="text">
					<p>Number of Payment</p>
					<?php
	  $dash_post_query = "SELECT * FROM payment";
      $dash_post_query = mysqli_query($conn, $dash_post_query);


      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		';
      }else{
        echo '<h3> NO ON GOING BOOKING </h3>';
      }
      ?>
					</span>
				</li>
			</ul>
			<?php

$dash_post_query = "SELECT * FROM appointment";
$dash_post_query = mysqli_query($conn, $dash_post_query);

if ($post_total_appointments = mysqli_num_rows($dash_post_query)) {
} 

$dash_post_query = "SELECT * FROM user";
$dash_post_query = mysqli_query($conn, $dash_post_query);

if ($post_total_users = mysqli_num_rows($dash_post_query)) {
} 

$dash_post_query = "SELECT * FROM payment";
$dash_post_query = mysqli_query($conn, $dash_post_query);

if ($post_total_payments = mysqli_num_rows($dash_post_query)) {
}


?>

<div class="table-data">
    <div class="order">
        <canvas id="barChart" width="400" height="200"></canvas>
        <script>
            // Get the data from PHP
            var appointments = <?php echo $post_total_appointments; ?>;
            var rideCareUsers = <?php echo $post_total_users; ?>;
            var numberOfPayments = <?php echo $post_total_payments; ?>;

            // Set up the data for the bar chart
            var data = {
                labels: ['Appointments', 'RideCare Users', 'Payments'],
                datasets: [{
                    label: 'Count',
                    data: [appointments, rideCareUsers, numberOfPayments],
                    backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            };

            // Set up the options for the bar chart
            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Get the canvas element and render the bar chart
            var ctx = document.getElementById('barChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        </script>
    </div>
</div>

	 </div></div>
</main>
</head>
<body>
    
</body>
</html>