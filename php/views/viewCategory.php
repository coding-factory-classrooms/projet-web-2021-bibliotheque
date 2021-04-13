<?php
require_once "php/init.php";
//Get the index of the category in the url

verifLogin();

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
    <link rel="stylesheet" href="css/viewCategorie.css">
</head>
<body>
    <div class="container-obj">
        <div class="search-obj">
            <div id="side-left">
                <a onclick="history.go(-1);">
                    <button class="clos" id="btnn" type="button"><- Retour</button>
                </a> 
                <h2 id="categoryName"><?php echo $categoryName['name'] ?></h2>
            </div>
            <div id="side-right">
                <input class="input" type="text" placeholder="Search.." id="searchBar" onkeyup="search()">
                <button class="btn" id="sort" type="button">Trier par ...</button>
                <a class="search btn">
                    <button class="btn" id="create-cat" type="button" onClick="changePrinter()"><i id="orderBy" class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
        <div id="object">
            <div class="element-cat">
                <a class="linkCreateObject" <?php echo "href=?p=addObject&c=".$index ?>>
                    <i class="fa fa-plus"> Ajouter un Objet</i>
                </a>
            </div>
            <?php
            for ($i=0; $i < count($listObject); $i++){
                miniTileObject($listObject[$i]);
            }
            ?>
        </div>
    </div>
</body>
<script>
function changePrinter(){
//
    orderBy_class = document.getElementById("orderBy").classList;
    orderBy_class.toggle("fas");
    orderBy_class.toggle("fa");
    orderBy_class.toggle("fa-grip-lines");
    orderBy_class.toggle("fa-plus");
    orderChanger();
}

function orderChanger(){
    orderBy = document.getElementById("orderBy");
    objectContainer = document.getElementById("object");
    objects = Array.from(objectContainer.getElementsByTagName("div"));

    console.log(objects);

    if (orderBy.classList[1] == "fa-plus"){
        objects.forEach(object => {
            object.classList.add("element-cat");
            object.classList.remove("element-displayRow");
        })
    }else{
        objects.forEach(object => {
            object.classList.add("element-displayRow");
            object.classList.remove("element-cat");
        })
    }
}
</script>
<script src="js/searchbar.js"></script>
</html>