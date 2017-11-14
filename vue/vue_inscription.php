<?php ?>
<!DOCTYPE html>
<?php if(isset($inscriptionreussie) and $inscriptionreussie){ ?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
        <link rel="stylesheet" href="vue/vue_page.css" />
        <link rel="stylesheet" href="vue/inscription.css" />
    </head>
    <body>
        <div class="pagezone">
            <div id ="menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
            </div>
            <div id="page">
                <h1>Inscription réussie</h1>
                
            </div>
            <div id="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
            </div>
        </div>
    </body>
</html>

<?php }  
else{ ?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
        <link rel="stylesheet" href="vue/vue_page.css" />
        <link rel="stylesheet" href="vue/inscription.css" />
    </head>
    <body>
        <div class="pagezone">
            <div id ="menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
            </div>
            <div id="page">
                <h1>Créer un compte</h1>
                <form action="inscription.php" method ="post">
                    
                    <label class="labelinscri">Pseudo</label>
                    <input class = 'inputinscri' type="text" name="pseudo" maxlength="20" />
                    <p class ='errmsginscri'><?php echo htmlspecialchars($errinscription['errpseudo']); ?></p>
                    <br/>
                    
                    <label class="labelinscri">Email</label>
                    <input class = 'inputinscri' type="email" name="email" />
                    <p class ='errmsginscri'><?php echo htmlspecialchars($errinscription['erremail']); ?></p>
                    <br/>
                    
                    <label class="labelinscri">Mot de passe</label>
                    <input class = 'inputinscri' type="password" name="password" />
                    <p class ='errmsginscri'><?php echo htmlspecialchars($errinscription['errmdp']); ?></p>
                    <br/>
                    
                    <label class="labelinscri">Vérifier votre mot de passe</label><input class = 'inputinscri' type="password" name="passwordverif" />
                    <br/>
                    
                    <input type="submit" value="Inscription" id ="inscriptionbutton" />
                    <input type = 'hidden' value ='true' name = 'notfirsttime' id = 'notfirsttime' />                          
                </form>
            </div>
            <div id="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
            </div>
        </div>
    </body>
</html>

<?php } ?>
