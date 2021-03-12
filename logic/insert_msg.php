<?php 
require("../config/db.php"); 


if(isset($_POST['insert_data']) && isset($_POST['user_inp']) && isset($_POST['incoming_id']) && isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    $email = $_COOKIE['email'];
    $user_id = $_COOKIE['user_id'];

    $outgoing_id = mysqli_real_escape_string($conn, $user_id);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $msg = mysqli_real_escape_string($conn, $_POST['user_inp']);
    
    $query_user = mysqli_query($conn, "INSERT INTO user_msg(incoming_id,outgoing_id, messages) VALUES('$incoming_id','$outgoing_id','$msg')");

    if(!$query_user){
       echo "An error occur"; 
    }    
}else{
    header("location: ../index.php");
    die;
}  



?>