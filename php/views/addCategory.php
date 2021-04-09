<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="css/addCategory.css">

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

        <div id="container-dataExist">
          <div id="cat-data">
            <p>["nom catégorie"]</p>
          </div>
          <div id="objects-data">
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div class="single-object">
              <p>["nom object"]</p>
            </div>
            <div>
              <a id="link-cat"href="#">Afficher plus ...</a>
            </div>
          </div>
      </div>
  </div>
</body>
</body>
</html>