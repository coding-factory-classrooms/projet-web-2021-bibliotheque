<?php
function partials_header($page) {
    if ($_SESSION==null){
        $btnMessage = 'Connexion';
        $btnDirrection = '?p=login';
        $btnId = "btn-connexion";
    }else{
        $btnMessage = 'Deconnexion';
        $btnDirrection = '?delete=logOut';
        $btnId = "btn-deconnexion";
    }
?>
<!DOCTYPE html>
<head>
    <html lang="fr">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/main.css">
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
                <p id="list-link"><a class="link" href="?p=archive">Archive </a>&ensp; | &ensp;<a class="link" href="#"> Statistique</a>
                </p>
                
            </div>
            <div class="block block3" id="connexion">
                <a href="<?php echo $btnDirrection ?>">
                    <button id="<?php echo "".$btnId.""; ?>" type="button"><?php echo "".$btnMessage.""; ?></button>
                </a>
            </div>
        </nav>
    </header>
</body>

</html>
<?php
}
?>