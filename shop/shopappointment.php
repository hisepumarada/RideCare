<?php 
session_start();
include "../db_conn.php";
$page = 'shopbook';
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
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<title>RideCare SHOP: Appointment</title>
</head>
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
<body>
<?php include '../inc/sidebarshop.php';  ?>

<main>
  <h1>APPOINTMENTS</h1>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-plus' ></i>
					<span class="text">
          <p>For Approval Books</p>
					<?php 
	  $dash_post_query = "SELECT * FROM appointment WHERE status = 'pending'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);
      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo ' 
    <h3>'.$post_total.' </h3>';
      }else{
        echo '<h3> NO PENDING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="shopapprovalbook.php">Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
                    <p>For Today Books</p>
					<?php
	  $dash_post_query = "SELECT * FROM appointment WHERE status = 'approved' AND date =CURDATE()";
      $dash_post_query = mysqli_query($conn, $dash_post_query);
      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>';
      }else{
        echo '<h3> NO ON GOING </h3>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="shoptoday.php">Click for details</a>
					</span>
				</li>
                <li>
					<i class='bx bx-calendar' ></i>
					<span class="text">
                    <p>All Completed Appointment</p>
					<?php
      $dash_post_query = "SELECT * FROM appointment WHERE status='completed'";
      $dash_post_query = mysqli_query($conn, $dash_post_query);

      if($post_total = mysqli_num_rows($dash_post_query))
      {
        echo '
    <h3>'.$post_total.' </h3>
		';
      }else{
        echo '<p> NO COMPLETED BOOKING </p>';
      }
      ?><a type="button" style="color: black;" class="btn btn-outline-primary" href="shopcompleteappointment.php">Click for details</a>
					</span>
				</li>
			</ul>



<div class="table-data">
  <div class="order">
      <div class="head">
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <h1>ALL OF RideCare Appointments</h1>
      </div>
      <table id="example" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>Appointment</th>
                  <th>Name</th>
                  <th>Vehicle</th>
                  <th>Service</th>
                  <th>Status</th>
              </tr>
          </thead>
          <tbody>
              <?php 
              $query = "SELECT * FROM appointment";
              $query_run = mysqli_query($conn, $query);

              if(mysqli_num_rows($query_run) > 0) {
                  foreach($query_run as $row) {
              ?>
              <tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= date('F j, Y', strtotime($row['date'])); ?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['name']; ?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['vehicle']; ?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['service']; ?></td>
                  <td><?= $row['status']; ?></td>
              </tr>
              <?php
                  }
              } else {
                  echo "<tr><td colspan='3' class='text-center'>No Record Found</td></tr>";
              }
              ?>                            
          </tbody>
      </table>
  </div>
</div>     
</main>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
         $(document).ready(function() {
            // DataTable initialization
            var table = $('#example').DataTable();

        });
</script>
</body>
</html>