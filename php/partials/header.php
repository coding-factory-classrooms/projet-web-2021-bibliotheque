<?php
function partials_header($page) {
?>
<!DOCTYPE html>
<head>
    <html lang="fr">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <title><?php echo ucfirst($page); ?></title>
</head>
<body>
    <header>
            <nav>
                <div class="block block1" id="logo">
                <img id="img_logo" src="asset/logo_larchive.png" alt="LARCHIVE">
                </div>
                <div class="block block2" id="cat">
                    <p id="list-link"><a class="link" href="#">Archive </a>&ensp; | &ensp;<a class="link" href="#"> Statistique</a>
                    </p>
                    
                </div>
                <div class="block block3" id="connexion">
                    <a href="#">
                    <button id="btn-connexion" type="button">Connexion</button>
                    </a>
                </div>
            </nav>
    </header>
</body>

</html>
<?php
}
?>