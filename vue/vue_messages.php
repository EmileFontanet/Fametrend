<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Messages</title>
        <link rel="stylesheet" href="vue/vue_message.css"/>
    </head>
    
    <body>
        <div id = "menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
        </div>
        
        <div id ="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
        </div>
        
        
        <div id="messagemain">
            <form id="newmessage" method="post" action="controleur/controlmessage.php">
                
                <label>Message : </label><input type="text" name="message" /> 
                
                <label>Destinataire :</label><input type="text" name = "receiverpseudo" />          
                
                <input type="submit" name="send" value="Envoyer"/>
                
                <input type="hidden" name="senderid" value="<?php echo $_SESSION['id']; ?>" />
                
                
            </form>
            
            <!--On affiche ici les pseudos des dernieres personnes avec lesquelles on a discuté -->
            <div id = "messageinterface">
                <div id="pseudolist">
                <?php  
                foreach($lastpseudos as $pseudo){
                    ?>
                    <div class="pseudobox">
                       <a href="<?php echo $_SERVER['PHP_SELF']. "?id=". getidfrompseudo($pseudo); ?>" class="pseudolinkfrompseudobox">
                           <?php echo $pseudo; ?> (<?php echo getnumberofunreadmessagesbetweenusers($_SESSION['id'], getidfrompseudo($pseudo)); ?>)
                        </a>
                    </div>
                <?php
                    }


                ?>
                </div>

                <!-- on regarde si il y a des messages a afficher et si c'est le cas on les affiche -->
                <div id="messagestodisplayzone">
                    <?php include("vue/vue_messagesdisplay.php"); ?>
                </div>
            </div>
        </div>
    </body>
    
</html>