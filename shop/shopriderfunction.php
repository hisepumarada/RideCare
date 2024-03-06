<?php
// Assuming this file contains your database connection
include "../db_conn.php";

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'get_user':
            if(isset($_POST['usertypeId'])) {
                // Sanitize the input
                $usertypeId = filter_input(INPUT_POST, 'usertypeId', FILTER_SANITIZE_NUMBER_INT);

                // Prepare your SQL statement with a parameterized query to prevent SQL injection
                $sql = "SELECT * FROM user WHERE usertype_id = ?";

                // Prepare and execute the statement
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $usertypeId);
                $stmt->execute();

                // Get the result set
                $result = $stmt->get_result();

                // Fetch the user data
                $user = $result->fetch_assoc();

                // Check if a user is found
                if ($user) {
                    // Output the user data as JSON
                    echo json_encode($user);
                } else {
                    // No user found with the provided usertypeId
                    echo json_encode(["message" => "No user found"]);
                }

                // Close the statement
                $stmt->close();
            } else {
                // 'usertypeId' is not set in the POST request
                echo json_encode(["error" => "Invalid request"]);
            }
            break;
        
        case 'approve':
            if(isset($_POST['usertypeId'])) {
                $usertypeId = $_POST['usertypeId'];
                $email = approveAction($usertypeId);
                if ($email) {
                    echo json_encode(["message" => "Rider approved successfully", "email" => $email]);
                } else {
                    echo json_encode(["message" => "Failed to approve rider"]);
                }
            } else {
                // 'usertypeId' is not set in the POST request
                echo json_encode(["error" => "Invalid request"]);
            }
            break;
        
        default:
            echo json_encode(["error" => "Invalid action"]);
            break;
    }
}

function approveAction($usertypeId) {
    global $conn;

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $usertypeId);

    // Update the status of users with the specified usertype and status = '0' to '1'
    $sql = "UPDATE user SET status = 'approve' WHERE usertype_id = $id";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the email address of the approved user
        $sql = "SELECT email FROM user WHERE usertype_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['email'];
    } else {
        return null;
    }
}

function viewAction() {
    // Implement view action if needed
}

// Add more functions as needed

