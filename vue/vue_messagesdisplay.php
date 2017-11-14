<?php
            if(isset($lastmessages)){
                ?>            
            <div id ="lastmessages">
                <!-- on fait une boucle sur tous les messages a afficher et on les affiche avec le pseudo de la personne qui envoie le message -->
                <?php for($i = (sizeof($lastmessages)-1); $i>=0; $i--){
                ?>
                
                <!-- on regarde si c'est l'utilisateur qui a envoyé un message en dernier ou si c'est la personne avec laquelle il parle -->
                <div class="message<?php  
                        if($lastmessages[$i]['sent_by'] == $_SESSION['id']){
                            echo 'self';
                        }
                        else{
                            echo 'other';
                        }
                            ?>">
                    <p class="chatpseudo">
                        <?php

                         echo getpseudofromid($lastmessages[$i]['sent_by'])?>  : </p>

                    <p  class = "chatmessage"> 

                        <?php echo $lastmessages[$i]['content']; ?>

                    </p>
                </div>
                <?php
                    }
                ?>
                
            </div>
            
            <?php if($friendshipvalidity){ ?>

            <form id ="sendmessage" method="post" action ="controleur/controlmessage.php">
                <input type="text" name="chatmessage" id = "chatmessageinput" autofocus placeholder = "Votre message" size ="40"/>
                <input type="submit" value ="Envoyer"/>
                <input type ="hidden" name="senderidchat" value = "<?php echo $_SESSION['id']; ?>" />
                <input type="hidden" name="receiveridchat" value="<?php echo $friendsid; ?>" />
            </form>
            <?php
                }
            }
?>