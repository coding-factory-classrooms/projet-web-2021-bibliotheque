<?php

require_once "../init.php";

function handleError($message) {
    $_SESSION['error_message'] = $message;
    header('Location: ../../'.'?p=login');
    die();
}

$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

//  Récupération du pseudo et de son mdp hashé
$req = $db->query('SELECT U.username, U.password, U.numUser FROM user as U WHERE U.username like "'.$result["username"].'"');
$resultDB = $req->fetch(PDO::FETCH_ASSOC);

var_dump($resultDB);

if (!$resultDB){
    echo 'Bad username !';
    handleError("Wrong Username");
}
else{
    // Comparaison du mdp envoyé via le formulaire avec la base
    //$isPasswordCorrect = password_verify($result['psw'], $resultDB['Password']);
    if ($result['password']==$resultDB['password']) {
        $_SESSION['ID'] = (int) $resultDB['numUser'];
        $_SESSION['Username'] = $resultDB['username'];

        header('Location: ../../'.'?p=home');
        die();
    }
    else {
        echo 'Bad password !';
        handleError("Wrong Password");
    }
}

?>