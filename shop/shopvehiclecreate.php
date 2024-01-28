<?php 
session_start();
include "../db_conn.php";
$page = 'shopriders';
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
	<title>RideCare SHOP: Payment</title>

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
					<h1>Motorcycle Vehicle</h1>
					<ul class="breadcrumb">
						<li>
						<a class="hide" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shoppaymentrider.php">Riders</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopmessage.php">Main Menu</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopmessage.php">Motorcycle Vehicle</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopmessage.php">Create Motorcycle Vehicle</a>
						</li>
					</ul>
				</div>
			</div>
            <?php 
    if(isset($_GET['usertype_id'])) { ?>
			<div class="table-data">
				<div class="order">
                <form id="form_signup" action="" method="POST" class="form" enctype="multipart/form-data">
    <label for="date">Purchase Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="vehicle">Vehicle:</label>
    <select required name="vehicle" style="padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; color: #333; width: 300px; appearance: none;">            <option selected disabled>SELECT MOTORCYCLE</option>
            <option value="Honda Genio 110">Honda Genio 110</option>
    <option value="Honda BeAT 110">Honda BeAT 110</option>
    <option value="Honda Click 125">Honda Click 125</option>
    <option value="Honda Click 150i">Honda Click 150i</option>
    <option value="Honda AirBlade 160">Honda AirBlade 160</option>
    <option value="Honda PCX 160">Honda PCX 160</option>
    <option value="Honda X-ADV 750">Honda X-ADV 750</option>
    <option value="Suzuki Address 115">Suzuki Address 115</option>
    <option value="Suzuki Skydrive 125">Suzuki Skydrive 125</option>
    <option value="Suzuki Burgman 400">Suzuki Burgman 400</option>
    <option value="Yamaha Mio Sporty 115">Yamaha Mio Sporty 115</option>
    <option value="Yamaha Mio i125">Yamaha Mio i125</option>
    <option value="Yamaha Mio Soul i125">Yamaha Mio Soul i125</option>
    <option value="Yamaha NMAX 155">Yamaha NMAX 155</option>
    <option value="Yamaha Mio Aerox 155">Yamaha Mio Aerox 155</option>
    <option value="Yamaha Tricity 125">Yamaha Tricity 125</option>
    <option value="Yamaha XMAX 300">Yamaha XMAX 300</option>
    <option value="Yamaha Tmax SX 530">Yamaha Tmax SX 530</option>
            </select>
<br><br>
   <label for="plate">Plate Number:</label>
   <input type="text" id="plate" name="plate" required>
            <br><br>
    <label for="color">Color:</label>
    <input type="number" id="color" name="color" required>

    <input type="hidden" name="usertype_id" value="<?php echo $_GET['usertype_id']; ?>">

    <br>

    <button class="btn btn-light" value="submit" name="submit" type="submit">Submit</button>
</form>

<script>
    <?php
    if (isset($_POST['submit'])) {
        $purchasedate = $_POST['purchasedate'];
        $name = $_POST['name'];
        $vehicle = $_POST['vehicle'];
        $plate = $_POST['plate'];
        $color = $_POST['color'];
        $usertype_id = $_POST['usertype_id'];

        $sql = "INSERT INTO vehicle(purchasedate, name, vehicle, plate, color, usertype_id) VALUES('$purchasedate', '$name', '$vehicle', '$platenumber', '$color', '$usertype_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
    ?>
            swal({
                title: "Vehicle Created Successfully",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then(function() {
    window.location = "shopvehiclecreate.php?usertype_id=<?php echo $usertype_id; ?>";
});
    <?php
        }
    } }
    ?>
</script>


</head>
<body>
    
