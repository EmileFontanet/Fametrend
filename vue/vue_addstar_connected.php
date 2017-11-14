<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
        <link rel="stylesheet" href="vue/vue_page.css" />
        <link rel="stylesheet" href="vue/addstar.css" />
    </head>
    <body>
        <div class="pagezone">
            <div id ="menugauche">
                <?php include('C:\wamp64\www\site\vue\vue_menugauche.php') ?>
            </div>
            <div id="page">
                <h1>Ajouter une célébrité</h1>
                <h2>Veuillez remplir les informations nécéssaires</h2>
                <form action="add.php" method ="post">
                    
                    
                    <label class ='labeladdstar' for="starname">Nom complet</label><input class = 'inputaddstar' type="text" id="starname" name="starname" maxlength="40" />
                    <br/>
                    
                    <label class ='labeladdstar' for="staroccupation">Occupation</label><input class = 'inputaddstar' type="text" id="staroccupation" name="staroccupation" maxlength ="40"/>
                    <br/>
                    
                    <label class ='labeladdstar' for="starpays">Pays</label>
                    <input class = 'inputaddstar' type="text" id="starpays" name="starpays" maxlength="40" />
                    <br/>
                    
                    <input type="submit" value="Valider" />
                    
                </form>
               
            </div>
            <div id="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
            </div>
        </div>
    </body>
</html>