<?php 
require_once "management/db.php";

session_start();

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .');';
    echo '</script>';
}

function miniTileObject($object){
    echo 
     '<div class="element-cat id">',
     '<a class="linkObject" href="?p=addObject&c='.$object['numCategorie'].'&o='.$object['numObject'].'">',
     '<p class="nameObject"><b>'.$object['name'].'</b></p>',
     '<p class="tagsObject"> <i>Tags:</i> '.$object['tags'].'</p>',
     '<br>',
     '<p class="descriptionObject hidden"> Desc: '.$object['description'].'</p>',
     '<p class="advancementObject hidden"> advancement: '.$object['advancement'].'<p>',
     '</a>',
     '</div>';
}

function verifLogin(){
    if ($_SESSION == null){
        header('Location: ?p=login');
    }
}

$req = $db->query('SELECT U.username FROM user as U');
$resultDB = $req->fetchAll(PDO::FETCH_ASSOC);

//The different status
$pages = ['home','register','login','stats','main','archive','addObject','viewCategory','deleteCategory'];
$del = ['logOut'];
?>