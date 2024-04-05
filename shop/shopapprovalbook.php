<?php 
session_start();
include "../db_conn.php";
$page = 'shopbook';
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">

<title>RideCare SHOP: Approval Appointment</title>
</head>

<style>
 .kaliwa {
            float: left;
        }			
.search-container{
    background: #fff;
    height: 30px;
    border-radius: 30px;
    padding: 10px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.8s;
    /*box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
    inset -7px -7px 10px 0px rgba(0,0,0,.1),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
   text-shadow:  0px 0px 6px rgba(255,255,255,.3),
              -4px -4px 6px rgba(116, 125, 136, .2);
  text-shadow: 2px 2px 3px rgba(255,255,255,0.5);*/
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
}

.search-container:hover > .search-input{
    width: 400px;
}

.search-container .search-input{
    background: transparent;
    border: none;
    outline:none;
    width: 0px;
    font-weight: 500;
    font-size: 16px;
    transition: 0.8s;

}

.search-container .search-btn .fas{
    color: #5cbdbb;
}

@keyframes hoverShake {
  0% {transform: skew(0deg,0deg);}
  25% {transform: skew(5deg, 5deg);}
  75% {transform: skew(-5deg, -5deg);}
  100% {transform: skew(0deg,0deg);}
}

.search-container:hover{
  animation: hoverShake 0.15s linear 3;
}
</style>

<?php include "../inc/sidebarshop.php"; ?>

<main>
<div class="head-title">
    <div class="left">
        <h1>Booking Approval</h1>
        <ul class="breadcrumb">
            <li>
            <a class="active" href="shopdashboard.php">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right' ></i></li>
            <li>
                <a class="hide" href="shopriders.php">Appointment</a>
            </li>
            <li><i class='bx bx-chevron-right' ></i></li>
            <li>
            <a class="hide" href="shopdashboard.php">Booking Approval</a>
            </li>			
        </ul>
    </div>
</div>

