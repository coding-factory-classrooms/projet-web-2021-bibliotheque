<?php
require_once "../init.php";

//Print an error when a value is not correct
function handleError($message) {
    $_SESSION['error_message'] = $message;
    header('Location: ../../'.'?p=addCategory');
    die();
}
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

$listObjectBeforeFetch = $db->query('SELECT O.numObject FROM categorie as C and object as O WHERE O.numCategorie = C.numCategorie and C.numUser = '.$_SESSION['ID'].' ');
$listObject = $listObjectBeforeFetch->fetchAll(PDO::FETCH_ASSOC);

$req = $db->prepare('INSERT INTO object (
    numUser, numCategorie, numObject, name, image, description, tags, advancement
    ) VALUES(:numUser, :numCategorie, :numObject, :name, :image, :description, :tags, :advancement)');
$req->bindValue(':numUser' , $_SESSION['ID']); 
$req->bindValue(':numCategorie' , count($listCategory)-1);
$req->bindValue(':numObject', count($listObject));
$req->bindValue(':name' , $result["name"]);

$notEssentials = ['image','description','tags','advancement'];
foreach($notEssentials as $notEssential){
    if ($result[$notEssential] == ''){
        $req->bindValue(':'.$notEssential, '');
    } else {
        $req->bindValue(':'.$notEssential, $result[$notEssential]);
    }
}
$req->execute();

echo "\n envoie réussi";
//header('Location: ../../'.'?p=home');
die;

?>