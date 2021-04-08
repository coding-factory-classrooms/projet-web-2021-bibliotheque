<?php
function viewCategory($index) {
    //The index of the current category
    
    $categoryNameBeforeFetch = $db->query('SELECT C.name FROM categorie C WHERE C.numCategorie = '.$index.' and C.numUser = '.$_SESSION['ID'].' ')
    $categoryName = $categoryNameBeforeFetch-fetch(PDO::FETCH_ASSOC);

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
</head>
<body>
    <div class="container-obj">
        <div class="search-obj">
            <div id="side-left">
                <h2 id="categoryName">["nom catégorie"]</h2>
            </div>
            <div id="side-right">
                <input class="input" type="text" placeholder="Search..">
                <button class="btn" id="sort" type="button">Trier par ...</button>
                <a class="search btn" href="#">
                    <button class="btn" id="create-cat" type="button"><i class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
        <div class="object">
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
            <div id="element-cat">
                ["element"]
            </div>
        </div>
    </div>
</body>
</html>

<?php
}
?>