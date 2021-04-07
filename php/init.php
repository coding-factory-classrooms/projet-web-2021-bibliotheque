<?php 
require_once "management/db.php";

session_start();

$req = $db->query('SELECT U.username FROM user as U');
$resultDB = $req->fetchAll(PDO::FETCH_ASSOC);

//The different status
$pages = ['home','register','login','stats','main','addCategory'];
$del = ['logOut'];
?>