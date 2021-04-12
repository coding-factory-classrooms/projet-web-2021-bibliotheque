<?php
require_once "php/init.php";

verifLogin();
?>

<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="css/addCategorie.css">
<?php
$listCategoryBeforeFetch = $db->query('SELECT C.numCategorie, C.name FROM categorie C WHERE C.numUser = '.$_SESSION['ID'].' ');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
  <div id="container-archive">
      <div id="container-add">
          <div id="container-addCat">
            <form action= "php/management/addCategoryDB.php">
              <h1>Ajouter une catégorie</h1>
              <label class ="data" for="name"></label>
              <input class ="inputData" type="text" placeholder="Name" name="name" id="name" required>
              <?php 
              //If Error from the connexion.php, print the error 
              if (isset($_SESSION['error_message'])) {
              ?>
                <div class="error" ><?php echo $_SESSION['error_message']; ?></div>
              <?php
                unset($_SESSION['error_message']);
              }
              ?>
              <button class="inputAdd" type="submit" class="registerbtn">Ajouter</button>
              <!--<p><br><a href="?p=main"><- Return</a>.</p>-->
            </form>
          </div>
        
          <div id="container-addObject">
            <div id="addObject">
              <p id="p1">Pour ajouter un objet, cliquez sur ce bouton</p>
              <a href="?p=addObject"><button id="btn-addObject" type="button">Ajouter un objet</button></a>
            </div>
          </div>
        </div>

        <?php
        for ($i=count($listCategory)-1; $i>=0; $i--){
          //Printer of the Categories
          echo '<div id="container-dataExist">';
          echo '<div id="cat-data">';
          echo '<p>'.$listCategory[$i]['name'].'</p>';
          echo '<a href="?p=viewCategory&c='.$listCategory[$i]['numCategorie'].'" ><button class="btn-linkCat" type="button">Afficher plus ...</button></a>';
          echo '<button class="btn-Cat modify" type="submit">Modifier</button>';
          echo '<button class="btn-Cat delete" type="submit">Supprimer</button>';
          echo '</div>';
          echo '<div id="objects-data">';
          $listObjectBeforeFetch = $db->query('SELECT * FROM item I WHERE I.numCategorie = '.$listCategory[$i]['numCategorie'].' and I.numUser = '.$_SESSION['ID'].' ');
          if ($listObjectBeforeFetch != false){
            $listObject = $listObjectBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
          }else {
            $listObject = [];
          }
          //number of time the printer will loop with 6 loops maximum
          count($listObject)>6? $iteration=6: $iteration=count($listObject);

          for ($o=0; $o<$iteration; $o++){
            //Printer of the objects in one Category
            echo '<div class="single-object">';
            try {
              miniTileObject($listObject[$o]);
            }
            catch(Exception $e){ $a=1;}
            echo '</div>';
          }
          echo '<div>';
          echo '</div></div></div>';
        }
        ?>
      </div>
  </div>
</body>
</html>