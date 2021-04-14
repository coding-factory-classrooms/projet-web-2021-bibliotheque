<?php
//Get the data from the url
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);

$req = $db->prepare('DELETE FROM categorie 
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$result['c'].'');
$req->execute();

$del = $db->prepare('DELETE FROM item
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie='.(int)$result['c'].'');
$del->execute();

//Then, we decrement by 1 all the item that has been created after, to make sure all the item is between 0 and n-1, which represente the
//number of items.
$req = $db->query('SELECT numCategorie FROM categorie 
    WHERE numUser='.$_SESSION['ID'].' AND numCategorie>'.(int)$result['c'].'');
$listCategoryAfter = $req->fetchAll(PDO::FETCH_ASSOC);

var_dump($listCategoryAfter);

if ($listCategoryAfter != false){
    foreach($listCategoryAfter as $category){
        var_dump($category);
        $newIndex = (int)$category['numCategorie']-1;
        var_dump($newIndex);
        $req = $db->prepare('UPDATE categorie SET numCategorie="'.$newIndex.'" WHERE numUser='.$_SESSION['ID'].' AND 
                numCategorie = '.$category['numCategorie'].'');
        $req->execute();
    }
}
header('Location:?p=archive');
?>