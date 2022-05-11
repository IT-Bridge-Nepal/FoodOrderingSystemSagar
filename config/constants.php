<?php

// session
session_start();

// constants to store repeating values
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST','localhost:3307');
define('DB_USERNAME','root');
define('DB_PASSWORD','password');
define('DB_NAME','food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die(mysqli_error($e));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($e));

?>