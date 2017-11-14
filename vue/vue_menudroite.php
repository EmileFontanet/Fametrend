<head>
    <link rel="stylesheet" href ="vue/menudroite.css" />
</head>
<div id ="interfaceconnexion"> 
    <?php if(isset($status) and $status == 'connected'){ //si l'utilisateur est connecté
                ?>
                <h3 id='messagebienvenue'>Bienvenue, 
                    <a href = "profile.php?id=<?php echo $_SESSION['id']; ?>">
                        <?php echo $_SESSION['pseudo']; ?>
                    </a>
                </h3>
    
                <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">Voir son profil</a><br/>
    
                <a href="profileaddedstars.php">Personnalités ajoutées</a><br/>
    
                <a href="amis.php">Amis (<?php echo $_SESSION['numberofrequests'][0][0];?>)</a><br/>
    
                <a href="classement.php">Classement</a><br/>
    
                <a href="messages.php">Messages (<?php echo $_SESSION['numberofmessages'] ; ?>)</a>
    
                <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method ="post">
                    <input type="submit" value="Déconnexion" name="deconnexion" id="deconnexionbutton"/>
                </form>
    
    
            <?php }
            else{ ?><!-- Si l'utilisateur est déconnecté-->
              <!--interface de connexion -->
                <div id ="menudroitedeco">
                <form method="post" action = "controleur/controlconnexion.php" id="formconnex">
                    
                    <label>Pseudo</label><input type="text" name="pseudo" maxlength="20" class="textzoneconnex" /><br/>
                    
                    <label>Mot de passe</label><input type="password" name="password" maxlength="40" class="textzoneconnex"/>
                    
                    <input type="submit" value="Connexion" /><br/>
                    
                    <div>
                        <label for="maintenirconnexion">Rester connecté</label><input type="checkbox"  checked = "checked" name="maintenirconnexion" id ="maintenirconnexion"/>
                        
                    </div><br/>
                </form>
                    <a href="inscription.php" id="lieninscription" class = "menudroitelink">Pas de compte? Inscrivez vous!</a> <br/>
    
                    
               </div>
            <?php } ?>
    
</div>