<?php  


    
	include "../db_conn.php";
	$sql = "DELETE FROM appointment WHERE appointment_id = '".$_POST["id"]."'";  
	if(mysqli_query($conn, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>