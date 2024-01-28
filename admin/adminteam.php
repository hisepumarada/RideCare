<?php 
session_start();
include "../db_conn.php";
$page = 'adminteam';
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
	
	<title>RideCare (ADMIN): STAFF</title>
<style>
     .kaliwa {
            float: left;
        }
</style>
<?php include "../inc/sidebaradmin.php"; ?>

<main>
<div class="head-title">
				<div class="left">
					<h1>Team</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="admindashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="adminteam.php">Team</a>
						</li>
					</ul>
				</div>
                <div class="kaliwa"></div>
			</div>	
<div class="table-data">
    
<div class="order"><button class="button-18"><a style="color: #fff;" href="adminteamcreate.php">
<h4>Add Staff</h4></a></button><br><br><div class="kaliwa">
</div>
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Start Date</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $riders = mysqli_query($conn,"SELECT * FROM user WHERE usertype = 'shop'") or die(mysqli_error($conn));
        if($riders)
        {
            if(mysqli_num_rows($riders) > 0)
            {
                foreach($riders as $row) 
                {
             ?>
        
        
            <tr>
                <td><?= $row['firstname']; ?></td>
                <td><?= $row['lastname']; ?></td>
                <td><?= $row['mobile']; ?></td>
                <td><?= $row['gender']; ?></td>
                <td><?= $row['email']; ?></td>
                <td></td>
            </tr>
<?php }}}?>
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

            // DataTable Buttons initialization
            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {   extend: 'print',
                        text: 'Print',
                        title: 'Table Print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Adjust the column indices based on your table structure
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        title: 'Table Export',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Adjust the column indices based on your table structure
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Table Export',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Adjust the column indices based on your table structure
                        }
                    }
                ]
            });

            // Add the export buttons to the DataTable
            table.buttons().container().appendTo($('.kaliwa'));
        });
</script>



</body>
</html>