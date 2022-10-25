<?php

$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    // echo "test";
    include "/var/www/html/frbackend/forum/partials/dbconnect.php";
    $email = $_POST['loginmail'];
    $pass = $_POST['loginpass'];
    
    $sql="SELECT * FROM `users` WHERE `user_email` = '$email' ";
    // echo $sql;
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            echo "logged in ". $email;
            // echo $_SESSION['id'];
            // exit();
        }
        header("Location: /frbackend/forum/main.php ");
        // header("Location: /frbackend/forum/main.php");



        }
        else{
            echo "unable to login";
        }
    }


?>