<?php 

require_once("../config/db.php");

if(isset($_POST['signupbtn'])){

    $dir = "../user_img_uploads/";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $file = mysqli_real_escape_string($conn, $_FILES['fileupload']['name']);

    $newfile = pathinfo($dir.$file);
    // print_r($newfile);die;

    #replace file name with a random integer
    $rand_num = mt_rand(3948, 398569);

    $newfile_name = str_replace($newfile['filename'], $rand_num, $newfile);

    // previwew image in client area
    $new_img = $newfile_name['basename'];

    $short_file_name = $dir.$newfile_name['basename'];
    $short_file_ext = $newfile_name['extension'];

    // check if email already exist
    $query_stmt = mysqli_query($conn, "SELECT * FROM user_info WHERE email='$email'");
    $count = mysqli_num_rows($query_stmt);
    

    if(empty($username) || empty($email) || empty($pwd) || empty($_FILES['fileupload']['name'])){
        $err = "fields cannot be empty";
        header("location: ../signup.php?err=$err");
        die;
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err = "Email given is incorrect";
        header("location: ../signup.php?err=$err");
        die;
    }
    else if(strlen($pwd) < 6){
        $err = "Password length must be 8";
        header("location: ../signup.php?err=$err");
        die;
    }
    else if($count > 0){
        $err = "User with that email already exist";
        header("location: ../signup.php?err=$err");
        die;
    }
    else{   
        // handle file uploads
        $file_size = $_FILES['fileupload']['size'];
        $user_id = mt_rand(3948, 398569);
        $status = "Off";
        $newpwd = password_hash($pwd, PASSWORD_BCRYPT);
        if($short_file_ext != "jpg" && $short_file_ext != "jpeg" && $short_file_ext != "png"){
            $err = "File must be a valid type : jpeg, jpg, png";
            header("location: ../signup.php?err=$err");
            die;
        }
        else if($file_size > 500000){
            $err = "File size is too large";
            header("location: ../signup.php?err=$err");
            die;
        }
        else if(move_uploaded_file($_FILES["fileupload"]["tmp_name"],$short_file_name)){
            // insert data into db
            $query_sql = mysqli_query($conn, "INSERT INTO user_info(userId, username,password,email,user_img,status) VALUES('$user_id','$username','$newpwd','$email','$new_img', '$status')");
            if($query_sql){
                $msg = "Account created successfully";
                header("location: ../signup.php?msg=$msg");
                die;
            }else{
                $err = "Something went wrong, please try later".mysqli_error($conn);
                header("location: ../signup.php?err=$err");
                die;
            }
        }
    }

}
else{
    header("location: ../signup.php");
    die;
}
?>