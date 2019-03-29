<?php
session_start();
$title = 'About';
require_once ('../../config/config.php');
require APPROOT . INC .'/header.php'; 
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    echo 'You are forbidden! Login first to access this page.<br>You will be redirected to login page in 10 seconds.<br>
    if you dont have an account, please register and then login.';
    header("refresh:10;url='login'");
    exit;
}
?>
<?php include '../inc/pageheading.php'; ?>
<p class="lead text-center"><?php echo 'App version: ' . "<strong>" . APP_VERSION . "</strong>"; ?></p>
</div>
<?php 
include APPROOT . INC . '/footer.php';
?>