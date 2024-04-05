<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getService') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $service = getService($id);

            // Return the service data as JSON response
            echo json_encode($service);
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
    // Check if the action parameter is set and equal to 'addService'
    if (isset($_POST['action']) && $_POST['action'] === 'addService') {
        // Handle the addService action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $service = $formData['service'];
            $created = $formData['created'];
            $status = $formData['status'];
            
            addService($service, $created, $status);
            echo json_encode(["success" => "Service added successfully"]);
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
    // Check if the action parameter is set and equal to 'editService'
    if (isset($_POST['action']) && $_POST['action'] === 'editService') {
        // Handle the editService action
        if (isset($_POST['id']) && isset($_POST['status'])) {
            // Call the editService function with the provided id and status
            $id = $_POST['id'];
            $status = $_POST['status'];
            editService($id, $status);
        } else {
            // Return an error message if id or status parameters are missing
            echo json_encode(['error' => 'Id or status parameter is missing']);
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
    if (isset($_DELETE['action']) && $_DELETE['action'] === 'deleteService') {
        // Handle the deleteService action
        if (isset($_DELETE['id'])) {
            // Call the deleteService function with the provided id
            $id = $_DELETE['id'];
            deleteService($id);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid DELETE request
        echo json_encode(['error' => 'Invalid DELETE request']);
    }
}


function addService($service, $created, $status) {
    global $conn;

    // Sanitize input to prevent SQL injection
    $service = mysqli_real_escape_string($conn, $service);
    $created = mysqli_real_escape_string($conn, $created);
    $status = mysqli_real_escape_string($conn, $status);

    // Your SQL query to insert data into the service table
    $sql = "INSERT INTO service (service, created, status) VALUES ('$service', '$created', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Service added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding service: " . mysqli_error($conn)]);
    }
}


// Define the getService function
function getService($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM service WHERE id = $id";

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
function editService($id, $status) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE service SET status = '$status' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Service updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating service: " . mysqli_error($conn)]);
    }
}

// Define the deleteService function
function deleteService($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM service WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Service deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting service: " . mysqli_error($conn)]);
    }
}

?>
