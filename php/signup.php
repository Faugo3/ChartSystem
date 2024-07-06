<?php 
session_start();
 include_once "config.php";
 $fname = mysqli_real_escape_string($conn, $_POST['fname']);
 $lname = mysqli_real_escape_string($conn, $_POST['lname']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

 if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
     // email validation
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
         // email already exist in the database or not
         $sql = mysqli_query($conn, "SELECT email FROM user WHERE email ='{$email}'");
         if(mysqli_num_rows($sql) > 0){ // if email already exist
            echo "$email - This email already exist";
         }else{
            // let's check user upload file or not
            if(isset($_FILES['image'])){  // if file is upload
                 $img_name = $_FILES['image']['name']; // getting user upload img name
                 $tmp_name = $_FILES['image']['tmp_name']; // this temporary name is used to save/move file in our folder

               // only the extension like png jpg accepted
               $img_explode = explode('.', $img_name);
               $img_ext = end($img_explode); // here we get the extension of a user upload img file

               $extensions = ['png', 'jpeg', 'jpg']; //accepted extensions
               if(in_array($img_ext, $extensions) === true){
                    $time = time();
 
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name, "image/".$new_img_name)){;
                    $status = "Active now";
                    $random_id = rand(time(), 10000000);

                    $sql2 = mysqli_query($conn, "INSERT INTO user (unique_id, fname, lname, email, password, img, status)
                                        VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                    
                    if($sql2){
                        $sql3 = mysqli_query($conn, "SELECT * FROM user WHERE email = '{$email}'");
                        if(mysqli_num_rows($sql3) > 0){
                            $row = mysqli_fetch_assoc($sql3);
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo "Success!";
                        }
                    }else{
                        echo "something went Wrong Please try Again!";
                    }
                    }
               }else{
                echo "Please select an image file - jpeg, jpg, png!";
               }

            }else{
                echo "Please select an image file";
            }
         }
    }else{
        echo " $email - This is not a valid email!";
    }
 }else{
    echo "All input field are required please !";
 }
?>