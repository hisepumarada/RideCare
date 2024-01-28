<?php   
 
 if (isset($_POST['email']) && isset($_POST['password'])) {


function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$email = validate($_POST['email']);
$password = validate($_POST['password']);
$hashed =hash('sha512', $password);

if (empty($email)) {
    ?>
            <script>
            swal({
             title: "Email Address is Required",
             text: "Please Check your email",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
}else if(empty($password)){
    ?>
            <script>
            swal({
             title: "Password is Required",
             text: "Please Check your password",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
}else{

    $password = md5($password);

    
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] === $email && $row['password'] === $password && $row["usertype"]=="rider") {
            $_SESSION['email'] = $row['email'];
            $_SESSION['usertype_id'] = $row['usertype_id'];
            $_SESSION["email"]=$email;
            echo "<script> window.location.href='rider/userhome.php';</script>";
        }
        elseif($row["usertype"]=="shop"){
    
            $_SESSION["email"]=$email;
            echo "<script> window.location.href='shop/shopdashboard.php';</script>";
        }
        else{
            ?>
            <script>
            swal({
             title: "Incorect Email or password",
             text: "Please Check your email or password",
             icon: "warning",
             button: "Okay",
           });
           </script>  
        <?php
        }
    }else{
        ?>
        <script>
        swal({
         title: "Incorect Email or password",
         text: "Please Check your Input",
         icon: "warning",
         button: "Okay",
       });
       </script>  
    <?php
    }
}}?>   

