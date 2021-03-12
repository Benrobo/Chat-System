<?php 
require("../config/db.php"); 

$email = $_COOKIE['email'];
$user_id = $_COOKIE['user_id'];


if(isset($_POST['searchUsers']) && isset($_POST['searchinp'])){
    $searchinp = mysqli_real_escape_string($conn, $_POST['searchinp']);

    $query_user = mysqli_query($conn, "SELECT * FROM user_info WHERE username LIKE '%$searchinp%' AND NOT email='$email'");
    
    $count = mysqli_num_rows($query_user);
    if($count > 0){
        while($data =mysqli_fetch_assoc($query_user)){
            if($data['status'] === "On"){
                echo '<a href="chat.php?uid='.$data['userId'].'">
                <div class="box m-2">
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
                echo '<a href="chat.php?uid='.$data['userId'].'">
                <div class="box m-2">
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
    else{
        echo "No user(s) was found with that username";
    }

}

?>