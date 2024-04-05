<?php
include "../db_conn.php"; // Include your database connection file

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the action parameter is set and equal to 'getService'
    if (isset($_GET['action']) && $_GET['action'] === 'getProduct') {
        // Handle the getService action
        if (isset($_GET['id'])) {
            // Call the getService function with the provided id
            $id = $_GET['id'];
            $product = getProduct($id);

            // Return the service data as JSON response
            echo json_encode($product);
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
    // Check if the action parameter is set and equal to 'addProduct'
    if (isset($_POST['action']) && $_POST['action'] === 'addProduct') {
        // Handle the addProduct action
        if (isset($_POST['formData'])) {
            // Get the form data
            $formData = $_POST['formData'];
            $name = $formData['name'];
            $quantity = $formData['quantity'];
            $amount = $formData['amount'];
        
            // Call the addProduct function with the provided data
            addProduct($name, $quantity, $amount);
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
    if (isset($_POST['action']) && $_POST['action'] === 'editProduct') {
        // Handle the editProduct action
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['amount'])) {
            // Call the editProduct function with the provided parameters
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $amount = $_POST['amount'];
            editProduct($id, $name, $quantity, $amount);
        } else {
            // Return an error message if any parameter is missing
            echo json_encode(['error' => 'One or more parameters are missing']);
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
    if (isset($_DELETE['action']) && $_DELETE['action'] === 'deleteProduct') {
        // Handle the deleteService action
        if (isset($_DELETE['id'])) {
            // Call the deleteService function with the provided id
            $id = $_DELETE['id'];
            deleteProduct($id);
        } else {
            // Return an error message if id parameter is not set
            echo json_encode(['error' => 'Id parameter is missing']);
        }
    } else {
        // Return an error message for invalid DELETE request
        echo json_encode(['error' => 'Invalid DELETE request']);
    }
}


function addProduct($name, $quantity, $amount) {
    global $conn;

    // Sanitize input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $amount = mysqli_real_escape_string($conn, $amount);

    // Your SQL query to insert data into the product table
    $sql = "INSERT INTO product (name, quantity, amount) VALUES ('$name', '$quantity', '$amount')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Product added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding product: " . mysqli_error($conn)]);
    }
}


// Define the getService function
function getProduct($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    // Your SQL query to select the service
    $sql = "SELECT * FROM product WHERE id = $id";

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
function editProduct($id, $name, $quantity, $amount) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $amount = mysqli_real_escape_string($conn, $amount);

    $sql = "UPDATE product SET name = '$name', quantity = '$quantity', amount = '$amount' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Product updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating product: " . mysqli_error($conn)]);
    }
}

// Define the deleteService function
function deleteProduct($id) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM product WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => "Product deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting service: " . mysqli_error($conn)]);
    }
}

?>
