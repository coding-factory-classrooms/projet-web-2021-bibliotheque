<?php
require_once "php/init.php";
//Get the index of the category in the url
if (isset($_GET['c'])) {
    if ($_GET['c'] != null){
      $index = $_GET['c'];
    }else {
      $index = 0; 
    }
}else {
    $index = 0; 
}

//The index of the current category

$categoryNameBeforeFetch = $db->query('SELECT C.name FROM categorie C WHERE C.numCategorie = '.$index.' and C.numUser = '.$_SESSION['ID'].' ');
$categoryName = $categoryNameBeforeFetch->fetch(PDO::FETCH_ASSOC);

$listObjectBeforeFetch = $db->query('SELECT * FROM item I WHERE I.numCategorie = '.$index.' and I.numUser = '.$_SESSION['ID'].' ');
if ($listObjectBeforeFetch != false){
    $listObject = $listObjectBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
}else {
    $listObject = [];
}
?>

<!DOCTYPE html>
<head>
    <script src="https://kit.fontawesome.com/87a0ec3c80.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/viewCategory.css">
</head>
<body>
    <div class="container-obj">
        <div class="search-obj">
            <div id="side-left">
                <h2 id="categoryName"><?php echo $categoryName['name'] ?></h2>
            </div>
            <div id="side-right">
                <input class="input" type="text" placeholder="Search.." id="searchBar" onkeyup="search()">
                <button class="btn" id="sort" type="button">Trier par ...</button>
                <a class="search btn" href="#">
                    <button class="btn" id="create-cat" type="button"><i class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
        <div id="object">
            <a <?php echo "href=?p=addObject&c=".$index ?> class="element-cat">
                <div>
                    <br>
                    <br>
                    <br>
                    <i class="fa fa-plus"> Ajouter un Objet</i>
                </div>
            </a>
            <?php
            for ($i=0; $i < count($listObject); $i++){
                miniTileObject($listObject[$i]);
            }
            ?>
        </div>
    </div>
</body>
<script src="js/searchbar.js"></script>
</html>