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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Optional: Bootstrap JS and Popper.js Links (if you need Bootstrap features that rely on JavaScript) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>RideCare SHOP: Coupon</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>	

<body>
		<!-- MAIN -->
        <main>
        
        
        <div class="head-title">
				<div class="left">
					<h1>Coupons</h1>
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
						<a class="hide" href="shopdashboard.php">Coupons</a>
						</li>				
					</ul>
				</div>
                <?php 
    if(isset($_GET['usertype_id']))
    {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        ?>
				<a href='shopcouponcreate.php?usertype_id=<?php echo $usertype_id; ?>' class="btn-download">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD COUPON</span>
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
                <th>Coupon ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Vehicle</th>
                <th>Service</th>
                <th>Odometer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        <?php 
    if(isset($_GET['usertype_id'])) {
        $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
        $query = "SELECT * FROM coupon WHERE usertype_id = '$usertype_id' ";
        $query_run = mysqli_query($conn, $query);
        
        while($rider = mysqli_fetch_array($query_run)) {
            ?>
                <tr>
                    <td><?php echo $rider['coupon_id']; ?></td>
                    <td><?php echo $rider['date']; ?></td>
                    <td><?php echo $rider['name']; ?></td>
                    <td><?php echo $rider['vehicle']; ?></td>
                    <td><?php echo $rider['service']; ?></td>
                    <td><?php echo $rider['odometer']; ?></td>   
                    <td>
                    <a class='btn btn-primary mr-3' href="shopcouponedit.php?coupon_id=<?php echo $rider['coupon_id']; ?>">VIEW</a>

<form method="POST" action="">
    <input type="hidden" name="coupon_id" value="<?php echo $rider['coupon_id']; ?>"> <br>
    <button class='btn btn-danger' type="submit" name="delete_btn">DELETE</button>
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
    $coupon_id_to_delete = mysqli_real_escape_string($conn, $_POST['coupon_id']);
    
    // Perform the deletion query
    $delete_query = "DELETE FROM coupon WHERE coupon_id = '$coupon_id_to_delete'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    ?>
    <script>
    swal({
     title: "Coupon Deleted is Success",
     text: "",
     icon: "success",
     button: "Okay!",
  }).then(function() {
   window.location = "shopcouponrider.php?usertype_id=<?php echo $rider['usertype_id']; ?>";
});
   </script>  
   <?php
}    

?>

</body>
</html>

