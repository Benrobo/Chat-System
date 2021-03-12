<?php 
require("../config/db.php"); 

$email = $_COOKIE['email'];
$user_id = $_COOKIE['user_id'];


if(isset($_POST['fetchUser'])  && isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    $query_user = mysqli_query($conn, "SELECT * FROM user_info WHERE NOT email='$email'");

    while($data =mysqli_fetch_assoc($query_user)){
        if($data['status'] === "On"){
            echo '<a href="chat.php?uid='.$data['userId'].'" class="btn btn-default btn-block">
            <div class="box">
            <div class="user-img" style="background:url(user_img_uploads/'.$data["user_img"].'); background-size:cover;background-position:center;"></div>
            <div class="user-info">
                <p class="username">'.$data['username'].'<small><b></b>
                <div class="user-status">
                    <ion-icon class="online-circle  ml-1" name="ellipse"></ion-icon>
                </div>
                </small></p>
                <p class="user-msg"><small></small></p>
            </div>
            </div>
            </a>';
        }else if($data['status'] === "Off"){
            echo '<a href="chat.php?uid='.$data['userId'].'" class="btn btn-default btn-block">
            <div class="box">
            <div class="user-img" style="background:url(user_img_uploads/'.$data["user_img"].'); background-size:cover;background-position:center;"></div>
            <div class="user-info">
                <p class="username">'.$data['username'].'<small><b></b>
                <div class="user-status">
                    <ion-icon class="offline-circle  ml-1" name="ellipse"></ion-icon>
                </div>
                </small></p>
                <p class="user-msg"><small></small></p>
            </div>
            </div>
            </a>';
        }
    }

    
}  



?>