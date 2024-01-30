<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--Box Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script defer src="script.js"></script>
    <title>RideCare: Payments</title>
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
<h1>PAYMENTS</h1></center><BR></BR>
<div class="container">
        <div class="tbl_container">
        <table class="tbl">
            <thead>
              
               <tr>
          <th> Payment ID </th>    
          <th> Payment Date </th> 
		  <th> Vehicle </th> 
          <th> Status </th>
          <th> Amount </th>
               </tr>
               <tbody>
               <?php 
                if(isset($_GET['vehicle']))
                {
                    $vehicle = mysqli_real_escape_string($conn, $_GET['vehicle']);
        $book = mysqli_query($conn,"SELECT * FROM payment WHERE usertype_id='$usertype_id' AND vehicle='$vehicle'") or die(mysqli_error($conn));
        if($book)
        {
            if(mysqli_num_rows($book) > 0)
            {
                foreach($book as $row) 
                {
             ?>    
        <tr> 
                  <td><?= $row['payment_id']; ?></td> 
                  <td><?= date("F d, Y", strtotime($row['date']));?></td> 
                  <td><?= $row['vehicle']; ?></td>  
                  <td><?= $row['status']; ?></td> 
                  <td><?= $row['amount']; ?></td>   
              </tr>
              <?php }}}}?>
            </tbody>
        </table>
        </div>
    </div>
    <br><br>    <br><br>
    <?php include "../inc/footer.php"; ?>  
</body>
</html>
