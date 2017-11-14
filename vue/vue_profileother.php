<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profil</title>
        <link rel="stylesheet" href="vue/vue_profileself.css"/>
    </head>
    
    <body>
        <div id = "menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
        </div>
        
        <div id ="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
        </div>
        
        <!-- On définit les différents formulaires pour changer ses informations personnelles ou les consulter et on affiche les messages d'erreur si il y en a -->
        <div id="profileselfmain">
            
            <div id = "leftpresentation">
                
                <div id="pictureandpseudopart">
                    <h3>Profil</h3>
                    <div id = "profilepicturediv">
                        <img id ="profilepicture" src="images/randomprofilepic.png" alt="Photo de profil"  />
                    </div>

                    <form id="formpseudo" method="post" action="controleur/controlprofile.php">

                        <h4 id ="profiledisplayedpseudo"><?php echo $infosuser['pseudo']; ?></h4>

                    </form>
                
               </div> 
                <form id="formstatus" action="controleur/controlprofile.php" method="post">
                    
                    <label>Status</label><br/>
                </form>
                
                <form id="formdescription" action="controleur/controlprofile.php" method="post">
                    <label id ="descriptiontext">Ajoutez quelque chose à propos de vous!</label>
                </form>
                
            </div>
            
            <div id="centerpresentation">
                
                <form id ="formprenom" method="post" action="controleur/controlprofile.php">
                    <label>Prénom</label>
                </form>
                
                
                <form id ="formnom" method="post" action="controleur/controlprofile.php">
                    <label>Nom</label>
                </form>
                
                
                <form id ="formage" method="post" action="controleur/controlprofile.php">
                    <label>Age</label>
                </form>
                
                <form id ="formsexe" method="post" action="controleur/controlprofile.php">
                    <label>Sexe</label>
                </form>
                
                

                <form id="formemail" method="post" action="controleur/controlprofile.php">

                    <label>Email : </label><?php echo $infosuser['email']; ?>
                    
                    
                    <br/>

                </form>
                
                
             </div>   
                
            
            <div id="rightpresentation">
            
                <p id="dateinscription">Inscrit le : <?php echo $infosuser['date_inscription']; ?></p>
                
            </div>
        </div>
        
    </body>
    
</html>