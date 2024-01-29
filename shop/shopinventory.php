<?php 
session_start();
include "../db_conn.php";
$page = 'shopinventory';
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>RideCare SHOP: Inventory</title>
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
    .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style for the title */
        .card h2 {
            color: #333;
        }

        /* Style for the content */
        .card p {
            color: #666;
        }

        /* Style for the image */
        .card img {
            max-width: 100%;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        /* Style for the form */
        .card form {
            margin-top: 10px;
        }

        /* Style for the input and button */
        .card input, .card button {
            margin-right: 5px;
        }
</style>
</head>
<body>
<?php include '../inc/sidebarshop.php';  ?>

<main>
			<div class="head-title">
				<div class="left">
					<h1>Inventory</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="shopappointment.php">Inventory</a>
						</li>
					</ul>
				</div>
                <a href='shopinventorycreate.php' class="btn-download">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD PRODUCT</span>
				</a>
			</div>

    <div class="table-data">
     <div class="order">
     <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody style="font-size: larger;">
    <?php 
        $query = "SELECT * FROM product";
        $query_run = mysqli_query($conn, $query);
        
        while($rider = mysqli_fetch_array($query_run)) {
            ?>
            <tr>
                <td><?php echo $rider['product_id']; ?></td>
                <td><?php echo $rider['name']; ?></td>
                <td><?php echo $rider['quantity']; ?></td>
                <td><?php echo $rider['amount']; ?></td>
                <td>
                <form method="POST" action="">
                <a class='btn btn-primary mr-3' href="shopinventoryedit.php?product_id=<?php echo $rider['product_id']; ?>">EDIT</a>
                    <input type="hidden" name="product_id" value="<?php echo $rider['product_id']; ?>"> 
                  <button class='btn btn-danger' type="submit" name="delete_btn">DELETE</button>
                </form>
            </td>
            </tr>
            <?php
        }
    
    ?>
    </tbody>
</table>


    </div>
    </div>
	
    
</main>
<?php
    if(isset($_POST['delete_btn'])) {
    $product_id_to_delete = mysqli_real_escape_string($conn, $_POST['product_id']);
    
    // Perform the deletion query
    $delete_query = "DELETE FROM product WHERE product_id = '$product_id_to_delete'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    ?>
    <script>
    swal({
     title: "Product Deleted is Success",
     text: "",
     icon: "success",
     button: "Okay!",
  }).then(function() {
   window.location = "shopinventory.php";
});
   </script>  
   <?php
}    

?>
</body>
</html>