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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>RideCare SHOP: Staff</title>

<?php include "../inc/sidebarshop.php"; ?>

<main>
<div class="head-title">
				<div class="left">
					<h1>Team</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="shopteam.php">Team</a>
						</li>
					</ul>
                    </div>
				<a href='shopteamcreate.php' class="btn-download">
					<i class='bx bx-add-to-queue' ></i>
					<span class="text">ADD TEAM MEMBER</span>
				</a>
			</div>
         
<div class="table-data">
    
<div class="order">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
    $riders = mysqli_query($conn, "SELECT * FROM user WHERE usertype = 'shop'") or die(mysqli_error($conn));

    if ($riders && mysqli_num_rows($riders) > 0) {
        foreach ($riders as $row) {
?>
            <tr>
                <td><?= $row['firstname']; ?></td>
                <td><?= $row['lastname']; ?></td>
                <td><?= $row['mobile']; ?></td>
                <td><?= $row['gender']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <a class='btn btn-primary mr-3' href="shopteamedit.php?usertype_id=<?php echo $row['usertype_id']; ?>">EDIT</a>
                    <form method="POST" action="">
                        <input type="hidden" name="usertype_id" value="<?php echo $row['usertype_id']; ?>"><br>
                        <button class='btn btn-danger' type="submit" name="delete_btn">DELETE</button>
                    </form>
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
		</main>
		<!-- MAIN -->
		
	</section>


   
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>

<script>
         $(document).ready(function() {
            // DataTable initialization
            var table = $('#example').DataTable();

        });
</script>
<?php
    if(isset($_POST['delete_btn'])) {
    $usertype_id_to_delete = mysqli_real_escape_string($conn, $_POST['usertype_id']);
    
    // Perform the deletion query
    $delete_query = "DELETE FROM user WHERE usertype_id = '$usertype_id_to_delete'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    ?>
    <script>
    swal({
     title: "usertype Deleted is Success",
     text: "",
     icon: "success",
     button: "Okay!",
  }).then(function() {
   window.location = "shopteam.php?usertype_id=<?php echo $rider['usertype_id']; ?>";
});
   </script>  
   <?php
} ?>


</body>
</html>