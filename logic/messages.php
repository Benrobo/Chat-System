<?php 
require("../config/db.php"); 


if(isset($_POST['fetch_msg']) && isset($_POST['incoming_id']) && isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    $email = $_COOKIE['email'];
    $user_id = $_COOKIE['user_id'];
    
    $outgoing_id = mysqli_real_escape_string($conn, $user_id);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    $query_user = mysqli_query($conn, "SELECT * FROM user_msg INNER JOIN user_info ON user_info.userId = user_msg.incoming_id WHERE outgoing_id='$outgoing_id' AND incoming_id='$incoming_id' OR outgoing_id='$incoming_id' AND incoming_id='$outgoing_id' ORDER BY 1 ASC");

    $count = mysqli_num_rows($query_user);
    if($count > 0){
        while($data =mysqli_fetch_assoc($query_user)){
            if($data['outgoing_id'] == $outgoing_id){//this will check if we are the sender
                echo '
                <div id="chat" class="msg outgoing">
                    <div class="details">
                    <div class="user-img" style="background: url(user_img_uploads/'.$data['user_img'].'); background-size:cover; background-position:center;"></div>
                    <p data-id="'.$data['userId'].'">'.$data['messages'].'</p>
                    </div>
                </div>
                ';
            }else{//this will be receiver by default
                echo '
                <div id="chat" class="msg incoming">
                    <div class="details" >
                    <div class="user-img" style="background: url(user_img_uploads/'.$data['user_img'].'); background-size:cover; background-position:center;"></div>
                    <p data-id="'.$data['userId'].'">'.$data['messages'].'</p>
                    </div>
                </div>
                ';
            }
        }
    }else{
        echo "Null".mysqli_error($conn);
        die;
    }

    
}  
else{
    header("location: ../login.php");
    die;
}


?>