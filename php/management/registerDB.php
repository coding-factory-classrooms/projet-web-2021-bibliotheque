<?php

require_once "../init.php";

function handleError($message) {
    $_SESSION['error_message'] = $message;
    header('Location: ../../'.'?p=register');
    die();
}

$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

//  Récupération si mail déja utilisé
$req = $db->query('SELECT U.mail FROM user as U WHERE U.mail like "'.$result["mail"].'"');
$listMail = $req->fetch(PDO::FETCH_ASSOC);

var_dump($listMail);

if (!$listMail){
    // Compare the pwd and the confirm in the form to proceed the creation of an account
    if ($result['password']==$result['confirm']) {
        $req = $db->prepare('INSERT INTO user (username, password, mail)
            VALUES (:username, :password, :mail)');
        $req->bindValue(':username', $result['username']);
        $req->bindValue(':password', $result['password']);
        $req->bindValue(':mail', $result['mail']);

        $req->execute();

        header('Location: ../../'.'?p=login');
        die();
    }
    else {
        echo 'Bad password !';
        handleError("Wrong Password");
    }
}
else{
    echo 'mail already use !';
    handleError("Mail already in use !");
}

?>