<?php
// Assuming this file contains your database connection
include "../db_conn.php";

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'get_book':
            if(isset($_POST['AppointmentId'])) {
                // Sanitize the input
                $AppointmentId = filter_input(INPUT_POST, 'AppointmentId', FILTER_SANITIZE_NUMBER_INT);

                // Prepare your SQL statement with a parameterized query to prevent SQL injection
                $sql = "SELECT * FROM appointment WHERE appointment_id = ?";

                // Prepare and execute the statement
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $AppointmentId);
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
            if(isset($_POST['AppointmentId'])) {
                $AppointmentId = $_POST['AppointmentId'];
                $email = approveAction($AppointmentId);
                if ($email) {
                    echo json_encode(["message" => "Booking approved successfully", "email" => $email]);
                } else {
                    echo json_encode(["message" => "Failed to approve rider"]);
                }
            } else {
                // 'usertypeId' is not set in the POST request
                echo json_encode(["error" => "Invalid request"]);
            }
            break;
        case 'close':
                if(isset($_POST['AppointmentId'])) {
                    $AppointmentId = $_POST['AppointmentId'];
                    $email = closeAction($AppointmentId);
                    if ($email) {
                        echo json_encode(["message" => "Sorry the Shop is Closed", "email" => $email]);
                    } else {
                        echo json_encode(["message" => "Failed to close appointment"]);
                    }
                } else {
                    echo json_encode(["error" => "Invalid request"]);
                }
                break;
        default:
            echo json_encode(["error" => "Invalid action"]);
            break;
            
    }
}

function approveAction($AppointmentId) {
    global $conn;

    // Sanitize the input to prevent SQL injection (preferably use prepared statements)
    $id = mysqli_real_escape_string($conn, $AppointmentId);

    // Update the status of the appointment to 'approved'
    $sql = "UPDATE appointment SET status = 'approved' WHERE appointment_id = $id";

    // Execute the query and handle errors
    if ($conn->query($sql) === TRUE) {
        // Fetch the email address of the approved appointment
        $sql = "SELECT email FROM appointment WHERE appointment_id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['email'];
        } else {
            return null; // Appointment not found
        }
    } else {
        // Error occurred while updating the appointment
        return null;
    }
}


function closeAction($AppointmentId) {
    global $conn;

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $AppointmentId);

    // Update the status of the appointment to 'close'
    $sql = "UPDATE appointment SET status = 'close' WHERE appointment_id = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the email address of the user associated with the appointment
        $sql = "SELECT * FROM appointment WHERE appointment_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['email'];
    } else {
        return null;
    }
}


// Add more functions as needed

