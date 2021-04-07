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
//We search for the category in the DB to make sur the object will be add in the correct one
$req = $db->query('SELECT C.numCategorie FROM categorie as C WHERE C.name like "'.$result["category"].'"');
$resultDB = $req->fetch(PDO::FETCH_ASSOC);
var_dump($resultDB);

if ($resultDB){
    //To return to list of object we have in this category. We need the number to add it properly.
    $listObjectBeforeFetch = $db->query('SELECT O.numObject O.name FROM categorie as C and object as O WHERE O.numCategorie = C.numCategorie and C.numUser = '.$_SESSION['ID'].' ');
    $listObject = $listObjectBeforeFetch->fetchAll(PDO::FETCH_ASSOC);

    $isTaken = false;
    for ($i=0;$i<count($listObject);$i++){
        if ($listObject['name']== $result['name']){
            $isTaken = true;
            break;
        }
    }
    if (!$isTaken){
        //Prepare to add the object
        $req = $db->prepare('INSERT INTO object (
            numUser, numCategorie, numObject, name, image, description, tags, advancement
            ) VALUES (:numUser, :numCategorie, :numObject, :name, :image, :description, :tags, :advancement)');

        $req->bindValue(':numUser' , $_SESSION['ID']); 
        $req->bindValue(':numCategorie' , $resultDB['numCategorie']);
        $req->bindValue(':numObject', count($listObject));
        $req->bindValue(':name' , $result["name"]);
    
        //Because this parameters can be blank, we need to specify it clearly
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
    }
    else {
        
    }
    
}
else{
    echo 'Bad username !';
    handleError("Aucune Catégorie n'existe sous ce nom.");
}
?>