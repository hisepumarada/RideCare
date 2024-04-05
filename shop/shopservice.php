<?php 
session_start();
include "../db_conn.php";
$page = 'shopservice';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
	<title>RideCare SHOP: SERVICE</title>

<?php include "../inc/sidebarshop.php"; ?>
<body>	

		<!-- MAIN -->
<main>
<div class="head-title">
    <div class="left">
        <h1>SERVICE</h1>
    </div>
    <a type="button" class="btn-download" data-toggle="modal" data-target="#addServiceModal">
    <i class="bx bx-add-to-queue"></i>
    <span class="text">ADD SERVICE</span>
</a>
</div>

 <!-- TABLE OF SERVICE  -->
<div class="table-data">
    <div class="order">
        <div class="head">
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM service";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) {
                    foreach($query_run as $row) {
                ?>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['service']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <button class="btn btn-primary" onclick="getService(<?= $row['id']; ?>)"><i class="bx bx-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteService(<?= $row['id']; ?>)"><i class="bx bx-trash"></i></button>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No Record Found</td></tr>";
                }
                ?>                            
            </tbody>
        </table>
    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addServiceModalLabel">Service Details</h1>
            </div>
            <div class="modal-body">
            <form id="addServiceForm">
                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <input class="form-control" id="servicex"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Created</label>
                        <input type="text" class="form-control" id="createdx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="statusx">
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addService()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="viewServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Service Details</h1>
            </div>
            <div class="modal-body">
            <form  action="viewBookForm">
                <input  class="form-control" id="serviceid" hidden>
                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <input class="form-control" id="service"></input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Created</label>
                        <input type="text" class="form-control" id="created">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" id="status">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editService()">Submit</button>
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
    function addService() {
    var service = $('#servicex').val();
    var created = $('#createdx').val();
    var status = $('#statusx').val();
    
    // Create an object to hold the form data
    var formData = {
        service: service,
        created: created,
        status: status
    };    
        $.ajax({
            url: 'shopservicefunction.php',
            type: 'POST',
            data: {action: 'addService', formData},
            success: function(response) {
                swal({
                title: "Service Added Successfully!",
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
function getService(id) {
    $.ajax({
        url: 'shopservicefunction.php', 
        type: 'GET',
        data: { action: 'getService', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#serviceid').val(data.id);
                $('#service').val(data.service);
                $('#created').val(data.created);
                $('#status').val(data.status);

                console.log(data); // Assuming you have an element with id="serviceInfo" to display the service
                $('#viewServiceModal').modal('show');
            } else {
                alert('Service not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function editService(id) {
    var id = $('#serviceid').val();
    var status = $('#status').val();
    console.log(status);
    $.ajax({
        url: 'shopservicefunction.php', 
        type: 'POST',
        data: { action: 'editService', id: id, status: status }, 
        success: function(response) {
            swal({
                title: "Service Updated Successfully!",
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

function deleteService(id) {
    $.ajax({
        url: 'shopservicefunction.php', 
        type: 'DELETE', // Change type to POST
        data: { action: 'deleteService', id: id }, 
        success: function(response) {
            swal({
                title: "Service Deleted Successfully!",
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