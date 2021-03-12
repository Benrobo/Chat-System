<?php 
require("../config/db.php"); 

$email = $_COOKIE['email'];
$user_id = $_COOKIE['user_id'];


if(isset($_POST['fetchUserStatus'])){
    $query_user = mysqli_query($conn, "SELECT * FROM user_info");

    while($data =mysqli_fetch_assoc($query_user)){
        
        if($data['status'] === "On"){
            echo '<ion-icon class="online-circle  ml-1" name="ellipse"></ion-icon>';
        }else if($data['status'] === "Off"){
            echo '<ion-icon class="offline-circle  ml-1" name="ellipse"></ion-icon>';
            die;
        }
    }

    
}  



?>