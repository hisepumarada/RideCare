<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getStaff') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $staff = getStaff($id);

            // Return the service data as JSON response
            echo json_encode($staff);
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
    // Check if the action parameter is set and equal to 'addStaff'
    if (isset($_POST['action']) && $_POST['action'] === 'addStaff') {
        // Handle the addStaff action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $name = $formData['name'];
            $role = $formData['role'];
            $mobile = $formData['mobile'];
            $email = $formData['email'];
            $status = $formData['status'];
            
            // Call the addStaff function with the provided data
            addStaff($name, $role, $mobile, $email, $status);
            echo json_encode(["success" => "Staff added successfully"]);
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
    // Check if the action parameter is set and equal to 'editProduct'
    if (isset($_POST['action']) && $_POST['action'] === 'editStaff') {
        // Handle the editProduct action
        if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['name']) && isset($_POST['role']) && isset($_POST['email']) && isset($_POST['mobile'])) {
            // Call the editProduct function with the provided id, name, role, email, mobile, and status
            $id = $_POST['id'];
            $name = $_POST['name'];
            $role = $_POST['role'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $status = $_POST['status'];
            editStaff($id, $name, $role, $email, $mobile, $status);
        } else {
            // Return an error message if any required parameters are missing
            echo json_encode(['error' => 'One or more required parameters are missing']);
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
    if (isset($_DELETE['action']) && $_DELETE['action'] === 'deleteStaff') {
        // Handle the deleteService action
        if (isset($_DELETE['id'])) {
            // Call the deleteService function with the provided id
            $id = $_DELETE['id'];
            deleteStaff($id);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid DELETE request
        echo json_encode(['error' => 'Invalid DELETE request']);
    }
}


function addStaff($name, $role, $mobile, $email, $status) {
    global $conn;

    // Sanitize input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $role = mysqli_real_escape_string($conn, $role);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $email = mysqli_real_escape_string($conn, $email);
    $status = mysqli_real_escape_string($conn, $status);

    // Your SQL query to insert data into the staff table
    $sql = "INSERT INTO employee (name, role, contact, email, status) VALUES ('$name', '$role', '$mobile', '$email', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Staff added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding staff: " . mysqli_error($conn)]);
    }
}



// Define the getService function
function getStaff($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM employee WHERE id = $id";

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
function editStaff($id, $name, $role, $email, $mobile, $status) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $role = mysqli_real_escape_string($conn, $role);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE employee SET name = '$name', role = '$role', email = '$email', contact = '$mobile', status = '$status' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Staff updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating staff: " . mysqli_error($conn)]);
    }
}


// Define the deleteService function
function deleteStaff($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM employee WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Staff deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting service: " . mysqli_error($conn)]);
    }
}

?>
