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
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');
.container .heading{
    text-align: center;
    padding-bottom: 15px;
    color:black;
    text-shadow: 0 5px 10px rgba(0,0,0,.2);
    font-size: 50px;
}

.container .box-container{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap:15px;
}

.container .box-container .box{
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    border-radius: 5px;
    background: #fff;
    text-align: center;
    padding:30px 20px;
}

.container .box-container .box img{
    height: 80px;
}

.container .box-container .box h3{
    color:#444;
    font-size: 22px;
    padding:10px 0;
}

.container .box-container .box p{
    color:#777;
    font-size: 15px;
    line-height: 1.8;
}

.container .box-container .box .btn{
    margin-top: 10px;
    display: inline-block;
    background:#333;
    color:#fff;
    font-size: 17px;
    border-radius: 5px;
    padding: 8px 25px;
}

.container .box-container .box .btn:hover{
    letter-spacing: 1px;
}

.container .box-container .box:hover{
    box-shadow: 0 10px 15px rgba(0,0,0,.3);
    transform: scale(1.03);
}

@media (max-width:768px){
    .container{
        padding:20px;
    }
}
.button-30 {
  align-items: center;
  appearance: none;
  background-color: #FCFCFD;
  border-radius: 4px;
  border-width: 0;
  box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
  box-sizing: border-box;
  color: #36395A;
  cursor: pointer;
  display: inline-flex;
  font-family: "JetBrains Mono",monospace;
  height: 48px;
  justify-content: flex-end; 
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 16px;
  padding-right: 16px;
  position: relative;
  text-align: left;
  text-decoration: none;
  transition: box-shadow .15s,transform .15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow,transform;
  font-size: 18px;
}

.button-30:focus {
  box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
}

.button-30:hover {
  box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  transform: translateY(-2px);
}

.button-30:active {
  box-shadow: #D6D6E7 0 3px 7px inset;
  transform: translateY(2px);
}

</style>
<body>
<?php include '../inc/header.php'; ?> 
<br><br>
<div class="container">
    <a class="button-30" role="button"  href="userhistorymenu.php">All Appointment</a> &nbsp;      
    <a class="button-30" role="button"  href="userpendinghistory.php" style="background-color: lightblue;">Pending</a> &nbsp;  
    <a class="button-30" role="button" href="usercompletehistory.php">Completed</a> &nbsp;
    <a class="button-30" role="button" href="usercancelhistory.php">Cancelled</a> &nbsp;  
<br><br>
        <div class="tbl_container">
        <table class="tbl">
            <thead>
            <tr>
          <th> Appointment Date </th> 
          <th> Vehicle </th>          
          <th> Service </th>
		  <th> Status </th> 
               </tr>
               <tbody>
               <?php 
        $book = mysqli_query($conn,"SELECT * FROM appointment WHERE usertype_id='$usertype_id' AND status = 'pending'") or die(mysqli_error($conn));
        if($book)
        {
            if(mysqli_num_rows($book) > 0)
            {
                foreach($book as $row) 
                {
             ?>    
        <tr> 
                  <td><?= $row['date']; ?></td> 
                  <td><?= $row['vehicle']; ?></td> 
                  <td><?= $row['service']; ?></td> 
                  <td><?= $row['status']; ?></td>  
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
