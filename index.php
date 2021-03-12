<?php 
if(isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    header("location: users.php");
    die;
}else{
    // run normal code here
}
?>
<?php require("inc/head.php"); ?>


<?php require("inc/nav.php"); ?>


<?php require("inc/header.php"); ?>

<?php require("inc/footer.php"); ?>

