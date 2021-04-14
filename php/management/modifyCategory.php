<?php
require_once "../init.php";
//Get the data from the url
$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url["query"],$result);
var_dump($result);

$adv = [];
for ($i=0; $i<(int)$result['advancement']; $i++){
    array_push($adv, $result[$i]);
}

//Modify all value to make sure we lose nothing new
$req = $db->prepare('UPDATE categorie SET 
    name="'.$result["nameModify"].'", advancement = "'.base64_encode(serialize($adv)).'"
    WHERE numUser = '.$_SESSION['ID'].' AND numCategorie = '.(int)$result['currentCategory'].'');
var_dump($req);
$req->execute();
echo "<script type='text/javascript'> history.go(-1); </script>";
?>