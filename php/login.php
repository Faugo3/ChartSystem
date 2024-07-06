<?php 
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($email) && !empty($password)){
   // check user email and password
   $sql = mysqli_query($conn, "SELECT * FROM user WHERE email ='{$email}' AND password = '{$password}'");
   if(mysqli_num_rows($sql) > 0){
     $row = mysqli_fetch_assoc($sql);
     $status = "Active now";
     $sql2 = mysqli_query($conn, "UPDATE user SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
     if($sql2){
      $_SESSION['unique_id'] = $row['unique_id'];
      echo "Success!";
     }
   }else{
    echo "Email or Password incorrect !";
   }
}else{
    echo "All input field are required please !";
}
?>