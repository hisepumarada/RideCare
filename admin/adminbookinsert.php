<?php  
include "../db_conn.php";
$sql = "INSERT INTO appointment(name, service) VALUES('".$_POST["name"]."', '".$_POST["service"]."')";  
if(mysqli_query($conn, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>