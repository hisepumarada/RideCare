<?php 
session_start();
include "../db_conn.php";
$usertype_id = $_SESSION['usertype_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $plate_number = $_POST['plate_number'];
    $vehicle = $_POST['vehicle'];
    $color = $_POST['color'];
    $odometer = $_POST['odometer'];

    // Process the uploaded image
    $image = $_FILES['image']['name']; // Get the name of the image file
    $temp_name = $_FILES['image']['tmp_name']; // Get the temporary file name
    $folder = "../uploaded_img/"; // Specify the directory where you want to save the uploaded images

    // Move the uploaded image to the specified folder
    move_uploaded_file($temp_name, $folder.$image);

    // SQL query to insert data into the database
    $sql = "INSERT INTO vehicle (usertype_id, platenumber, vehicle, color, odometer, image) 
            VALUES ('$usertype_id','$plate_number', '$vehicle', '$color', '$odometer', '$image')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Data inserted successfully
        echo "<script>alert('New record inserted successfully!'); window.location.href = 'uservehicle.php';</script>";
    } else {
        // Error in inserting data
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
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
.containermotor {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.containermotor h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="date"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="file"] {
    cursor: pointer;
}

.btn-primary {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>

<body>
<?php include '../inc/header.php'; ?> 
<br><br>

<div class="containermotor">
    <h1>Add Motorcycle</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="plate_number">Plate Number:</label>
            <input type="text" id="plate_number" name="plate_number" required>
        </div>
        <div class="form-group">
            <label for="vehicle">Vehicle:</label>
            <input type="text" id="vehicle" name="vehicle" required>
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>
        </div>
        <div class="form-group">
            <label for="odometer">Odometer:</label>
            <input type="number" id="odometer" name="odometer" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>



    <br><br>    <br><br>
    <?php include "../inc/footer.php"; ?>  
</body>
</html>

