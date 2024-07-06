<?php 
   $conn = mysqli_connect("localhost", "root", "", "chart");
   if(!$conn){
    echo "Database connected" . mysqli_connect_error();
   }
?>