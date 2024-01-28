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
		<!-- MAIN -->
		
        <main>
			<div class="head-title">
				<div class="left">
					<h1>Main Menu</h1>
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
					</ul>
				</div>
			</div>
			
	<?php 
    if(isset($_GET['usertype_id']))
    {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        ?>
        <ul class='box-info'>
            <li>
                <i class='bx bxs-time-five' ></i>
                <span class='text'>
                    <h3>MAINTENANCE OF VEHICLE</h3>
                    <a type='button' style='color: black;' class='btn btn-outline-primary' href='shopduerider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>
                </span>
            </li>
			<li>
					<i class='bx bxs-coupon' ></i>
					<span class='text'>
                    <h3>COUPONS AND DISCOUNTS</h3>
					<a type='button' style='color: black;' class='btn btn-outline-primary' href='shopcouponrider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>	
				</span>
				</li>
				<li>
					<i class='bx bx-money' ></i>
					<span class='text'>
					<h3>PAYMENT STATEMENTS</h3>
                    <a type='button' style='color: black;' class='btn btn-outline-primary' href='shoppaymentrider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>
					</span>
				</li>
		</ul>
		<ul class='box-info'>
		<li>
					<i class='bx bxs-calendar' ></i>
					<span class='text'>
					<h3>COMPLETE APPOINTMENTS</h3>
                    <a type='button' style='color: black;' class='btn btn-outline-primary' href='shopbookrider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bx-cycling' ></i>
					<span class='text'>
					<h3>MOTORCYCLE VEHICLE</h3>
                    <a type='button' style='color: black;' class='btn btn-outline-primary' href='shopvehiclerider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>
					</span>
				</li>
				<li>
					<i class='bx bx-user-circle' ></i>
					<span class='text'>
					<h3>RIDER INFORMATION </h3>
                    <a type='button' style='color: black;' class='btn btn-outline-primary' href='shopinforider.php?usertype_id=<?php echo $usertype_id; ?>'>Click for details</a>
					</span>
				</li>
        </ul>
		</main>
        <?php
    }
?>

</body>
</html>

