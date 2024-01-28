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
	<title>RideCare SHOP: Reports</title>
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
			</div>

    <div class="table-data">
     <div class="order">
     <?php
$product_ids = array(); // Initialize an array to store product IDs

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Check if there is at least one row
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Assuming the product ID is stored in the 'product_id' column
        $product_id = $row['product_id'];

        // Check if the product ID is not already in the list
        if (!in_array($product_id, $product_ids)) {
            // Add the product ID to the list
            $product_ids[] = $product_id;

            // Now you can use $product_id in your code
            // For example, you can echo it or use it in further processing


            // Product data
            $title = $row['name'];
            $quantity = $row['quantity'];
            $imageUrl = $row['image'];

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the submitted values
                $addQuantity = isset($_POST['add']) ? (int)$_POST['add'] : 0;
                $subtractQuantity = isset($_POST['subtract']) ? (int)$_POST['subtract'] : 0;

                // Update the quantity
                $quantity = $quantity + $addQuantity - $subtractQuantity;

                // Make sure the quantity doesn't go below 0
                if ($quantity < 0) {
                    $quantity = 0;
                }

                // Update the quantity in the database
                $updateQuery = "UPDATE product SET quantity = $quantity WHERE product_id = " . $product_id;
                mysqli_query($conn, $updateQuery) or die(mysqli_error($conn));
            }

            // Echoing the HTML with PHP variables
            echo '<div class="card">';
            echo '<h2>' . $title . '</h2>';
            echo '<img src="../uploaded_img/' . $imageUrl . '" alt="Product Image" style="max-width: 20%; border-radius: 4px; margin-bottom: 10px;">';
            echo '<p>Quantity: ' . $quantity . '</p>';

            // Form for adding and subtracting items
            echo '<form method="post">';
            echo '<label for="add">Add:</label>';
            echo '<input type="number" name="add" id="add" min="0" value="0">';
            echo '<label for="subtract">Subtract:</label>';
            echo '<input type="number" name="subtract" id="subtract" min="0" value="0">';
            echo '<button type="submit">Update</button>';
            echo '</form>';

            echo '</div>';
        }
    }
} else {
    echo "No product found in the database.";
}

?>


    </div>
    </div>
	
    
</main>
</body>
</html>