<!DOCTYPE html>

<?php require_once "php/init.php";?>

<body>

    <!-- menu -->
    <div class="container-fluid" id="body">
        <div class="row" id="body2">
        <!-- corps de la page -->
            <div id="soldes2" class="row">
                <?php
                    echo "yo";
                    $req = $db->query('SELECT U.username FROM user as U');
                    $resultDB = $req->fetchAll(PDO::FETCH_ASSOC);

                    var_dump($resultDB);
                ?>
            </div>
        </div>
    </div>
</body>
</html>