<?php 
session_start();
include "../db_conn.php";
$page = 'adminriders';
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
 


	<title>RideCare (ADMIN): RIDERS</title>
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
<?php include "../inc/sidebaradmin.php"; ?>
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Riders</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="admindashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="adminriders.php">Riders</a>
						</li>
					</ul>
				</div>
                <div class="kaliwa"></div>
			</div>	
           
        <div class="table-data">
            
		<div class="order"> <br>
        <table id="example" class="table table-striped" style="font-size: 20px; width:100%">
        <thead style="background-color: cyan;">
            <tr>
                <th style="font-size: 20px;">First Name</th>
                <th style="font-size: 20px;">Last Name</th>
                <th style="font-size: 20px;">Mobile</th>
                <th style="font-size: 20px;">Gender</th>
                <th style="font-size: 20px;">Start Date</th>
                <th style="font-size: 20px;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $riders = mysqli_query($conn,"SELECT * FROM user WHERE usertype = 'rider'") or die(mysqli_error($conn));
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
                <td></td>
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
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Table Export',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Adjust the column indices based on your table structure
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        title: 'Table Export',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Adjust the column indices based on your table structure
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        title: 'Table Print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Adjust the column indices based on your table structure
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