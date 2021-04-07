<!doctype html>
<html lang="fr">

<body>

<form action= "php/management/addObjectDB.php">
  <div id="container" class="container">
    <h1>Add a product to sell</h1>
    <hr>

    <label class ="data" for="name"></label>
    <input class ="inputData" type="text" placeholder="Name" name="name" id="name" required>
    <hr>

    <label class ="data" for="image"></label>
    <input class ="inputData" type="text" placeholder="Image link (optional)" name="image" id="image">
    <hr>

    <label class ="data" for="description"></label>
    <input class ="inputData" type="text" placeholder="Description" name="description" id="description">
    <hr>

    <label class ="data" for="tags"><b>Tags</b></label>
    <input class ="inputData" type="text" name="tags" id="tags">
    <hr>

    <label class ="data" for="advancement"><b>Advancement</b></label>
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
    
    <p><br><a href="?p=main"><- Return</a>.</p>
  </div>
</form>

</body>
</html>