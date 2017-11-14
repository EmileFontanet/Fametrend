<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Classement</title>
        <link rel="stylesheet" href="vue/vue_profileaddedstars.css"/>
        <link rel="stylesheet" href="vue/vue_classement.css"/>
    </head>
    
    <body>
        <div id = "menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
        </div>
        
        <div id ="menudroite">
                <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>
        </div>
        
        
        <div id="profile">
            
            <h3 id = "classementtitle">Classement</h3> 

            <!-- on affiche le top 10 dans un tableau-->
            <table id = "top10">
                
                <!-- on affiche les entetes -->
                <tr>
                    <th>Position</th>
                    <th>Pseudo</th>
                    <th>Nombre de points</th>
                </tr>
                
                
                
                <?php 
                $i = 1;

                foreach($userswithpointslist as $pseudo => $points){

                ?>


                <!-- on affiche les pseudo et les points des utilisateurs dans le classement et on rend leur pseudo cliquable pour accéder a leur profil -->
                <tr class ="pseudoinladder"> 

                    <td class = "positiondanstop10">
                        <?php echo $i ?>
                    </td>
                    
                    <td class="divpseudotop10">
                        
                        <a href="profile.php?id=<?php echo getIdFromPseudo($pseudo); ?>" class ="pseudodanstop10">
                            <?php echo $pseudo; ?>
                        </a>
                        
                    </td>
                    
                    <td>
                        <?php echo $points;  ?> 
                    </td>
                    
                </tr>
                <?php
                $i++;
                }

                ?>
            </table>
            <br/>
            
            <!-- on affiche un message indiquant la position de l'utilisateur dans le classement -->
            <p id="classementmessage">
            
                <?php echo $classementstatus ; ?>
            </p>
            
            <?php
            
            //si le classement personnalisé de l'utilisateur est defini, alors on crée un deuxième tableau dans lequel on met les utilisateurs et leur nombre de points correspondant
            if($arounduserlist){
                    $positioniterator = $userpositioninladder - 4;
                ?>
            
            <table id = "classementperso">
                <tr>
                    <th>Position</th>
                    <th>Pseudo</th>
                    <th>Nombre de points</th>
                </tr>
            <?php
                    foreach($arounduserlist as $pseudo => $points){
                    ?>
            
                <tr>
                    <td class="positionclassementperso">
                        <?php echo $positioniterator ;?>
                    </td>
                    <td class="divpseudoclassementperso">
                        <?php echo $pseudo; ?>
                    </td>  
                    <td>
                        <?php echo $points ; ?>
                    </td>
                </tr>
               
            
            <?php
               $positioniterator++;
                    } 
                ?></table><?php
            }
            ?>
        </div>
        
        
    </body>
    
</html>