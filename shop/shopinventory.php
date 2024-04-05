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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title>RideCare SHOP: Inventory</title>
</head>
<body>
<?php include '../inc/sidebarshop.php';  ?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Inventory</h1>
        </div>
        <a type="button" class="btn-download" data-toggle="modal" data-target="#addProductModal">
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
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rider['id']; ?></td>
                <td><?php echo $rider['name']; ?></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rider['quantity']; ?></td>
                <td>&nbsp;&nbsp;&nbsp;<?php echo $rider['amount']; ?></td>
                <td>
                    <button class="btn btn-primary" onclick="getProduct(<?= $rider['id']; ?>)"><i class="bx bx-edit"></i></button>
                    <button class="btn btn-danger" onclick="deleteProduct(<?= $rider['id']; ?>)"><i class="bx bx-trash"></i></button>
                </td>
            </tr>
            <?php
        }
    ?>
    </tbody>
</table>
</div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductModalLabel">Product Details</h1>
            </div>
            <div class="modal-body">
            <form id="addProductForm">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" id="namex"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantityx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amountx">
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addProduct()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Product Details</h1>
            </div>
            <div class="modal-body">
            <form  action="viewBookForm">
                <input  class="form-control" id="productid" hidden>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" id="name"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editProduct()">Submit</button>
            </div>
        </div>
    </div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
         $(document).ready(function() {
            // DataTable initialization
            var table = $('#example').DataTable();

        });
</script>
<script>
    function addProduct() {
    var name = $('#namex').val();
    var quantity = $('#quantityx').val();
    var amount = $('#amountx').val();
    console.log(name);
    // Create an object to hold the form data
    var formData = {
        name: name,
        quantity: quantity,
        amount: amount
    };    
        $.ajax({
            url: 'shopinventoryfunction.php',
            type: 'POST',
            data: {action: 'addProduct', formData},
            success: function(response) {
                swal({
                title: "Product Added Successfully!",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then((value) => {
                location.reload(); // Reload the page
            });
            },
            error: function(xhr, status, error) {
                // Handle error response here
                console.error('Error:', error);
            }
        });
    }

function getProduct(id) {
    $.ajax({
        url: 'shopinventoryfunction.php', 
        type: 'GET',
        data: { action: 'getProduct', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#productid').val(data.id);
                $('#name').val(data.name);
                $('#quantity').val(data.quantity);
                $('#amount').val(data.amount);

                console.log(data); // Assuming you have an element with id="serviceInfo" to display the service
                $('#viewProductModal').modal('show');
            } else {
                alert('Service not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function editProduct() {
    var id = $('#productid').val();
    var name = $('#name').val();
    var quantity = $('#quantity').val();
    var amount = $('#amount').val();
    $.ajax({
        url: 'shopinventoryfunction.php', 
        type: 'POST',
        data: { action: 'editProduct', id: id, name: name, quantity: quantity, amount: amount }, 
        success: function(response) {
            swal({
                title: "Product Updated Successfully!",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then((value) => {
                location.reload(); // Reload the page
            });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

function deleteProduct(id) {
    $.ajax({
        url: 'shopinventoryfunction.php', 
        type: 'DELETE', 
        data: { action: 'deleteProduct', id: id }, 
        success: function(response) {
            swal({
                title: "Product Deleted Successfully!",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then((value) => {
                location.reload(); // Reload the page
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
</script>
</body>
</html>