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
                <div class="head"><h1 style="font-size: 50px;">Booking Approval</h1></div>   
                <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>APPOINTMENT ID</th>
                        <th>BOOKING DATE</th>
                        <th>FULL Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
              
                    <?php
                $riders = mysqli_query($conn, "SELECT * FROM appointment WHERE status = 'pending'") or die(mysqli_error($conn));
                ?>
                <tbody>
                    <?php if (mysqli_num_rows($riders) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($riders)) : ?>
                            <tr>
                                <td><?php echo $row['appointment_id']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['mobile']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                <button type="button" class="btn btn-success approve-button" onclick="viewBook(<?php echo $row['appointment_id']; ?>)"><i class='bx bx-check-circle'></i>Approve</button>
                                    <button type="button" class="btn btn-danger close-button"   data-usertype-id="<?php echo $row['appointment_id']; ?>" onclick="CloseBook(<?php echo $row['appointment_id']; ?>)"><i class='bx bx-x-circle'></i></button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No record found.</td>
                        </tr>
                    <?php endif; ?>
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
                            <?php
                            $select = mysqli_query($conn, "SELECT * FROM employee WHERE role = 'mechanic' AND status = 'available'") or die('query failed');
                            ?>
                            <div class="mb-3">
                                <label class="form-label">Mechanic</label>
                                <select class="form-control" id="mechanic">
                                <option class="col-md-8 fs-6" selected disabled>Select Mechanic</option>
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
</main>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript -->
<script>
    // Use jQuery noConflict mode
    jQuery.noConflict();
    
    // Use jQuery with the 'jQuery' alias
 
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
  <script type="text/javascript">
    (function () {
      emailjs.init("UuXQZY7BoALpOdsNo");
    })();
</script>
<script>
function viewBook(AppointmentId) {
    jQuery(function($) {
        // Your jQuery code using the $ alias
        $('#viewBookModal').modal('show');
    });
    $.ajax({
        url: 'shopbookfunction.php', 
        type: 'POST',
        data: { action: 'get_book', AppointmentId: AppointmentId }, 
        success: function(response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.hasOwnProperty('message')) {
                // Display a message if no user is found
                $('#modal-body-content').html('<p>' + data.message + '</p>');
            } else {
                // Display the user details in the modal
                var user = data;
                console.log(AppointmentId);
                $('#appointmentId').text(user.appointment_id);
                var dateString = user.date;
                // Parse the date string into a JavaScript Date object
                var date = new Date(dateString);

                // Define an array of month names
                var monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"];

                // Get the month name from the monthNames array (January is at index 0)
                var monthName = monthNames[date.getMonth()];

                // Get the day of the month
                var day = date.getDate();

                // Get the full year
                var year = date.getFullYear();

                // Construct the formatted date string
                var formattedDate = monthName + ' ' + day + ', ' + year;

                // Set the formatted date in the input field
                $('#date').val(formattedDate);
                $('#name').val(user.name);
                $('#mobile').val(user.mobile);
                $('#email').val(user.email);
                // Open the modal
                $('#viewBookModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}

function ApproveBook() {
    // Get the selected mechanic value
    var AppointmentId = $('#appointmentId').text(); // Corrected to use appointmentId instead of AppointmentId
    console.log(AppointmentId);
    var mechanic = $('#mechanic').val();
    console.log(AppointmentId)
    $.ajax({
        url: 'shopbookfunction.php',
        type: 'POST',
        data: { 
            action: 'approve', 
            AppointmentId: AppointmentId,
            mechanic: mechanic // Pass the selected mechanic value
        },
        success: function(response) {
            var data = JSON.parse(response);
            alert(data.message);
            if(data.email) {
                var email = data.email;

                sendMailApprove(email);
           
            }
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

    function CloseBook(AppointmentId) {
        $.ajax({
            url: 'shopbookfunction.php',
            type: 'POST',
            data: { action: 'close', AppointmentId: AppointmentId },
            success: function(response) {
                var data = JSON.parse(response);
                alert(data.message);
                if(data.email) {
                    // Access the email address and use it as needed
                    var email = data.email;
                    // console.log(email);
                    // // Call sendMail function here if needed
                    // sendMail(email)
                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

function sendMailApprove(email) {
    var params = {
        email: email // Use the email argument directly
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

</script>
    </body>  
</html>  
