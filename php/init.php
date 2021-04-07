<?php 
require_once "management/db.php";

session_start();

//The different status
$pages = ['home','register','login','stats','main'];
$del = ['logOut'];
?>