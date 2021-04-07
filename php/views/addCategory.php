<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>inscription</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

<form action= "php/management/addCategoryDB.php">
  <div id="container" class="container">
    <h1>Add a product to sell</h1>
    <hr>

    <label class ="data" for="name"></label>
    <input class ="inputData" type="text" placeholder="Name" name="name" id="name" required>
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