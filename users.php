<?php require("./config/db.php"); 

if(isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    // normal codes run
    $email = $_COOKIE['email'];
    $user_id = $_COOKIE['user_id'];

}else{
    header("location: index.php");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Home Page" />
    <title>Chatpro | Users</title>
    <!-- css and bootstrap -->
    <link rel="stylesheet" href="css/chat.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- boostrap js and jqouery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- chart.css -->
    <!-- js files -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- icon script -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
  </head>
<body>


<div class="users-container">
  <div class="logged-in-user">
    <?php  
        if(isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
            $query_user = mysqli_query($conn, "SELECT * FROM user_info WHERE email='$email' AND userId='$user_id'");

            $data =mysqli_fetch_assoc($query_user);

    ?>
        <div class="user-img" style="background:url('user_img_uploads/<?php echo $data['user_img']; ?>'); background-size:cover;background-position:center;"></div>
        <div class="user-action">
        <button class="button" id="formuploadbtn">
            <span></span><ion-icon class="uploadicon" name="cloud-upload-outline"></ion-icon></span>
        </button>
        </div>
        <div class="user-info">
        <p class="username"><?php echo $data['username'];?></p>
        <div class="clear-fix">
            <?php if($data['status'] === "On"){?>
                <div class="float-right ml-2">
                <span><ion-icon class="online-circle" name="ellipse"></ion-icon></span>
                </div>
            <?php }?>
        </div>
        <br>
        <div class="logout-cont mt-4">
            <a href="logic/user_logout.php?uid=<?php echo $data['userId']; ?>" class="logout"><ion-icon name="lock-open"></ion-icon>  Logout</a>
        </div>
        </div>
    <?php }?>
  </div>

  <div class="users-fields mt-2">
    <div class="searchbar">
      <p>Search for available users.</p>
        <form class="form form-group" id="form-upload-cont">
            <!-- input -->
            <input type="text" placeholder="Search available user" id="searchinp" class="searchinp mr-2">

            <button class="searchbtn" type="button">
                <ion-icon name="search"></ion-icon>
            </button>
        </form>
    </div>
    <!-- users cont -->
    <div class="users-container-section">
      <p id="search-error" class="ml-3"></p>
      <div class="users-cont" id="users-cont"></div>
    </div>
  </div>
</div>


<!--form upload modal-->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <p>Upload Profile Pics</p>
      <br>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
        <div class="img-preview">
            <img id="img-preview" alt="">
        </div>

        <p class="text-danger upload_err text-center"></p>
        
        <form id="upload_form">
            <input type="file" name="file" id="hidden_file">

            <!-- <button id="file_choose_btn"><ion-icon name="cloud-upload-outline"></ion-icon> Choose file</button> -->
            <!-- <label class="fileval">No file choosen</label> -->

            <button id="file_upload_btn" class="mt-1"><ion-icon name="cloud-upload-outline" type="submit"></ion-icon>Upload file</button>
        </form>
      <hr>
    </div>
  </div>
</div>

<script>
  let searchbtn = document.querySelector(".searchbtn");
  let searchinp = document.querySelector(".searchinp")
  let isclicked = false;

  searchbtn.addEventListener("click", (e)=>{
    e.preventDefault();
    if(isclicked == false){
      searchinp.style.visibility = "visible";
      isclicked = true;
      searchbtn.innerHTML = `<ion-icon name="close-outline"></ion-icon>`;
    }else{
      searchinp.style.visibility = "hidden";
      searchbtn.innerHTML = `<ion-icon name=""></ion-icon>`;
      isclicked = false;
    }  
  });

  let usersSectionCont = document.querySelector(".users-container-section");

  usersSectionCont.style.height = "50vh";
  if(usersSectionCont.style.height == "50vh"){
    usersSectionCont.style.overflowY = "scroll";
  }
</script>

<script src="./js/insert_data.js"></script>
<script src="./js/fetch_user.js"></script>
