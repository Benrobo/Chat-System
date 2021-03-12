<?php 

require_once("../config/db.php");


if(isset($_POST['loginbtn'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // check if email already exist
    $query_stmt = mysqli_query($conn, "SELECT * FROM user_info WHERE email='$email'");
    $data = mysqli_fetch_assoc($query_stmt);
    $pwd_hash = $data['password'];
    $count = mysqli_num_rows($query_stmt);
    

    if(empty($email) || empty($pwd)){
        $err = "fields cannot be empty";
        header("location: ../login.php?err=$err");
        die;
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err = "Email given is incorrect";
        header("location: ../login.php?err=$err");
        die;
    }
    else if(strlen($pwd) < 6){
        $err = "Password length must be 8";
        header("location: ../login.php?err=$err");
        die;
    }
    else if($count == 0){
        $err = "Email given isn't yet registered";
        header("location: ../login.php?err=$err");
        die;
    }
    else if(!password_verify($pwd, $pwd_hash)){   
        $err = "Password is incorrect";
        header("location: ../login.php?err=$err");
        die;
    }
    else{
        $status = "ON";
       $query_stmt = mysqli_query($conn, "UPDATE user_info SET status='On' WHERE email='$email'"); 
       if($query_stmt){
            session_start();
            $user_email = $data['email'];
            $user_id = $data['userId'];

            setcookie("email",$user_email, time()+8694000, "/");
            setcookie("user_id",$user_id, time()+8694000, "/");
            header("location: ../users.php");
       }else{
            $err = "Something went wrong pls try logging in later";
            header("location: ../login.php?err=$err");
            die;
       }
    }
}
else if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_email']) && isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    header("location: ../index.php");
}
else{
    header("location: ../index.php");
    die;
}
?>