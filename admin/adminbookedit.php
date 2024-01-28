<?php  
	include "../db_conn.php";
    if(isset($_GET['date'])){
        $date = $_GET['date'];
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $id = $_POST["id"];
    $text = $_POST["text"];
    $column_name = $_POST["column_name"];
    $sql = "UPDATE appointment SET $column_name = '$text' WHERE appointment_id = '$id'";
    
	if(mysqli_query($conn, $sql))  
	{  
		?>
           <script>
   
           swal({
            title: "Success",
            text: "Data Updated",
            icon: "success",
            button: "Okay!",
            });

           </script>
   
   <?php 
	}  
 ?>
 