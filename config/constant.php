<?php
//start session
session_start();

define('SITEURL', 'http://localhost/food_order/');

$host = 'localhost';
$db_username = 'root';
$db_password = '';
$dbname = 'food-order';

$conn = mysqli_connect($host, $db_username, $db_password) or die(mysqli_error($conn)); #database connection
$db_select = mysqli_select_db($conn, $dbname) or die(mysqli_error($conn)); #select database
