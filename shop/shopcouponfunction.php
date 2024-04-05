<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getCoupon') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $coupon = getCoupon($id);

            // Return the service data as JSON response
            echo json_encode($coupon);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid GET request
        echo json_encode(['error' => 'Invalid GET request']);
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the action parameter is set and equal to 'addCoupon'
    if (isset($_POST['action']) && $_POST['action'] === 'addCoupon') {
        // Handle the addCoupon action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $usertype_id = $formData['usertype_id'];
            $date = $formData['date'];
            $name = $formData['name'];
            $service = $formData['service'];
            $vehicle = $formData['vehicle'];
            $odometer = $formData['odometer'];
            $type = $formData['type'];
        
            // Call the addCoupon function with the provided data
            addCoupon($usertype_id, $date, $name, $service, $vehicle, $odometer, $type);
        } else {
            // Return an error message if formData is missing
            echo json_encode(['error' => 'Form data is missing']);
        }
    } else {
        // Return an error message for invalid POST request
        echo json_encode(['error' => 'Invalid POST request']);
    }
}



// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the action parameter is set and equal to 'editCoupon'
    if (isset($_POST['action']) && $_POST['action'] === 'editCoupon') {
        // Handle the editCoupon action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $id = $formData['id'];
            $date = $formData['date'];
            $name = $formData['name'];
            $service = $formData['service'];
            $vehicle = $formData['vehicle'];
            $odometer = $formData['odometer'];
            $type = $formData['type'];

            // Call the editCoupon function with the provided parameters
            editCoupon($id, $date, $name, $service, $vehicle, $odometer, $type);
        } else {
            // Return an error message if formData is missing
            echo json_encode(['error' => 'Form data is missing']);
        }
    } else {
        // Return an error message for invalid POST request
        echo json_encode(['error' => 'Invalid POST request']);
    }
}



// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the action parameter is set and equal to 'deleteService'
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE['action']) && $_DELETE['action'] === 'deleteCoupon') {
        // Handle the deleteService action
        if (isset($_DELETE['id'])) {
            // Call the deleteService function with the provided id
            $id = $_DELETE['id'];
            deleteCoupon($id);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid DELETE request
        echo json_encode(['error' => 'Invalid DELETE request']);
    }
}


function addCoupon($usertype_id, $date, $name, $service, $vehicle, $odometer, $type) {
    global $conn; // Assuming $conn is your database connection

    // Sanitize input to prevent SQL injection
    $usertype_id = mysqli_real_escape_string($conn, $usertype_id);
    $date = mysqli_real_escape_string($conn, $date);
    $name = mysqli_real_escape_string($conn, $name);
    $service = mysqli_real_escape_string($conn, $service);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $odometer = mysqli_real_escape_string($conn, $odometer);
    $type = mysqli_real_escape_string($conn, $type);

    // Your SQL query to insert data into the coupon table
    $sql = "INSERT INTO coupon (usertype_id, date, name, service, vehicle, odometer, type) VALUES ('$usertype_id', '$date', '$name', '$service', '$vehicle', '$odometer', '$type')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Coupon added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding coupon: " . mysqli_error($conn)]);
    }
}



// Define the getService function
function getCoupon($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM coupon WHERE id = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the service data
        $row = mysqli_fetch_assoc($result);
        return $row; // Return the service data
    } else {
        return null; // Return null if no service found
    }
}

// Define the editService function
function editCoupon($id, $date, $name, $service, $vehicle, $odometer, $type) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $date = mysqli_real_escape_string($conn, $date);
    $name = mysqli_real_escape_string($conn, $name);
    $service = mysqli_real_escape_string($conn, $service);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $odometer = mysqli_real_escape_string($conn, $odometer);
    $type = mysqli_real_escape_string($conn, $type);

    $sql = "UPDATE coupon SET date = '$date', name = '$name', service = '$service', vehicle = '$vehicle', odometer = '$odometer', type = '$type' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Coupon updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating coupon: " . mysqli_error($conn)]);
    }
}


// Define the deleteService function
function deleteCoupon($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM coupon WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Coupon deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting service: " . mysqli_error($conn)]);
    }
}

?>
