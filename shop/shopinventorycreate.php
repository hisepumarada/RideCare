<?php 
session_start();
include "../db_conn.php";
$page = 'shopinventory';
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
					<h1>Create Product</h1>
					<ul class="breadcrumb">
						<li>
						<a class="hide" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shoppaymentrider.php">Inventory</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopmessage.php">Create Product</a>
						</li>
					</ul>
				</div>
			</div>
    
			<div class="table-data">
				<div class="order">
                <form id="form_signup" action="" method="POST" class="form" enctype="multipart/form-data">

    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required>

    
    <label for="quantity">Quantity Item:</label>
    <input type="number" id="quantity" name="quantity" required>

    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required>
    <br><br>

    <button class="btn btn-light" value="submit" name="submit" type="submit">Submit</button>
</form>

<script>
    <?php
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $amount = $_POST['amount'];

        $sql = "INSERT INTO product(name, quantity, amount) VALUES('$name', '$quantity', '$amount')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
    ?>
            swal({
                title: "Product submitted successfully",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then(function() {
    window.location = "shopinventory.php";
});
    <?php
        }
    } 
    ?>
</script>


</head>
<body>
    
