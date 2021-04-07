<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css%22%3E">
    </head>

<body>
    <form action="php/management/verif.php">
        <div class="login">
            <h1>Connexion</h1>
                <label for="username">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="username" placeholder="Prénom" id="username" required>
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
        </div>

        <div class="image">
            <img src="asset/logo_larchive.png" alt="larchive" height="460px" width="460px">
        </div>
    </form>
</body>

</html>