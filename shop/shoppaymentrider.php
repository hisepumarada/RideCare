<?php 
session_start();
include "../db_conn.php";
$page = 'shopriders';

if(isset($_POST['delete_btn'])) {
    $payment_id_to_delete = mysqli_real_escape_string($conn, $_POST['payment_id']);
    
    // Perform the deletion query
    $delete_query = "DELETE FROM payment WHERE payment_id = '$payment_id_to_delete'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    ?>
    <script>
    swal({
     title: "Payment Deleted is Success",
     text: "",
     icon: "success",
     button: "Okay!",
  }).then(function() {
   window.location = "shoppaymentedit.php?payment_id=<?php echo $rider['usertype_id']; ?>";
});
   </script>  
   <?php
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>RideCare SHOP: Payment</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>

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
							<a class="hide" href="shopriders.php">Riders</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Main Menu</a>
						</li>	
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
						<a class="hide" href="shopdashboard.php">Payment</a>
						</li>				
					</ul>
				</div>
                <?php 
    if(isset($_GET['usertype_id']))
    {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        ?>
				<a href='shoppaymentcreate.php?usertype_id=<?php echo $usertype_id; ?>' class="btn-download">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD PAYMENT</span>
				</a>
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
            <th>Vehicle</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if(isset($_GET['usertype_id'])) {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        $query = "SELECT * FROM payment WHERE usertype_id = '$usertype_id' ";
        $query_run = mysqli_query($conn, $query);
        
        while($rider = mysqli_fetch_array($query_run)) {
            ?>
            <tr>
                <td><?php echo $rider['payment_id']; ?></td>
                <td><?php echo $rider['date']; ?></td>
                <td><?php echo $rider['name']; ?></td>
                <td><?php echo $rider['vehicle']; ?></td>
                <td><?php echo $rider['status']; ?></td>
                <td><?php echo $rider['amount']; ?></td>
                <td>
                <a class='btn btn-primary mr-3' href="shoppaymentedit.php?payment_id=<?php echo $rider['payment_id']; ?>">EDIT</a>
                <form method="POST" action="">
                    <input type="hidden" name="payment_id" value="<?php echo $rider['payment_id']; ?>">
                   <br> <button class='btn btn-danger' type="submit" name="delete_btn">DELETE</button>
                </form>
            </td>
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
  <?php
    if(isset($_POST['delete_btn'])) {
    $payment_id_to_delete = mysqli_real_escape_string($conn, $_POST['payment_id']);
    
    // Perform the deletion query
    $delete_query = "DELETE FROM payment WHERE payment_id = '$payment_id_to_delete'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    ?>
    <script>
    swal({
     title: "Payment Deleted is Success",
     text: "",
     icon: "success",
     button: "Okay!",
  }).then(function() {
   window.location = "shoppaymentrider.php?payment_id=<?php echo $rider['usertype_id']; ?>";
});
   </script>  
   <?php
}    

?>
</head>
<body>
    
