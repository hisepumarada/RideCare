<?php 
session_start();
include "../db_conn.php";
$page = 'adminmessage';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<title>RideCare (ADMIN): MESSAGE</title>

<?php include "../inc/sidebaradmin.php"; ?>
		

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Message</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="admindashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="adminmessage.php">Message</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<div class="table-data">
				<div class="order">
					<h1>Message</h1>
					<div class="head">
						<h3></h3>
					</div>
					<table>
					<table class="table table-inbox table-hover">
                            
							<tr> 
                                <td> <font face="Arial">Email</font> </td> 
		                        <td> <font face="Arial">Message</font> </td> 
		                        <td> <font face="Arial">Date</font> </td> 
								<td> <font face="Arial">Action</font> </td> 
                                </tr>
								<?php 
	                           
							   $query = "SELECT * FROM message";
							   $query_run = mysqli_query($conn, $query);

							   if(mysqli_num_rows($query_run) > 0)
							   {
								   foreach($query_run as $row)
								   {
									   ?>
                              <tr class="unread">
                                  <td class="view-message  dont-show"><?= $row['email']; ?></td>
                                  <td class="view-message "><?= $row['message']; ?></td>
                                  <td class="view-message  text-right"><?= $row['date']; ?></td>
								  <td>
          &nbsp;&nbsp;
          <a href="#">Email</a>&nbsp;&nbsp;</td>
                              </tr>
                      <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                          </tbody>
                          </table>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>

</head>
<body>
    
</body>
</html>