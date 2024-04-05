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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script defer src="script.js"></script>
</head>
<style>
    

    .containermotor {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .details {
        margin-top: 20px;
    }

    .details-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .details-item:last-child {
        border-bottom: none;
    }

    .details-label {
        font-weight: bold;
        color: #555;
        flex-basis: 150px;
    }

    .details-value {
        flex-grow: 1;
        color: #333;
    }

    .motorcycle-image {
    display: block;
    margin: 20px auto;
    width: 400px; /* Set the exact width */
    height: 300px; /* Set the exact height */
    object-fit: cover; /* Maintain aspect ratio and cover the container */
    border-radius: 5px;
}

</style>

<body>
<?php include '../inc/header.php'; ?> 
<br><br>
<?php 
if(isset($_GET['vehicle']))
{
$id = mysqli_real_escape_string($conn, $_GET['vehicle']);
$book = mysqli_query($conn,"SELECT * FROM vehicle WHERE usertype_id='$usertype_id' AND id='$id'") or die(mysqli_error($conn));
if($book)
{
    if(mysqli_num_rows($book) > 0)
    {
        foreach($book as $row) 
        {
?>  
<div class="containermotor">
    <h1>Motorcycle Details</h1>
    <?php 
if (!empty($row['image'])) {
    // If the image exists, display it
    echo '<img class="motorcycle-image" src="../uploaded_img/'.$row['image'].'" alt="Motorcycle Image">';
} else {
    // If the image does not exist, display a default image
    echo '<img class="motorcycle-image" src="../css/images/user.png" alt="Motorcycle Image">';
}
?>

    <div class="details">
        <div class="details-item">
            <span class="details-label">Plate Number:</span>
            <span class="details-value"><?= $row['platenumber']; ?></span>
        </div>
        <div class="details-item">
            <span class="details-label">Vehicle:</span>
            <span class="details-value"><?= $row['vehicle']; ?></span>
        </div>
        <div class="details-item">
            <span class="details-label">Color:</span>
            <span class="details-value"><?= $row['color']; ?></span>
        </div>
        <div class="details-item">
            <span class="details-label">Purchase Date:</span>
            <span class="details-value"><?= date('F j, Y', strtotime($row['purchasedate'])); ?></span>
        </div>
    </div>
</div>
<?php
        }}
    }
}
?>
        </div>
    </div>

    <br><br>    <br><br>
    <?php include "../inc/footer.php"; ?>  
</body>
</html>
