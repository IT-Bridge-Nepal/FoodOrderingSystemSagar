<?php
// Authorization access control
// check whether user is logged in or not
if(!isset($_SESSION['user']))//if user session is not set
{
// user is not logged in
// redirect to login page
$_SESSION['no-login'] = "<div class='error text-center'>Please login to access admin panel</div>";
        header('location:'.SITEURL.'admin/login.php');
}
?>