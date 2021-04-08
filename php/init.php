<?php 
require_once "management/db.php";

session_start();

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$req = $db->query('SELECT U.username FROM user as U');
$resultDB = $req->fetchAll(PDO::FETCH_ASSOC);

//The different status
$pages = ['home','register','login','stats','main','addCategory','addObject'];
$del = ['logOut'];
?>