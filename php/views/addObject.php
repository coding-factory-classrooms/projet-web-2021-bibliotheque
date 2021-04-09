<?php 
//Get the index of the category in the url
if (isset($_GET['c'])) {
  if ($_GET['c'] != null){
    $index = $_GET['c'];
  }else {
    $index = -1; 
  }
}else {
  $index = -1; 
}
//To compare the index in the DB
$listCategoryBeforeFetch = $db->query('SELECT C.numCategorie, C.name FROM categorie as C Where C.numUser = '.$_SESSION['ID'].'');
$listCategory = $listCategoryBeforeFetch->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">

<body>

<form action= "php/management/addObjectDB.php">
  <div id="container" class="container">
    <h1>Add a product to sell</h1>
    <hr>

    <label class ="data" for="name"></label>
    <input class ="inputData" type="text" placeholder="Nom" name="name" id="name" required>
    <hr>

    <label class ="data" for="image"></label>
    <input class ="inputData" type="text" placeholder="Lien d'une Image (optionel)" name="image" id="image">
    <hr>

    <label class ="data" for="description"></label>
    <input class ="inputData" type="text" placeholder="Description" name="description" id="description">
    <hr>

    <label class ="data" for="category"></label>
    <input class ="inputData" type="text" placeholder="Categorie" name="category" id="category" required>
    <hr>

    <label class ="data" for="tags"><b>Tags</b></label>
    <input class ="inputData" type="text" name="tags" id="tags">
    <hr>

    <label class ="data" for="advancement"><b>Avancement</b></label>
    <input class ="inputData" type="text" name="advancement" id="advancement">
    <hr>

    <?php 
    //If Error from the connexion.php, print the error 
    if (isset($_SESSION['error_message'])) {
    ?>
      <div class="error" ><?php echo $_SESSION['error_message']; ?></div>
    <?php
      unset($_SESSION['error_message']);
    }
    ?>
    
    <input type="submit" class="registerbtn" value = "Inscription">
    
    <p><br><a onclick="history.go(-1);"><- Return</a></p>
  </div>
</form>

</body>
<script>
  if (<?php echo $index ?> != -1){
    document.getElementById("category").value = "<?php echo $listCategory[$index]['name'] ?>";
  }
</script>

</html>