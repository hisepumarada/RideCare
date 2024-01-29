<?php 
session_start();
include "../db_conn.php";
$page = 'shopinventory';
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
							<a class="hide" href="shopmessage.php">Inventory</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopmessage.php">Edit Product</a>
						</li>
					</ul>
				</div>
			</div>
            <?php
    if(isset($_GET['product_id']))
                {
      $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
      $select = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$product_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }?>
			<div class="table-data">
				<div class="order">
                    <h3>Product ID: <?php echo $fetch['product_id'];?></h3>
                    <br>
                    <form id="form_signup" action="" method="POST" class="form" enctype="multipart/form-data">

<label for="name">Product Name:</label>
<input type="text" id="update_name" name="update_name" required  value="<?php echo $fetch['name'];?>">


<label for="quantity">Quantity Item:</label>
<input type="number" id="update_quantity" name="update_quantity" required value="<?php echo $fetch['quantity'];?>">

<label for="amount">Amount:</label>
<input type="number" id="update_amount" name="update_amount" required  value="<?php echo $fetch['amount'];?>">
<br><br>

<button class="btn btn-light" value="submit" name="submit" type="submit">Submit</button>
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
if (isset($_POST['submit'])){

    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_quantity = mysqli_real_escape_string($conn, $_POST['update_quantity']);
    $update_amount = mysqli_real_escape_string($conn, $_POST['update_amount']);

    
 
    mysqli_query($conn, "UPDATE `product` SET  name = '$update_name',
    quantity = '$update_quantity', amount='$update_amount' WHERE product_id = '$product_id'") or die('query failed');
     ?>
     <script>
     swal({
      title: "Product Update is Success",
      text: "",
      icon: "success",
      button: "Okay!",
   }).then(function() {
    window.location = "shopinventoryedit.php?product_id=<?php echo $fetch['product_id'];?>";
});
    </script>  
<?php
}
 ?>
</head>
<body>
    
