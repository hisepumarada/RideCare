<?php
session_start();
include "../db_conn.php";

if (isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];

    // Perform the delete operation
    $delete_query = "DELETE FROM appointment WHERE appointment_id = $appointment_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // If the deletion was successful, you can send a success response
        echo json_encode(['success' => true, 'message' => 'Appointment deleted successfully']);
    } else {
        // If there was an error with the deletion, you can send an error response
        echo json_encode(['success' => false, 'message' => 'Error deleting appointment']);
    }
} else {
    // If appointment_id is not set in the POST data, send an error response
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>