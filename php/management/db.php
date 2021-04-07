<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=account;port=3306;charset=utf8',"root", "");
}
catch (Exception $e){
    die('Erreur MySQL, veuillez patienter ou contactez un administrateur. <br /><br />' . $e->getMessage());
}

?>