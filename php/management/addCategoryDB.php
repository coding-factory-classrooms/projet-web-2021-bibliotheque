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

$listCategoryBeforeFetch = $db->query('SELECT C.numCategorie FROM categorie as C Where C.numUser = '.$_SESSION['ID'].'');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);

$req = $db->prepare('INSERT INTO categorie (numCategorie, name, numUser) VALUES(:numCategorie , :name, :numUser)');
$req->bindValue(':name' , $result["name"]);
$req->bindValue(':numCategorie' , count($listCategory));
$req->bindValue(':numUser' , $_SESSION['ID']);

$req->execute();

echo "envoi réussi";
handleError("Création Réussi !");
die;

?>