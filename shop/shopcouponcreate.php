<?php 
session_start();
include "../db_conn.php";
$page = 'shoppayment';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleshop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<title>RideCare SHOP: Coupon</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>
<style>



        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 50%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
<body>	

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Coupon</h1>
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
						<a class="hide" href="shopdashboard.php">Coupon</a>
						</li>	
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Create Coupon</a>
						</li>			
					</ul>
				</div>
			</div>
            <?php 
    if(isset($_GET['usertype_id'])) { ?>
			<div class="table-data">
				<div class="order">
                <form id="form_signup" action="" method="POST" class="form" enctype="multipart/form-data">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="vehicle">Vehicle:</label>
    <input type="text" id="vehicle" name="vehicle" required>

    <label for="service">Service:</label>
    <select required name="service" style=" padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; color: #333; width: 200px;">
            <option selected disabled>Select</option>
            <option value="Change Engine Oil">Change Engine Oil</option>
            <option value="Change Gear Oil">Change Gear Oil</option>
            <option value="Change Gear and Engine Oil">Both</option>
            </select>
    <label for="odometer">Odometer:</label>
    <input type="number" id="odometer" name="odometer" required>

    <input type="hidden" name="usertype_id" value="<?php echo $_GET['usertype_id']; ?>">

    <br>

    <button class="btn btn-light" value="submit" name="submit" type="submit">Submit</button>
</form>

<script>
    <?php
    if (isset($_POST['submit'])) {
        $date = $_POST['date'];
        $name = $_POST['name'];
        $vehicle = $_POST['vehicle'];
        $odometer = $_POST['odometer'];
        $service = $_POST['service'];
        $usertype_id = $_POST['usertype_id'];

        $sql = "INSERT INTO coupon(date, name, vehicle, odometer, service, usertype_id) VALUES('$date', '$name', '$vehicle', '$odometer', '$service', '$usertype_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
    ?>
            swal({
                title: "Coupon Submitted successfully",
                text: "We will take care of it!",
                icon: "success",
                button: "Okay!",
            }).then(function() {
    window.location = "shopcouponrider.php?usertype_id=<?php echo $usertype_id; ?>";
});
    <?php
        }
    } }
    ?>
</script>


</head>
<body>
    
