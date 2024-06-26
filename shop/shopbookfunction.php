<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getBook') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $book = getBook($id);

            // Return the service data as JSON response
            echo json_encode($book);
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
    // Check if the action parameter is set and equal to 'rejectBook'
    if (isset($_POST['action']) && $_POST['action'] === 'rejectBook') {
        // Handle the rejectBook action
        if (isset($_POST['id'])) {
            // Get the form data
            $id = $_POST['id'];
            rejectBook($id);

            // Prepare the response
            $response = ["success" => "Service rejected successfully"];

            // Output the JSON response
            echo json_encode($response);
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
    if (isset($_POST['action']) && $_POST['action'] === 'approveBook') {
        // Handle the editService action
        if (isset($_POST['id']) && isset($_POST['mechanic'])) {
            // Call the editService function with the provided id and status
            $id = $_POST['id'];
            $mechanic = $_POST['mechanic'];
            approveBook($id, $mechanic);
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


// Define the getService function
function getBook($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM appointment WHERE id = $id";

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
function approveBook($id, $mechanic) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $mechanic = mysqli_real_escape_string($conn, $mechanic);

    $sql = "UPDATE appointment SET mechanic = '$mechanic', status = 'approved' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Service updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating service: " . mysqli_error($conn)]);
    }
}

function rejectBook($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "UPDATE appointment SET status = 'closed' WHERE id = $id";

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
