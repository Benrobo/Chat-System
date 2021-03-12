<?php require("inc/head.php"); ?>

<?php 

session_start();

// if(isset($_COOKIE['user_id'])){
//     header("location: index.php");
// }else{
//     echo "nOT set";
// }
if(isset($_COOKIE['user_id']) || isset($_COOKIE['user_email']) || isset($_SESSION['user_id']) || isset($_SESSION['email'])){
    header("location: ./index.php");
}

?>

<?php require("inc/nav.php"); ?>


<div class="section">
  <div class="forms">
    <div class="signup-form">
      <form action="./logic/signup.php" method="post" class="form-group" enctype="multipart/form-data">
        <div class="head">
          <h3>Register Account</h3>
        </div>

        <?php if(isset($_GET['err'])){?>
            <div class="alert alert-danger" style="font-weight:450;"><small><?php echo $_GET['err']; ?></small></div>
        <?php }else if(isset($_GET['msg'])){?>
            <div class="alert alert-success acctcreated" style="font-weight:450;"><small><?php echo $_GET['msg']; ?></small></div>
        <?php }?>
        <input type="text" placeholder="Username" name="username" class="form-control inp-username">

        <input type="email" placeholder="email" name="email" class="form-control inp-email mt-2">

        <!-- file -->
        <input type="file" name="fileupload" class="fileupload mt-2" id="fileupload">

        <input type="password" placeholder="pwd" name="pwd" class="form-control inp-pwd mt-2">

        <input type="submit" name="signupbtn" class="btn btn-info mt-2 btn-block signupbtn">
      </form>
    </div>
  </div>
</div>

<script>
    setTimeout(() => {
        let alertmsg = document.querySelector(".acctcreated");
        alertmsg.style.display = "none";
        window.location = "login.php";
    }, 1000);
</script>

<!-- <script src="./js/jquery.js"></script> -->
<!-- <script src="./js/insert_data.js"></script> -->
<?php require("inc/footer.php"); ?>
