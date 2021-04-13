<?php
//Get the data from the url
/*
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

$req = $db->prepare('DELETE FROM categorie 
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$result['c'].'');
$req->execute();

$req = $db->prepare('DELETE FROM item
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$result['c'].'')

//Then, we decrement by 1 all the item that has been created after, to make sure all the item is between 0 and n-1, which represente the
//number of items.
$req = $db->query('SELECT numCategorie FROM categorie 
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie>'.(int)$result['c'].'');
$listCategoryAfter = $req->fetchAll(PDO::FETCH_ASSOC);

if ($listCategoryAfter != false){
    foreach($listCategoryAfter as $category){
        $newIndex = $category['numcategorie']-1;
        $req = $db->prepare('UPDATE item SET numcategorie='.$newIndex.' WHERE numUser='.$_SESSION['ID'].' AND 
                numCategorie = '.$category['numCategorie'].'');
        $req->execute();
    }
}
*/
?>