<?php require("inc/head.php"); ?>


<?php require("inc/nav.php"); ?>

<?php 

if(isset($_COOKIE['user_id']) || isset($_COOKIE['user_email']) || isset($_SESSION['user_id']) || isset($_SESSION['email'])){
    header("location: ./index.php");
}

?>

<div class="section">
  <div class="forms">
    <div class="signup-form">
      <form action="./logic/login.php" method="post" class="form-group">
        <div class="head">
          <h3>Login</h3>
        </div>
        <?php if(isset($_GET['err'])){?>
            <div class="alert alert-danger" style="font-weight:450;"><small><?php echo $_GET['err']; ?></small></div>
        <?php }else if(isset($_GET['msg'])){?>
            <div class="alert alert-success acctcreated" style="font-weight:450;"><small><?php echo $_GET['msg']; ?></small></div>
        <?php }?>

        <input type="email" placeholder="email" name="email" class="form-control inp-email mt-2">

        <input type="password" placeholder="pwd" name="pwd" class="form-control inp-pwd mt-2">

        <input type="submit" name="loginbtn" class="btn btn-info mt-2 btn-block">
      </form>
    </div>
  </div>
</div>


<?php require("inc/footer.php"); ?>
