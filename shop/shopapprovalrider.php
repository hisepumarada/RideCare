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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>

	<title>RideCare SHOP: FOR APPROVAL RIDERS</title>

<?php include "../inc/sidebarshop.php"; ?>
</head>	
<body>
		<!-- MAIN -->
        <main>
        <div class="head-title">
				<div class="left">
					<h1>FOR APPROVAL RIDERS</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shoppaymentrider.php">Riders</a>
						</li>
					</ul>
			</div>
		</div>

        <div class="table-data">
                <div class="order">       
                <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                $riders = mysqli_query($conn, "SELECT * FROM user WHERE usertype = 'rider' AND status = '0'") or die(mysqli_error($conn));
                ?>
                <tbody>
                    <?php if (mysqli_num_rows($riders) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($riders)) : ?>
                            <tr>
                                <td><?php echo $row['usertype_id']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['mobile']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-success approve-button" data-usertype-id="<?php echo $row['usertype_id']; ?>" onclick="ApproveRider(<?php echo $row['usertype_id']; ?>)"><i class='bx bx-check-circle'></i></button>
                                    <button type="button" class="btn btn-primary" onclick="viewRider(<?php echo $row['usertype_id']; ?>)"><i class='bx bx-show'></i></button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No record found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
        </div>
    </div>

        <div class="modal fade" id="viewRiderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rider's Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="viewRiderForm">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input class="form-control" id="firstname" required></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" id="gender" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
  </script>
  <script type="text/javascript">
    (function () {
      emailjs.init("UuXQZY7BoALpOdsNo");
    })();
  </script>

<script>


function ApproveRider(usertypeId) {
    $.ajax({
        url: 'shopriderfunction.php',
        type: 'POST',
        data: { action: 'approve', usertypeId: usertypeId },
        success: function(response) {
            var data = JSON.parse(response);
            alert(data.message);
            if(data.email) {
                // Access the email address and use it as needed
                var email = data.email;
                // Call sendMail function here if needed
                sendMail(email)
            }
            console.log(response);
            // Perform additional actions here after the approval is successful
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function sendMail(email) {
    var params = {
        email: email // Use the email argument directly
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


// Define the viewRider function to fetch user details and display them in a modal
function viewRider(usertypeId) {
    $.ajax({
        url: 'shopriderfunction.php', 
        type: 'POST',
        data: { action: 'get_user', usertypeId: usertypeId }, 
        success: function(response) {
            console.log(response);
            var data = JSON.parse(response);
            if (data.hasOwnProperty('message')) {
                // Display a message if no user is found
                $('#modal-body-content').html('<p>' + data.message + '</p>');
            } else {
                // Display the user details in the modal
                var user = data[0];
                $('#usertypeId').text(user.usertypeId);
                $('#firstname').val(user.firstname);
                $('#lastname').val(user.lastname);
                $('#mobile').val(user.mobile);
                $('#email').val(user.email);
                $('#gender').val(user.gender);
                $('#address').val(user.address);
                

                // Open the modal
                $('#viewRiderModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to the console
        }
    });
}
jQuery.noConflict();
jQuery(document).ready(function($) {
    // Use $() inside this function
    $('#myModal').modal('show');
});
</script>

</body>
</html>

