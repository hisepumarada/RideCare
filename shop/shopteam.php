<?php 
session_start();
include "../db_conn.php";
$page = 'shopteam';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<title>RideCare SHOP: Staff</title>

<?php include "../inc/sidebarshop.php"; ?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Team</h1>
        </div>
        <a type="button" class="btn-download" data-toggle="modal" data-target="#addStaffModal">
            <i class='bx bx-add-to-queue' ></i>
            <span class="text">ADD STAFF MEMBER</span>
        </a>
    </div>

<div class="table-data">
<div class="order">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $riders = mysqli_query($conn, "SELECT * FROM employee") or die(mysqli_error($conn));

            if ($riders && mysqli_num_rows($riders) > 0) {
                foreach ($riders as $row) {
        ?>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;<?= $row['name']; ?></td>
                        <td><?= $row['role']; ?></td>
                        <td><?= $row['contact']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <button class="btn btn-primary" onclick="getStaff(<?= $row['id']; ?>)"><i class="bx bx-edit"></i></button>
                            <button class="btn btn-danger" onclick="deleteStaff(<?= $row['id']; ?>)"><i class="bx bx-trash"></i></button>
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

    <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addStaffModalLabel">Staff's Information</h1>
                    </div>
                    <div class="modal-body">
                    <form action="viewBookForm">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" id="name"></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" id="role">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" id="status">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addStaff()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewStaffModal" tabindex="-1" role="dialog" aria-labelledby="ViewStaffModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ViewStaffModal">STAFF's INFORMATION</h1>
                    </div>
                    <div class="modal-body">
                    <form action="viewBookForm">
                            <input  class="form-control" id="staffid" hidden>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" id="namex"></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" id="rolex">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobilex">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="emailx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" id="statusx">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editStaff()">Submit</button>
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
    function addStaff() {
    var name= $('#name').val();
    var role= $('#role').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var status = $('#status').val();
    // Create an object to hold the form data
    var formData = {
        name: name,
        role: role,
        mobile: mobile,
        email: email,
        status: status
    };    
        $.ajax({
            url: 'shopteamfunction.php',
            type: 'POST',
            data: {action: 'addStaff', formData},
            success: function(response) {
                swal({
                title: "Staff Added Successfully!",
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
function getStaff(id) {
    $.ajax({
        url: 'shopteamfunction.php', 
        type: 'GET',
        data: { action: 'getStaff', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#staffid').val(data.id);
                $('#namex').val(data.name);
                $('#rolex').val(data.role);
                $('#emailx').val(data.email);
                $('#mobilex').val(data.contact);
                $('#statusx').val(data.status);

                console.log(data); // Assuming you have an element with id="serviceInfo" to display the service
                $('#viewStaffModal').modal('show');
            } else {
                alert('Staff not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function editStaff(id) {
    var id = $('#staffid').val();
    var name = $('#namex').val();
    var role = $('#rolex').val();
    var email = $('#emailx').val();
    var mobile = $('#mobilex').val();
    var status = $('#statusx').val(); // Corrected ID
    $.ajax({
        url: 'shopteamfunction.php', 
        type: 'POST',
        data: { action: 'editStaff', id: id, name: name, role: role, email: email, mobile: mobile, status: status }, // Include all relevant data
        success: function(response) {
            swal({
                title: "Staff Updated Successfully!",
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


function deleteStaff(id) {
    $.ajax({
        url: 'shopteamfunction.php', 
        type: 'DELETE', // Change type to POST
        data: { action: 'deleteStaff', id: id }, 
        success: function(response) {
            swal({
                title: "Staff Deleted Successfully!",
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