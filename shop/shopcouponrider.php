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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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
  
                <a type="button" class="btn-download" data-toggle="modal" data-target="#addCouponModal">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD COUPON</span>
				</a>
			</div>
       
        

<div class="table-data">
     <div class="order">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Coupon ID</th>
                <th>Date</th>
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
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rider['id']; ?></td>
                    <td><?php echo date('F j, Y', strtotime($rider['date'])); ?></td>
                    <td><?php echo $rider['vehicle']; ?></td>
                    <td><?php echo $rider['service']; ?></td>
                    <td><?php echo $rider['odometer']; ?></td>   
                    <td>
                        <button class="btn btn-primary" onclick="getCoupon(<?= $rider['id']; ?>)"><i class="bx bx-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteCoupon(<?= $rider['id']; ?>)"><i class="bx bx-trash"></i></button>
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
<div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addServiceModalLabel">Coupon Details</h1>
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
                        <label class="form-label">Appointment Date</label>
                        <input class="form-control" id="date"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <input type="text" class="form-control" id="service">
                    </div>  
                    <div class="mb-3">
                        <label class="form-label">Vehicle</label>
                        <input type="text" class="form-control" id="vehicle">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Odometer</label>
                        <input type="text" class="form-control" id="odometer">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Coupon Type</label>
                        <input type="text" class="form-control" id="type">
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addCoupon()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="viewCouponModal" tabindex="-1" role="dialog" aria-labelledby="viewCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewCouponModalLabel">Coupon Details</h1>
            </div>
            <div class="modal-body">
            <form id="viewCouponForm">   
                   <input hidden class="form-control" id="couponidx"></input>
                    <div class="mb-3">
                        <label class="form-label">Appointment Date</label>
                        <input class="form-control" id="datex"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="namex">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <input type="text" class="form-control" id="servicex">
                    </div>  
                    <div class="mb-3">
                        <label class="form-label">Vehicle</label>
                        <input type="text" class="form-control" id="vehiclex">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Odometer</label>
                        <input type="text" class="form-control" id="odometerx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Coupon Type</label>
                        <input type="text" class="form-control" id="typex">
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editCoupon()">Submit</button>
            </div>
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
    function addCoupon() {
    var usertype_id = $('#usertype_id').val();
    var date = $('#date').val();
    var name = $('#name').val();
    var service = $('#service').val();
    var vehicle = $('#vehicle').val();
    var odometer = $('#odometer').val();
    var type = $('#type').val();
    
    // Create an object to hold the form data
    var formData = {
        usertype_id: usertype_id,
        date: date,
        name: name,
        service: service,
        vehicle: vehicle,
        odometer: odometer,
        type: type
    };    
        $.ajax({
            url: 'shopcouponfunction.php',
            type: 'POST',
            data: {action: 'addCoupon', formData},
            success: function(response) {
                swal({
                title: "Coupon Added Successfully!",
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
function getCoupon(id) {
    $.ajax({
        url: 'shopcouponfunction.php', 
        type: 'GET',
        data: { action: 'getCoupon', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#couponidx').val(data.id);
                $('#datex').val(data.date);
                $('#namex').val(data.name);
                $('#servicex').val(data.service);
                $('#vehiclex').val(data.vehicle);
                $('#odometerx').val(data.odometer);
                $('#typex').val(data.type);
                
                console.log(data); // Assuming you have an element with id="serviceInfo" to display the service
                $('#viewCouponModal').modal('show');
            } else {
                alert('Service not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function editCoupon(id) {
    var id = $('#couponidx').val();
    var date = $('#datex').val();
    var name = $('#namex').val();
    var service = $('#servicex').val();
    var vehicle = $('#vehiclex').val();
    var odometer = $('#odometerx').val();
    var type = $('#typex').val();
    
    // Create an object to hold the form data
    var formData = {
        id: id,
        date: date,
        name: name,
        service: service,
        vehicle: vehicle,
        odometer: odometer,
        type: type
    };

    $.ajax({
        url: 'shopcouponfunction.php', 
        type: 'POST',
        data: { action: 'editCoupon', formData: formData }, // Pass formData
        success: function(response) {
            swal({
                title: "Coupon Updated Successfully!",
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


function deleteCoupon(id) {
    $.ajax({
        url: 'shopcouponfunction.php', 
        type: 'DELETE', // Change type to POST
        data: { action: 'deleteCoupon', id: id }, 
        success: function(response) {
            swal({
                title: "Coupon Deleted Successfully!",
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

