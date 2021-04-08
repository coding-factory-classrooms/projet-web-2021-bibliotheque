<?php

// check auth

require_once 'php/init.php';
require_once 'php/partials/header.php';

//'pages' and 'delete' are Array declared in init.php and refer to different status

//Uses to switch between the different pages 
$page = 'home';
if (isset($_GET['p'])) {
    if (in_array($_GET['p'],$pages)){
        $page = $_GET['p'];
    }
    else {
        $page = '404';
    }
}
partials_header($page);

//In case the user want to delete or to Log out with his account
if (isset($_GET['delete'])){
    if (in_array($_GET['delete'],$del)){
        require_once 'php/management/'.$_GET['delete'].'.php';
        header('Location: ?p=login');
        die;
    }
}
require_once 'php/views/' . $page . '.php';
?>