<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id']; 
if (isset($_SESSION['usertype_id'])) {}else{
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideCare: Booking History</title>
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    <script defer src="script.js"></script>
</head>

<style>



.tbl{
    width: 100%;
    border-collapse: collapse;
}

.tbl thead{
    background: #424949;
    color: #fff;
}

.tbl thead tr th{
    font-size: 0.9rem;
    padding: 0.8rem;
    letter-spacing: 0.2rem;
    vertical-align: top;
    border: 1px solid #aab7b8;
}

.tbl tbody tr td{
    font-size: 1rem;
    letter-spacing: 0.2rem;
    font-weight: normal;
    text-align: center;
    border: 1px solid #aab7b8;
    padding: 0.8rem;
}

.tbl tr:nth-child(even){
    background: #ccc;
    transition: all 0.3s ease-in;
}

.tbl tr:hover td{
    background: #839192;
    color: #000;
    transition: all 0.3s ease-in;
}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
</style>
<body>
<?php include '../inc/header.php'; ?> 
<br><br><center>
<h1>RECENT APPOINTMENT</h1></center><BR></BR>
<div class="container">
        <div class="tbl_container">
        <table class="tbl">
            <thead>
            <tr>
          <th>  ID </th>    
          <th> Appointment Date </th> 
          <th> Service </th>
		  <th> Status </th> 
          <th> Remarks </th>
               </tr>
               <tbody>
               <?php 
        $book = mysqli_query($conn,"SELECT * FROM appointment WHERE usertype_id='$usertype_id'") or die(mysqli_error($conn));
        if($book)
        {
            if(mysqli_num_rows($book) > 0)
            {
                foreach($book as $row) 
                {
             ?>    
        <tr> 
                  <td><?= $row['appointment_id']; ?></td> 
                  <td><?= $row['date']; ?></td> 
                  <td><?= $row['service']; ?></td> 
                  <td><?= $row['status']; ?></td>  
                  <td><?php
                    if ($row['status'] == 'Closed') {
                        echo 'Sorry, today is closed. Book another Day';
                    } elseif ($row['status'] == 'Holiday') {
                        echo 'Sorry, today is holiday. Book another Day';
                    } elseif ($row['status'] == 'pending') {
                        echo 'Wait For Approval';
                    } else {
                        // If status is neither 'closed' nor 'holiday', do nothing.
                        // You may add additional conditions/messages here if needed.
                    }
                    ?></td>
              </tr>
              <?php }}}?>
            </tbody>
        </table>
        </div>
    </div>
    <br><br>    <br><br>
    <?php include "../inc/footer.php"; ?>  
</body>
</html>
