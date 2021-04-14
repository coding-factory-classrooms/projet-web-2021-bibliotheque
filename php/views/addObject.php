<?php
//Get the index of the category in the url
if (isset($_GET['c'])) {
  if ($_GET['c'] != null) {
    $index = $_GET['c'];
  } else {
    $index = -1;
  }
} else {
  $index = -1;
}
//Get the index of the object to modify in the url
$currentObject = null;
if (isset($_GET['o'])) {
  if ($_GET['o'] != null) {
    $indexObj = $_GET['o'];  
    $currentObjectBeforeFetch = $db->query('SELECT * FROM item as O WHERE O.numUser = ' . $_SESSION['ID'] . ' AND O.numCategorie = '.$index.' AND O.numObject = '.$indexObj.'');
    $currentObject = $currentObjectBeforeFetch->fetch(PDO::FETCH_ASSOC);
  } else {
    $indexObj = -1;
  }
} else {
  $indexObj = -1;
}
//To compare the index in the DB
$listCategoryBeforeFetch = $db->query('SELECT C.numCategorie, C.name, C.advancement FROM categorie as C Where C.numUser = ' . $_SESSION['ID'] . ' Order By C.numCategorie');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="css/addObjectpage.css">

<body>

  <form action="php/management/addObjectDB.php">
    <div id="container" class="container">

      <a onclick="history.go(-1);"><button class="btnclose" type="button">X</button></a> 

      <h1>Ajout d'objet à une catégorie</h1>

      <label class="data" for="name"><b>Nom</b></label>
      <input class="inputData" type="text" placeholder="Nom" name="name" id="name" required>

      <label class="data" for="image"><b>Image</b></label>
      <input class="inputData" type="text" placeholder="Lien d'une Image (optionel)" name="image" id="image">

      <label class="data" for="description"><b>Description</b></label>
      <textarea class="inputData" rows="4" cols="50" name="description" placeholder="Description.." id="description"></textarea>

      <div id="categoryContainer">
        <label class="data" for="category"><b>Catégorie</b></label>
        <input class="inputData" list="list" type="text" placeholder="Categorie" name="category" id="category" required>
        <datalist id="list">
          <?php
          for ($i=0;$i<count($listCategory);$i++){
            echo "<option value=".$listCategory[$i]['name'].">";
          }
          ?>
        </datalist>
      </div>

      <label class="data" for="tags"><b>Tags</b></label>
      <input class="inputData" type="text" placeholder="Tags" name="tags" id="tags">
      
      <div class="hidden" id="advancementContainer">
        <label class="data" for="advancement"><b>Avancement</b></label>
        <input class="inputData" type="text" name="advancement" id="advancement">
      </div>
      <?php
      //If Error from the connexion.php, print the error 
      if (isset($_SESSION['error_message'])) {
      ?>
        <div class="error"><?php echo $_SESSION['error_message']; ?></div>
      <?php
        unset($_SESSION['error_message']);
      }
      ?>      

      <input class="hidden" name="currentObject" value="<?php echo ''.$currentObject["numCategorie"].','.$currentObject["numObject"].'' ?>" id="currentObject">

      <div id="btn-object">
        <div id="btn-reset">
          <a onclick="history.go(-1);"><button class="btn-annul hidden annim" type="button" id='undo'>Annuler</button></a>
        </div>
        <div id="btn-Action">
          <input type="submit" class="btn-deleteObject hidden annim" value="Supprimer" name="submit" id="suppr">
          <input type="submit" class="btn-modObject annim" value="Confirmer" name="submit" id="confirm">
        </div>
      </div>
    </div> 
  </form> 
</body> 
<script>
  <?php 
    if ($index != -1){
      $hasAdvancement = count(unserialize(base64_decode($listCategory[$index]['advancement']))) > 0;
          
      if ($hasAdvancement){
        echo "document.getElementById('advancementContainer').classList.remove('hidden')";
      }
    }
  ?>
if (<?php echo $index ?> != -1){
  
  document.getElementById("category").value = "<?php echo $listCategory[$index]['name'] ?>";

  if (<?php echo json_encode($currentObject)?> != null){
    document.getElementsByTagName("h1")[0].innerHTML = "Modifier l'objet";
    document.getElementById("confirm").value = "Modifier";

//if we click on an existant item, we have to fill all the cointainer with data
    document.getElementById("name").value = "<?php echo $currentObject['name'] ?>";
    document.getElementById("image").value = "<?php echo $currentObject['image'] ?>";
    document.getElementById("description").value = "<?php echo $currentObject['description'] ?>";
    document.getElementById("tags").value = "<?php echo $currentObject['tags'] ?>";
    document.getElementById("undo").classList.remove("hidden");
    document.getElementById("suppr").classList.remove("hidden");
    document.getElementById("categoryContainer").classList.add("hidden");

    if (<?php echo json_encode($hasAdvancement); ?>==true){
      document.getElementById("advancement").value = "<?php echo $currentObject['advancement'] ?>";
    }
  }

}
</script>

</html>