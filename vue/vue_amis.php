<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profil</title>
        <link rel="stylesheet" href="vue/vue_amis.css"/>
    </head>
    <body>
        <div id="page">
            <div id = "menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
            </div>
            <div id ="friendmain">
               
                    
                    <div id = "addfriend">
                        <form method="post" action = "controleur/controladdfriend.php">
                            <input type="search" class="friendtoadd" size="40" name="friendtoadd" placeholder ="Ajouter un ami"/>
                            
                            <input type="submit" value = "+" id ="addfriendbutton" />
                            
                            <p><?php echo $_SESSION["erraddfriend"] ; ?></p>
                        </form>

                        <br/>
                    </div>
                    <div id="friendslists">
                        <div id="friendzone">
                            <h3 id="listedamis">Liste d'amis</h3>
                
                            <?php 
                            for($i = 0; $i < sizeof($pseudolist); $i++){
                            
                            ?><div class="friendnameandaction">
                            

            <a class="friendname" href="profile.php?id=<?php echo $friends[$i]; ?>"><?php echo $pseudolist[$i]; ?>
                                 </a>

                                <form class="deletefriendzone" method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">


                                    <button type ="submit" name ="deletefriend" class ="deletefriendbutton"value ="true" >X</button>

                                    <input type="hidden" value="<?php echo $friends[$i]; ?>" name="friendid" />


                                </form>


                            </div>
                             <?php
                            }

                            ?>
                            <br/>
                        </div>

                    <div id="charlatannerie"></div>
                    <div id="amisrequests">
                        <h3 id="demandesenattentede">Demandes en attente de</h3>

                        <?php for($i = 0; $i < sizeof($requestslistpseudos); $i++){
    
                        ?>
                        <div class="acceptordenypseudoandaction">
                        <a class="acceptordenypseudo" href="profile.php?id=<?php echo $requestslistids[$i]; ?>">
                        <?php
                                echo $requestslistpseudos[$i];
                            ?> 
                        </a>
                            <form class ="acceptordenyzone" method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="acceptordenyfriendshipbuttons">
                                
                                <button class ="acceptbutton" type ="submit" name ="acceptordeny" value ="accept" >V</button>  


                                <button class ="denybutton" type ="submit" name ="acceptordeny" value ="deny" >X</button>
                                
                            </div>
                            <input type="hidden" value="<?php echo $requestslistids[$i]; ?>" name="seekerid" />

                            </form>
                        
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>    
            </div>
            <div id ="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
            </div>
        </div>
    </body>
    <?php $_SESSION["erraddfriend"] = "";?>
</html>