<?php 
session_start();
include "../db_conn.php";
$page = 'shopriders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<title>RideCare SHOP: Payment</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>	
<body>
<main>
		<!-- MAIN -->
        <?php 
    if(isset($_GET['usertype_id']))
    {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        ?>
        
        <div class="head-title">
				<div class="left">
					<h1>Maintenance Due</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopriders.php">Riders</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Main Menu</a>
						</li>	
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Maintenance Due</a>
						</li>				
					</ul>
				</div>
			</div>
            <?php
    }
?>

<div class="table-data">
     <div class="order">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if(isset($_GET['usertype_id']))
        {
            $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
            $query = "SELECT * FROM appointment WHERE usertype_id = '$usertype_id' AND Date <= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ";
            $query_run = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($query_run) > 0)
            {
                $rider = mysqli_fetch_array($query_run);
                ?>
                <tr>
                    <td><?php echo $rider['id']; ?></td>
                    <td><?php echo $rider['date']; ?></td>
                    <td><?php echo $rider['name']; ?></td>
                    <td><?php echo $rider['mobile']; ?></td>
                    <td><?php echo $rider['email']; ?></td>
                    <td><?php echo $rider['service']; ?></td>    
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
    </div>
			</div>
		</main>
		<!-- MAIN -->
		
	</section>


   
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>

<script>
         $(document).ready(function() {
            // DataTable initialization
            var table = $('#example').DataTable();

        });
</script>

</body>
</html>