<div class="table-data">
    <div class="order">
    <div class="head"></div>   
    <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>BOOKING DATE</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
                $query = "SELECT * FROM appointment WHERE status = 'pending'";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) {
                    foreach($query_run as $row) {
                ?>
                <tr>
                    <td>&nbsp;&nbsp;<?php echo date('F j, Y', strtotime($row['date'])); ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td>
                        <button class="btn btn-success" onclick="getBook(<?= $row['id']; ?>)"><i class="bx bx-check">&nbsp;Approve</i></button>
                        <button class="btn btn-danger" onclick="getrejectBook(<?= $row['id']; ?>)"><i class="bx bx-x-circle">&nbsp;Close</i></button>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No Record Found</td></tr>";
                }
                ?> 
    </tbody>
</table>
</div>  
</div>

        <div class="modal fade" id="viewBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rider's Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="viewBookForm">
                        <input  class="form-control" id="appointmentId" hidden>
                            <div class="mb-3">
                                <label class="form-label">Appointment</label>
                                <input class="form-control" id="date" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" class="form-control" id="service" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Vehicle</label>
                                <input type="text" class="form-control" id="vehicle" readonly>
                            </div>
                            <?php
                            $select = mysqli_query($conn, "SELECT * FROM employee WHERE role = 'mechanic' AND status = 'available'") or die('query failed');
                            ?>
                            <div class="mb-3">
                                <label class="form-label">Mechanic</label>
                                <select class="form-control" id="mechanic" required>
                                    <option class="col-md-8 fs-6"  disabled>Select Mechanic</option>
                                    <?php
                                    // Check if any rows are returned
                                    if(mysqli_num_rows($select) > 0){
                                        // Loop through each row
                                        while($vehicle = mysqli_fetch_assoc($select)){
                                            // Output option for each vehicle
                                            echo '<option value="' . $vehicle['name'] . '">' . $vehicle['name'] . '</option>';
                                        }
                                    } else {
                                        // If no vehicles found
                                        echo '<option class="col-md-8 fs-4" disabled>No vehicles found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="ApproveBook()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewRejectBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rider's Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="viewBookForm">
                        <input  class="form-control" id="appointmentIdx" hidden>
                            <div class="mb-3">
                                <label class="form-label">Appointment</label>
                                <input class="form-control" id="datex" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="namex" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="emailx" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" class="form-control" id="servicex" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="rejectBook()">Reject</button>
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


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
  <script type="text/javascript">
    (function () {
      emailjs.init("UuXQZY7BoALpOdsNo");
    })();
</script>
<script>
    function getBook(id) {
    $.ajax({
        url: 'shopbookfunction.php', 
        type: 'GET',
        data: { action: 'getBook', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // Parse the date string into a Date object
                var dateObj = new Date(data.date);

                // Format the date as "Month Day, Year"
                var formattedDate = formatDate(dateObj);

                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#appointmentId').text(data.id);
                $('#date').val(formattedDate); // Set the formatted date
                $('#name').val(data.name);
                $('#mobile').val(data.mobile);
                $('#email').val(data.email);
                $('#service').val(data.service);
                $('#vehicle').val(data.vehicle);

                $('#viewBookModal').modal('show');
            } else {
                alert('Book not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

// Function to format the date as "Month Day, Year"
function formatDate(date) {
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

function ApproveBook() {
    // Get the selected mechanic value
    var id = $('#appointmentId').text(); // Corrected to use appointmentId instead of AppointmentId
    var mechanic = $('#mechanic').val();

    $.ajax({
        url: 'shopbookfunction.php',
        type: 'POST',
        data: { action: 'approveBook', id: id, mechanic:mechanic  },
        success: function(response) {
            swal({
                title: "Booking Approved Successfully!",
                text: "",
                icon: "success",
                button: "Okay!",
            }).then((value) => {
                location.reload(); // Reload the page
            });
            sendMailApprove()
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function getrejectBook(id) {
    $.ajax({
        url: 'shopbookfunction.php', 
        type: 'GET',
        data: { action: 'getBook', id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
            if (data !== null) {
                // Parse the date string into a Date object
                var dateObj = new Date(data.date);

                // Format the date as "Month Day, Year"
                var formattedDate = formatDate(dateObj);

                // If data is not null, display the service information in the modal
                $('#serviceInfo').text(JSON.stringify(data));
                $('#appointmentIdx').text(data.id);
                $('#datex').val(formattedDate); // Set the formatted date
                $('#namex').val(data.name);
                $('#emailx').val(data.email);
                $('#servicex').val(data.service);

                $('#viewRejectBookModal').modal('show');
            } else {
                alert('Book not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}
    
function rejectBook() {
    var id = $('#appointmentIdx').text(); 
        $.ajax({
            url: 'shopbookfunction.php',
            type: 'POST',
            data: { action: 'rejectBook', id: id },
            success: function(response) {
                swal({
                    title: "Booking Reject Successfully!",
                    text: "",
                    icon: "success",
                    button: "Okay!",
                }).then((value) => {
                    location.reload(); // Reload the page
                });
                sendMailReject()
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
}



function sendMailApprove() {
    var params = {
        date: document.getElementById("date").value,
        email: document.getElementById("email").value,
        vehicle: document.getElementById("vehicle").value,
        name: document.getElementById("name").value,
        mechanic: document.getElementById("mechanic").value,
        service: document.getElementById("service").value,
    };

    const serviceID = "service_mkhh98s";
    const templateID = "template_c7q49px";

    emailjs.send(serviceID, templateID, params)
        .then((res) => {
            // Clear the email input field if needed
            document.getElementById("email").value = "";
            console.log(res);
            alert("Email Sent Successfully!");
        }) 
        .catch((err) => console.log(err));
    
    return false;
 }

 function sendMailReject() {
    var params = {
        email: document.getElementById("emailx").value,
        name: document.getElementById("namex").value,
    };
    const serviceID = "service_mkhh98s";
    const templateID = "template_h6hw0rd";

    emailjs.send(serviceID, templateID, params)
        .then((res) => {
            // Clear the email input field if needed
            document.getElementById("email").value = "";
            console.log(res);
            alert("Email Sent Successfully!");
        }) 
        .catch((err) => console.log(err));
    
    return false;
 }
</script>


</body>  
</html>  
