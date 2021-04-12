<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    </head>

<body>
    
    <div class="login">
        <h1>Connexion</h1>
        <form action="php/management/verif.php">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Identifiant" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Mot de passe" id="password" required>

            <?php
            //If Error from the connexion.php, print the error
            if (isset($_SESSION['error_message'])) {
            ?>
                <div class="error"><?php echo $_SESSION['error_message']; ?></div>
            <?php
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="submit" value="Connexion">
        </form>
    </div>

    <div id="image">
        <img src="asset/logo_larchive.png" alt="larchive" width="35%">
    </div>
    
</body>

</html>