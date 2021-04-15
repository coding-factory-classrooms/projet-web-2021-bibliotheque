<?php
require_once "php/init.php";

verifLogin();
?>

<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="css/addCategorie.css">
<link rel="stylesheet" href="css/modal.css">
<?php
$listCategoryBeforeFetch = $db->query('SELECT * FROM categorie C WHERE C.numUser = '.$_SESSION['ID'].' Order By numCategorie DESC');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);

$messagesSlot = [];
for ($a=0; $a<count($listCategory);$a++){
  array_push($messagesSlot,unserialize(base64_decode($listCategory[$a]['advancement'])));
}
?>

<body>
  <div id="container-archive">

      <!--To add a category or an Object-->
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
        for ($i=0; $i<count($listCategory); $i++){
          //Print the Categories
          echo '<div id="container-dataExist">',
           '<div id="cat-data">',
           '<p>'.$listCategory[$i]['name'].'</p>',
           '<a href="?p=viewCategory&c='.$listCategory[$i]['numCategorie'].'" ><button class="btn-linkCat" type="button">Afficher plus ...</button></a>',
           '<button class="btn-Cat modify" type="submit" onClick="openModal('.$i.')">Modifier</button>';
          ?>
          <!--Modal-->
          <div class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="modal-close">&times;</span>
              <h2>Mofifier la Catégorie</h2>
              <form action="php/management/modifyCategory.php">
                <?php 
                $advancePlaceholder = "Nombre d'emplacement à remplir";
              
                echo 
                  '<div class="displayLabel-input">',
                    '<div class="label-input">',
                      '<label class="data name" for="nameModify">Name:</label>',
                      '<input class="inputData-modal" type="text" value="'.$listCategory[$i]['name'].'" placeholder="Nom" name="nameModify">',
                    '</div>',
                    '<input class="hidden" name="currentCategory" value="'.$listCategory[$i]["numCategorie"].'">',
                    '<div class="label-input">',
                      '<label class="data" for="modfyNumberAdvancement">Nombre d&apos;avancement:</label>',
                      '<input class="inputData-modal nbMessagesAdvancement" type="number" oninput="updateNbSpot('.$i.')"  value="'.count($messagesSlot[$i]).'" placeholder="'.$advancePlaceholder.'" name="advancement">',
                    '</div>',
                  '</div>',
                  '<p id="label-msgAvancement">Name Avancement:</p>',
                  '<div class="messagesAdvancement"></div>';
                ?>
                <br>
                <input type="submit" class="btn-modObject" value="Confirmer" name="submit" id="confirm">
              </form>
            </div>

          </div>

          <?php
          echo '<a href="?p=deleteCategory&c='.$listCategory[$i]['numCategorie'].'"><button class="btn-Cat delete" type="submit">Supprimer</button></a>';
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
  <script src="js/modal.js" defer></script>
  <script> 

  function openModal(id){ 
    let messageSlot = <?php echo json_encode($messagesSlot);?>;
    let spotDiv = modals[id].getElementsByClassName("messagesAdvancement")[0];

    modals[id].style.display = "block";
    updateNbSpot(id);
    //If there value, we fill the input in it.
    for (i=0;i< messageSlot[id].length; i++){
        input = spotDiv.getElementsByClassName("msg-adv")[i];
        input.value = messageSlot[id][i];
      }
  }
  </script>
</body>
</html>