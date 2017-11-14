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

                        <!-- On affiche les options de mofication seulement si on a cliqué sur modifier les infos -->
                        
                        <?php
                        if($modify == 'true'){ ?>
                        
                            <input type="text" placeholder="Nouveau pseudo" name="newpseudo" />

                            <input type="submit" name="pseudo" value = "Changer de pseudo"/>

                            <p id ="errchangepseudo"><?php echo $_SESSION['errchangepseudo']; ?></p>

                            <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ; ?>" />
                        <br/>
                        
                        <?php
                        }
                        ?>
                    </form>
                
               </div> 
                
               <form id="formstatus" action="controleur/controlprofile.php" method="post">
                    
                    <label>Status</label><br/>
                   
                   <?php 
                   if($modify == true){ ?>
                       <input type="hidden" name="id" value="<?php echo $user_obj->description() ; ?>" /> <?php
                   }
                   ?>
                </form>
                
                
                <form id="formdescription" action="controleur/controlprofile.php" method="post">
                    <label id ="descriptiontext">
                        
                        <?php 
                        
                         if($modify == 'true'){ ?>
                        
                        <input type="text" name="newdescription" placeholder="Entrez votre description" id="changedescription" maxlength="280"> <br/>
                        <input type="submit" value="Confirmer">
                           <input type="hidden" name="id" value="<?php echo $user_obj->id() ; ?>" /> 
                        
                        <?php
                        }
                   
                        else{
                        
                        if($user_obj->description() != ""){
                            echo $user_obj->description() ;
                        }
                        else{
                            echo "Ajoutez quelque chose à propos de vous!";
                        }
                        }
                        ?>
                    </label>
                    
                </form>
                
                
            </div>
            
            <!-- centre de la page avec le formulaire contenant les informations générales -->
            <div id="centerpresentation">
                
                <form id ="formgeneralinfo" method="post" action="controleur/controlprofile.php">
                    <label>Prénom : <?php echo $user_obj->prenom(); ?></label>
                    
                    <?php if($modify == 'true'){
                    ?>
                    
                        <input type="text" size="10" name="prenom"/>
    
                    <?php
                    }
                    ?>
                
                    <br/>
                
                
                    <label>Nom : <?php echo $user_obj->nom(); ?></label>
                    
                    <?php if($modify == 'true'){
                    ?>
                    
                        <input type="text" size="10" name="nom"/>
    
                    <?php
                    }
                    ?>
                
                    <br/>
                
                
                    <label>Date de naissance : <?php echo $user_obj->date_naissance(); ?></label>
                    
                    <?php if($modify == 'true'){
                    ?>
                    
                        <input type="date" name="date_naissance" placeholder = "DD/MM/YY" maxlength = "8" size = "8"/>
    
                    <?php
                    }
                    ?>
                    <br/>
                
                
                    <label>Sexe : <?php echo $user_obj->sexe(); ?></label>
                    
                    <?php if($modify == 'true'){
                    ?>
                    
                        <label for ="homme">Homme: </label><input type="radio"  id = "homme"name="sexe" value = "M"/>
                        <label for = "femme">Femme: </label><input type="radio" id ="femme" name = "sexe" value = "F"/>
    
                    <?php
                    }
                    
                    ?>
                    <br/>
               
                
                

                

                    <label>Email : </label><?php echo $user_obj->email(); ?>
                    
                    <?php
                        if($modify == 'true'){ ?>

                        <input type="text" placeholder="Nouvel email" name="newmail"/>


                        <input type="submit" name="email" value = "Modifier"/>
                        <p id="errchangemail"><?php echo $_SESSION["errchangemail"]; ?></p>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ; ?>" />
                    
                    <?php
                    }
                    ?>
                    <br/>

                </form>
                
                <?php
                if($modify == "true"){
                ?>
                
                   <form id="formpassword" method="post" action="controleur/controlprofile.php"> 

                        <label>Changer de mot de passe : </label>
                        <label>Ancien mot de passe:</label><input type="password" name="oldpassword"><br/>
                        <label>Nouveau mot de passe</label><input type="password" name="newpassword1"/><br/>
                        <labe>Nouveau mot de passe</labe><input type="password" name="newpassword2"/>

                       <input type="submit" name="password" value = "Changer de mot de passe"/>

                       <p id ="errchangepassword"><?php echo $_SESSION['errchangepassword']; ?></p>

                       <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ; ?>" />
                        <br/>                

                    </form>
                    
                <?php
                }
                
                if($modify != 'true'){
                ?>    
                 <a href="profile.php?modify=true">Modifier vos informations</a>
                <?php
                }
                ?>
             </div>   
                
            
            <div id="rightpresentation">
            
                <p id="dateinscription">Inscrit le : <?php echo $user_obj->date_inscription(); ?></p>
                
            </div>
        </div>
    </body>
    
</html>