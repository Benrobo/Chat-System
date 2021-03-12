<?php 
require("../config/db.php");
session_start();
if(isset($_GET['uid']) && isset($_COOKIE['email']) && $_GET['uid'] === $_COOKIE['user_id']){
    $user_email = $_COOKIE['email'];
    $user_id = $_COOKIE['user_id'];

    $status = "Off";

    $query_user_logout = mysqli_query($conn, "UPDATE user_info SET status='$status' WHERE userId='$user_id' && email='$user_email'");

    if($query_user_logout){
        session_destroy();
        session_unset();

        setcookie("email",$user_email, time()-1, "/");
        setcookie("user_id",$user_id, time()-1, "/");

        header("location: ../index.php");
        die;
    }else{
        echo "Error".mysqli_error($conn);
        die;
    }
}else{
    header("location: ../index.php");
    die;
}


?>