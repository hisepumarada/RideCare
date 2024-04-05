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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
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

                <a type="button" class="btn-download" data-toggle="modal" data-target="#addPaymentModal">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD PAYMENT</span>
				</a>
			</div>

			<div class="table-data">
				<div class="order">
          <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Status</th>
            <th>Payment ID</th>
            <th>Date</th>
            <th>Vehicle</th>
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
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rider['status']; ?></td>
                <td><?php echo $rider['id']; ?></td>
                <td><?php echo $rider['date']; ?></td>
                <td><?php echo $rider['vehicle']; ?></td>      
                <td><?php echo $rider['amount']; ?></td>
                <td>
                    <button class="btn btn-primary" onclick="getPayment(<?= $rider['id']; ?>)"><i class="bx bx-edit"></i></button>
                    <button class="btn btn-danger" onclick="deletePayment(<?= $rider['id']; ?>)"><i class="bx bx-trash"></i></button>
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

<!-- ADD MODAL -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPaymentModalLabel">Service Details</h1>
            </div>
            <div class="modal-body">
            <form id="addServiceForm">
            <?php 
                if(isset($_GET['usertype_id']))
                {
                $usertype_id = mysqli_real_escape_string($conn, $_GET['usertype_id']);
            ?>
                    <div class="mb-3">
                        <input hidden class="form-control" id="usertype_id" value="<?php echo isset($_GET['usertype_id']) ? htmlspecialchars($_GET['usertype_id']) : ''; ?>">
                    </div>
            <?php
                }
            ?>
                    <div class="mb-3">
                        <label class="form-label">Payment Date</label>
                        <input class="form-control" id="date"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vehicle</label>
                        <input type="text" class="form-control" id="vehicle">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="status">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount">
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addPayment()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Service Details</h1>
            </div>
            <div class="modal-body">
                <form id="addServiceForm">
                            <input  class="form-control" id="paymentidx" hidden>
                        <div class="mb-3">
                            <label class="form-label">Payment Date</label>
                            <input class="form-control" id="datex"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="namex">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vehicle</label>
                            <input type="text" class="form-control" id="vehiclex">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" id="statusx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="text" class="form-control" id="amountx">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editPayment()">Submit</button>
            </div>
        </div>
    </div>
</main>
</section>

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
    function addPayment() {
    var usertype_id = $('#usertype_id').val();
    var date = $('#date').val();
    var name = $('#name').val();
    var vehicle = $('#vehicle').val();
    var status = $('#status').val();
    var amount = $('#amount').val();
    
    // Create an object to hold the form data
    var formData = {
        usertype_id: usertype_id,
        date: date,
        name: name,
        vehicle: vehicle,
        status: status,
        amount: amount
    };    
        $.ajax({
            url: 'shoppaymentfunction.php',
            type: 'POST',
            data: {action: 'addPayment', formData},
            success: function(response) {
                swal({
                title: "Payment Added Successfully!",
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
function getPayment(id) {
    $.ajax({
        url: 'shoppaymentfunction.php', 
        type: 'GET',
        data: { action: 'getPayment', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#paymentidx').val(data.id);
                $('#datex').val(data.date);
                $('#namex').val(data.name);
                $('#vehiclex').val(data.vehicle);
                $('#statusx').val(data.status);
                $('#amountx').val(data.amount);

                console.log(data); // Assuming you have an element with id="serviceInfo" to display the service
                $('#viewPaymentModal').modal('show');
            } else {
                alert('Service not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function editPayment(id) {
    var id = $('#paymentidx').val();
    var date = $('#datex').val();
    var name = $('#namex').val();
    var vehicle = $('#vehiclex').val();
    var status = $('#statusx').val();
    var amount = $('#amountx').val();
    
    // Create an object to hold the form data
    var formData = {
        id: id,
        date: date,
        name: name,
        vehicle: vehicle,
        status: status,
        amount: amount
    };

    $.ajax({
        url: 'shoppaymentfunction.php', 
        type: 'POST',
        data: { action: 'editPayment', formData: formData }, // Pass formData
        success: function(response) {
            swal({
                title: "Payment Updated Successfully!",
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


function deletePayment(id) {
    $.ajax({
        url: 'shoppaymentfunction.php', 
        type: 'DELETE', // Change type to POST
        data: { action: 'deletePayment', id: id }, 
        success: function(response) {
            swal({
                title: "Payment Deleted Successfully!",
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

</head>
<body>
    
