<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Webmile</title>
        <link rel="stylesheet" href ="vue/banniere.css" />
    </head>
    <header id="banniere">
        <a href="index.php" id="accueillink">Accueil</a>
        <div id="searchzone">
            <form method="post" action="index.php">
                <label></label><input type="search" name="search" placeholder="Le nom de la personne que vous recherchez" size = 40; id ="searchfield"/>
                <input type="submit" value = "" alt = "Rechercher quelqu'un"id="searchbutton" />
            </form>
            
        </div>
        <div id="logo">
            <p>Logo du site</p>
        </div>
    </header>
    
</html>