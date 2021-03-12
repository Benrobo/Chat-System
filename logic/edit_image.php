<?php 

require("../config/db.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $dir = "../user_img_uploads/";
    $file =  mysqli_real_escape_string($conn, $_FILES['file']['name']);

    $newfile = pathinfo($dir.$file);

    $rand_num = rand(100000, 10000);

    $newfile_name = str_replace($newfile['filename'], $rand_num, $newfile);

    // previwew image in client area
    $new_img = $newfile_name['basename'];

    $short_file_name = $dir.$newfile_name['basename'];
    $short_file_ext = $newfile_name['extension'];

    $file_size = $_FILES['file']['size'];
    $user_id = rand(100000000, 10000000000);
    // validate file type
    if($short_file_ext != "jpg" && $short_file_ext != "jpeg" && $short_file_ext != "png"){
        echo "Invalid File";
        die;
    }
    else if($file_size > 500000){
        echo "Large";
        die;
    }
    else if(move_uploaded_file($_FILES["file"]["tmp_name"], $short_file_name)){
        // update img in db
        $email = $_COOKIE['email'];
        $query_sql = mysqli_query($conn, "UPDATE user_info SET user_img='$new_img' WHERE email='$email'");
        if($query_sql){
            echo "./user_img_uploads/".$new_img;
            // echo "Success";
            die;
        }else{
            echo "Failure";
            die;
        }
    }
}
?>