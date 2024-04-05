<?php 
session_start();
include "../db_conn.php";
$page = 'shopbook';

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
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Optional: Bootstrap JS and Popper.js Links (if you need Bootstrap features that rely on JavaScript) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- My CSS -->
	<title>RideCare SHOP: APPOINTMENTS</title>
</head>
<body>


	<!-- SIDEBAR -->
<?php include '../inc/sidebarshop.php';  ?>
	<!-- SIDEBAR -->
	
		<main>
			<div class="table-data">
				<div class="order">
                    <div class="head"><h1 style="font-size: 50px;">Appointments for RideCare</h1></div>           
                    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Vehicle</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
        <?php 
$riders = mysqli_query($conn, "SELECT * FROM appointment") or die(mysqli_error($conn));

if($riders && mysqli_num_rows($riders) > 0)
{
    foreach($riders as $row) 
    {
        echo "
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row['id']}   </td>
            <td>{$row['date']}&nbsp;</td>
            <td>{$row['name']}&nbsp;</td>
            <td>{$row['mobile']}&nbsp;&nbsp;</td>
            <td>{$row['vehicle']}</td>
            <td>{$row['service']}</td>
        </tr>
        ";
    }
}
?>

        </tbody>
    </table>    
			</div>  
		</div>


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
</body>  
</html>  

