<?php 
require_once "management/db.php";

session_start();

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

function miniTileObject($object){
    echo '<div class="element-cat id">';
    echo '<p class="nameObject">'.$object['name'].'</p>';
    echo '<p class="tagsObject"> Tags: '.$object['tags'].'</p>';
    echo '<p class="descriptionObject"> Desc: '.$object['description'].'</p>';
    echo '<p class=advancementObject> advancement <p>';
    echo '</div>';
}

function verifLogin(){
    if ($_SESSION == null){
        header('Location: ?p=login');
    }
}

$req = $db->query('SELECT U.username FROM user as U');
$resultDB = $req->fetchAll(PDO::FETCH_ASSOC);

//The different status
$pages = ['home','register','login', 'register','stats','main','addCategory','addObject','viewCategory'];
$del = ['logOut'];
?>