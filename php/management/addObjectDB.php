<?php
require_once "../init.php";

//Print an error when a value is not correct
function handleError($message) {
    $_SESSION['error_message'] = $message;
    header('Location: ../../'.'?p=addObject');
    die();
}
//Get the data from the url
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

//We search for the category in the DB to make sur the object will be add in the correct one
$req = $db->query('SELECT C.numCategorie FROM categorie as C WHERE C.name like "'.$result["category"].'"');
$resultDB = $req->fetch(PDO::FETCH_ASSOC);
//var_dump($resultDB);

console_log($_SESSION['ID']);

if ($resultDB){
    switch ($result["submit"]){
        case "Confirmer":
            //To return to list of object we have in this category. We need the number to add it properly.
            $listObjectBeforeFetch = $db->query('SELECT I.numObject, I.name FROM item as I WHERE I.numCategorie = '.$resultDB['numCategorie'].' and I.numUser = '.$_SESSION['ID'].' ');
            if ($listObjectBeforeFetch != false){
                $listObject = $listObjectBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $listObject = [];
            }

            $isTaken = false;
            for ($i=0;$i<count($listObject);$i++){
                if ($listObject[$i]['name']== $result['name']){
                    $isTaken = true;
                    break;
                }
            }
            if (!$isTaken){
                //Prepare to add the object
                $req = $db->prepare('INSERT INTO item (
                    numUser, numCategorie, numObject, name, image, description, tags
                    ) VALUES (:numUser, :numCategorie, :numObject, :name, :image, :description, :tags)');

                $req->bindValue(':numUser' , $_SESSION['ID']); 
                $req->bindValue(':numCategorie' , $resultDB['numCategorie']);
                $req->bindValue(':numObject', count($listObject));
                $req->bindValue(':name' , $result["name"]);

                //Because this parameters can be blank, we need to specify it clearly
                $notEssentials = ['image','description','tags'];
                foreach($notEssentials as $notEssential){
                    if ($result[$notEssential] == ''){
                        $req->bindValue(':'.$notEssential, '');
                    } else {
                        $req->bindValue(':'.$notEssential, $result[$notEssential]);
                    }
                }
                $req->execute();
    
                echo "\n Envoie réussi";
                echo "<script type='text/javascript'> history.go(-2); </script>";
                die;
            }
            else {
                echo 'Bad name !';
                handleError("Nom d'objet déjà utilisé.");
            }
            break;

        case "Modifier":
            //To modify an item
            $currentObject = explode(",", $result["currentObject"]);

            //Because there some problems if result["advancement"] is always visible
            if (isset($result['advancement'])){
                $adv = implode(",",$result["advancement"]);
            } 
            else { $adv = ""; }

            //Modify all value to make sure we lose nothing new
            $req = $db->prepare('UPDATE item SET 
                name="'.$result["name"].'", image="'.$result["image"].'", description="'.$result["description"].'", tags="'.$result["tags"].'", advancement="'.$adv.'"
                WHERE numUser = '.$_SESSION['ID'].' AND numCategorie = '.(int)$currentObject[0].' AND numObject = '.(int)$currentObject[1].'');
            $req->execute();
            echo "<script type='text/javascript'> history.go(-2); </script>";
            break;
            
        case "Supprimer":
            $currentObject = explode(",", $result["currentObject"]);
            //We delete the current object
            $req = $db->prepare('DELETE FROM item 
                WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$currentObject[0].' AND numObject='.(int)$currentObject[1].'');
            $req->execute();

            //Then, we decrement by 1 all the item that has been created after, to make sure all the item is between 0 and n-1, which represente the
            //number of items.
            $req = $db->query('SELECT numObject, numCategorie FROM item 
                WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$currentObject[0].' AND numObject >'.(int)$currentObject[1].'');
            $listObjectmadeAfter = $req->fetchAll(PDO::FETCH_ASSOC);

            if ($listObjectmadeAfter != false){
                foreach($listObjectmadeAfter as $object){
                    $newIndex = $object['numObject']-1;
                    $req = $db->prepare('UPDATE item SET numObject='.$newIndex.' WHERE numUser='.$_SESSION['ID'].' AND 
                            numCategorie = '.$object['numCategorie'].' AND numObject = '.$object['numObject'].'');
                    $req->execute();
                }
            }
            echo "<script type='text/javascript'> history.go(-2); </script>";
            break;
    }
}
else{
    echo 'Bad category !';
    handleError("Aucune Catégorie n'existe sous ce nom.");
}
?>