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
//To compare the index in the DB
$listCategoryBeforeFetch = $db->query('SELECT C.numCategorie, C.name FROM categorie as C Where C.numUser = ' . $_SESSION['ID'] . '');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="css/addObject.css">

<body>

  <form action="php/management/addObjectDB.php">
    <div id="container" class="container">
      <h1>Ajout d'objet à une catégorie</h1>


      <label class="data" for="name"><b>Nom</b></label>
      <input class="inputData" type="text" placeholder="Nom" name="name" id="name" required>


      <label class="data" for="image"><b>Image</b></label>
      <input class="inputData" type="text" placeholder="Lien d'une Image (optionel)" name="image" id="image">


      <label class="data" for="description"><b>Description</b></label>
      <textarea class="inputData" rows="4" cols="50" name="description" placeholder="Description.."></textarea>


      <label class="data" for="category"><b>Catégorie</b></label>
      <input class="inputData" list="list" type="text" placeholder="Categorie" name="category" id="category" required>
      <datalist id="list">
        <option value="Film">
        <option value="Série">
        <option value="Musique">
        <option value="Ma Categorie">
      </datalist>


      <label class="data" for="tags"><b>Tags</b></label>
      <input class="inputData" type="text" placeholder="Tags" name="tags" id="tags">



      <label class="data" for="advancement"><b>Avancement</b></label>
      <input class="inputData" type="text" name="advancement" id="advancement">

      <?php
      //If Error from the connexion.php, print the error 
      if (isset($_SESSION['error_message'])) {
      ?>
        <div class="error"><?php echo $_SESSION['error_message']; ?></div>
      <?php
        unset($_SESSION['error_message']);
      }
      ?>
      <input type="submit" class="registerbtn" value="Confirmer">

      <p><a onclick="history.go(-1);">
          <- Return</a> </p> </div> </form> </body> <script>
            if (<?php echo $index ?> != -1){
            document.getElementById("category").value = "<?php echo $listCategory[$index]['name'] ?>";
            }
            </script>

</html>