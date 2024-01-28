<?php 
session_start();
include "../db_conn.php";
$page = 'shoppayment';
if(isset($_GET['payment_id']))
{
$payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);
if(isset($_POST['update_profile'])){
  
    $update_date = mysqli_real_escape_string($conn, $_POST['update_date']);
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_vehicle = mysqli_real_escape_string($conn, $_POST['update_vehicle']);
    $update_status = mysqli_real_escape_string($conn, $_POST['update_status']);
    $update_amount = mysqli_real_escape_string($conn, $_POST['update_amount']);
    
 
    mysqli_query($conn, "UPDATE `payment` SET date = '$update_date', name = '$update_name',
    vehicle = '$update_vehicle', status='$update_status', amount='$update_amount' WHERE payment_id = '$payment_id'") or die('query failed');
}
}
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
					<h1>Payment</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="shopmessage.php">Payment</a>
						</li>
					</ul>
				</div>
			</div>
            <?php
    if(isset($_GET['payment_id']))
                {
      $payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);
      $select = mysqli_query($conn, "SELECT * FROM payment WHERE payment_id = '$payment_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }?>
			<div class="table-data">
				<div class="order">
                    <h3>PAYMENT ID: <?php echo $fetch['payment_id'];?></h3>
                    <br>
                <form id="form signup" action="" method="POST" class="form" enctype="multipart/form-data">
    
    <label for="date">Date:</label>
    <input type="date" id="update_date" name="update_date" required value="<?php echo $fetch['date'];?>">

    <label for="name">Name:</label>
    <input type="text" id="update_name" name="update_name" required value="<?php echo $fetch['name'];?>">

    <label for="vehicle">Vehicle:</label>
    <input type="text" id="update_vehicle" name="update_vehicle" required value="<?php echo $fetch['vehicle'];?>">
     
    <label for="status">Status:</label>
    <select required name="update_status" style="font: size 25px;">
            <option selected><?php echo $fetch['status'];?></option>
            <option value="DUE">DUE</option>
            <option value="IN PROCESS">IN PROCESS</option>
            <option value="COMPLETE">COMPLETE</option>
            </select>
<br>
    <label for="amount">Amount:</label>
    <input type="number" id="update_amount" name="update_amount" required value="<?php echo $fetch['amount'];?>">
<br>
<button class="btn btn-primary mr-3" type="submit" value="update_profile" name="update_profile">Save Changes</button>
</form>

				</div>
			</div>
    </form>
            <?php
    }
?>
		</main>
		<!-- MAIN -->
        <?php
if (isset($_POST['update_profile'])){

    $update_date = mysqli_real_escape_string($conn, $_POST['update_date']);
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_vehicle = mysqli_real_escape_string($conn, $_POST['update_vehicle']);
    $update_status = mysqli_real_escape_string($conn, $_POST['update_status']);
    $update_amount = mysqli_real_escape_string($conn, $_POST['update_amount']);
    
 
    mysqli_query($conn, "UPDATE `payment` SET date = '$update_date', name = '$update_name',
    vehicle = '$update_vehicle', status='$update_status', amount='$update_amount' WHERE payment_id = '$payment_id'") or die('query failed');
     ?>
     <script>
     swal({
      title: "Account Update is Success",
      text: "",
      icon: "success",
      button: "Okay!",
   }).then(function() {
    window.location = "shoppaymentrider.php?usertype_id=<?php echo $fetch['usertype_id'];?>";
});
    </script>  
<?php
}
 ?>
</head>
<body>
    
