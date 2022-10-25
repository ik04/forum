<?php
$showError ="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // include "/var/www/html/frbackend/forum/partials/_loginModal.php";
    include "/var/www/html/frbackend/forum/partials/dbconnect.php";
    $usermail = $_POST['emailsignup'];
    $pass = $_POST['signuppassword'];
    $cpass = $_POST['signupcpassword'];

    $sqlExists="SELECT * FROM `users` WHERE user_email='$usermail'";
    $result = mysqli_query($conn,$sqlExists);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError="Email Already in use.";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass,PASSWORD_DEFAULT);   
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$usermail', '$hash', CURRENT_TIMESTAMP);";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
                header("Location: /frbackend/forum/main.php?signupsuccess=true");
                exit();
            }
            
        }
        else{
            $showError = "passwords do not match" ;
            header("Location: /frbackend/forum/main.php?signupsuccess=false&error=$showError");
        }
    }



}
?>