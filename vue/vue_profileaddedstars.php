<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profil</title>
        <link rel="stylesheet" href="vue/vue_profileaddedstars.css"/>
    </head>
    <body>
        <div id="profilezone">
            <div id = "menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
            </div>
            <div id ="profile">
                <h1>Personnalités ajoutées</h1>
                    <div id="mainaddedstar">
                    <?php 
                    foreach($stars as $star){
                    
                    ?>
                    <div class="startotaldiv">
                        <div class="starwithpointdiv"><?php

                            echo $star['nom'].'   '. $star['nb_points'];?>

                        </div>

                        <form class = "addedstarform" method="post" action="#">
                            <input type="submit" value ="X" />
                            <input type="hidden" name="startodeleteid" value="<?php echo $star['id']; ?>" />
                        </form>


                        <br/>
                    </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
            <div id ="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
            </div>
        </div>
    </body>
</html>