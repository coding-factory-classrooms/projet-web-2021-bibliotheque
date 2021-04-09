<?php
function partials_header($page) {
?>
<!DOCTYPE html>
<head>
    <html lang="fr">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title><?php echo ucfirst($page); ?></title>
</head>
<body>
    <header>
        <nav>
            <div class="block block1" id="logo">
                <a href="?p=home">
                    <img id="img_logo" src="asset/logo_larchive.png" alt="LARCHIVE">
                </a>
            </div>
            <div class="block block2" id="cat">
                <p id="list-link"><a class="link" href="?p=addCategory">Archive </a>&ensp; | &ensp;<a class="link" href="#"> Statistique</a>
                </p>
                
            </div>
            <div class="block block3" id="connexion">
                <a href="?p=login">
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