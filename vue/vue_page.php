

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="vue/vue_page.css" />
    </head>
    <body>
        <div class="pagezone">
            <!--On inclut le menu de gauche -->
            <div id ="menugauche">
                <?php include('C:\wamp64\www\site\controleur/menugauche.php') ?>
            </div>
            <div id="page">
                <h2 id ='ladderwelcomemessage'><?php echo $infomessage; ?></h2>
                <?php echo $errvote; ?> 
                <!--On affiche le top des personnalités -->
                <?php 
                $compteur = 0;
                foreach($stars as $star){
                    //On definit des repères pour donner des noms aux divisions en fonction de leur position dans le classement et on assigne les hauteurs et largeurs adéquates aux canvas
                $width = 1150*$coeff[$compteur];
                if($compteur == 0){
                    $id = 'canva1';
                    $height = 70;
                    $place = 'first';
                    $medal = 'goldmedal';
                    
                }
                elseif($compteur ==1){
                    $id = 'canva2';
                    $height = 60;
                    $place = 'second';
                    $medal = 'silvermedal';
                }
                elseif($compteur ==2){
                    $height = 50;
                    $id = 'canva3';
                    $place = 'third';
                    $medal = 'bronzemedal';
                }
                elseif($compteur ==3){
                    $height = 40;
                    $id = 'canva4';
                    $place = 'nottop3';
                }
                else{
                    $id = 'canva5ouplus';
                    $place = 'nottop3';
                    $height = 30;
                }
                ?>
                <div class ="displayedstar"><!-- infos affichés par rapport aux personnalités affichées -->
                    <h3 class ="<?php echo $place; ?>"><?php echo($compteur +1+ $limit_valid*($page-1)). ' '. $star['nom'] ;?></h3>
                    
                    <?php if($compteur<=2 and $page ==1){ ?>
                    <img src=images/<?php echo $medal; ?>.png />
                    <?php } ?>
                    <h4>Pays: <?php echo $star['pays']; ?>, occupation: <?php echo $star['occupation']; ?></h4>
                    <p>Nombre de votes: <?php echo $star['nb_points']; ?></p>
                    <canvas  width="<?php echo $width ?>" height="<?php echo $height; ?>" class='<?php echo $id; ?>'>
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    
                    <?php if(isset($status) and $status =='connected'){ ?>
                    <form method="post" action="controleur/addvote.php"><!--Bouton pour voter -->
                        <button type="submit" value ="<?php echo $star['id']; ?>" name="votebutton">Vote</button>
                        <input type ="hidden" value="<?php echo $url ; ?>" name="url" />
                    </form>
                    <?php } ?>
                    
                </div>

                
                    
                    <?php 
                $compteur++;  
                }  ?>
                
                <!-- Liens pour naviguer entre les pages du classement -->
                <div id="pageslink">
                    
                    <?php if($page>5){   ?>
                    <a href="<?php echo $_SERVER['PHP_SELF'].$url; ?>page=<?php echo $page-5; ?>"> &lt&lt </a>
                    <?php } ?>
                    
                    
                    <?php if($page>1){?>
                    <a href="<?php echo $_SERVER['PHP_SELF'].$url;?>page=<?php echo $page-1; ?>"> &lt </a>
                    <?php } ?>
                    
                    <?php 
                    
                    echo 'Page ' .$page; ?>
                   <?php if(!$lastpage){ ?>
                        <a href="<?php echo $_SERVER['PHP_SELF'].$url; ?>page=<?php echo $page+1; ?>"> &gt </a>

                        <a href="<?php echo $_SERVER['PHP_SELF'].$url; ?>page=<?php echo $page+5; ?>"> &gt&gt  </a>
                   <?php } ?>
            </div>
          <div id="menudroite"> <!--Menu de droite avec l'interface de connexion -->
              <?php include('C:\wamp64\www\site\vue\vue_menudroite.php'); ?>              
            </div> 
        </div>
        
        </div>
    </body>
</html>