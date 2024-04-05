<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getPayment') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $payment = getPayment($id);

            // Return the service data as JSON response
            echo json_encode($payment);
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
    // Check if the action parameter is set and equal to 'addPayment'
    if (isset($_POST['action']) && $_POST['action'] === 'addPayment') {
        // Handle the addPayment action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $usertype_id = $formData['usertype_id']; // Corrected access to usertype_id field
            $date = $formData['date'];
            $name = $formData['name'];
            $vehicle = $formData['vehicle'];
            $status = $formData['status'];
            $amount = $formData['amount'];

            // Call the addPayment function with the provided data
            addPayment($usertype_id, $date, $name, $vehicle, $status, $amount);
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
    // Check if the action parameter is set
    if (isset($_POST['action'])) {
        // Handle the editPayment action
        if ($_POST['action'] === 'editPayment') {
            // Check if all necessary parameters are set
            if (isset($_POST['formData'])) {
                // Get the form data
                $formData = $_POST['formData'];
                $id = $formData['id'];
                $date = $formData['date'];
                $name = $formData['name'];
                $vehicle = $formData['vehicle'];
                $status = $formData['status'];
                $amount = $formData['amount'];
                
                // Call the editPayment function with the provided parameters
                editPayment($id, $date, $name, $vehicle, $status, $amount);
            } else {
                // Return an error message if formData is missing
                echo json_encode(['error' => 'Form data is missing']);
            }
        } else {
            // Return an error message for unsupported action
            echo json_encode(['error' => 'Unsupported action']);
        }
    } else {
        // Return an error message for missing action parameter
        echo json_encode(['error' => 'Action parameter is missing']);
    }
}


// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the action parameter is set and equal to 'deleteService'
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE['action']) && $_DELETE['action'] === 'deletePayment') {
        // Handle the deleteService action
        if (isset($_DELETE['id'])) {
            // Call the deleteService function with the provided id
            $id = $_DELETE['id'];
            deletePayment($id);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid DELETE request
        echo json_encode(['error' => 'Invalid DELETE request']);
    }
}

function addPayment($usertype_id, $date, $name, $vehicle, $status, $amount) {
    global $conn;

    // Sanitize input to prevent SQL injection
    $usertype_id = mysqli_real_escape_string($conn, $usertype_id);
    $date = mysqli_real_escape_string($conn, $date);
    $name = mysqli_real_escape_string($conn, $name);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $status = mysqli_real_escape_string($conn, $status);
    $amount = mysqli_real_escape_string($conn, $amount);

    // Your SQL query to insert data into the payment table
    $sql = "INSERT INTO payment (usertype_id, date, name, vehicle, status, amount) VALUES ('$usertype_id', '$date', '$name', '$vehicle', '$status', '$amount')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Payment added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding payment: " . mysqli_error($conn)]);
    }
}



// Define the getService function
function getPayment($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM payment WHERE id = $id";

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
function editPayment($id, $date, $name, $vehicle, $status, $amount) {
    global $conn;

    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $date = mysqli_real_escape_string($conn, $date);
    $name = mysqli_real_escape_string($conn, $name);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $status = mysqli_real_escape_string($conn, $status);
    $amount = mysqli_real_escape_string($conn, $amount);

    // Update the payment table with the new details
    $sql = "UPDATE payment SET date = '$date', name = '$name', vehicle = '$vehicle', status = '$status', amount = '$amount' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Payment updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating payment: " . mysqli_error($conn)]);
    }
}


// Define the deleteService function
function deletePayment($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM payment WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Payment deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting service: " . mysqli_error($conn)]);
    }
}

?>
