<?php
if(isset($status) and $status == 'connected'){
    //on recupère quelques infos comme le nbr total d'utilisateurs ainsi que des listes avec tous les utilisateurs et leur id et egalement le classement par points des utilisateurs avec leu id
    $totalnumberofusers = getnumberofusers();
    $totalnumberofusers = $totalnumberofusers[0];
    $userswithpointslist = getalluserswithpoints();
    $alluserswithid = getalluserswithid();
    //on crée la liste ou on associe son nombre de points a chaque utilisateur aka le classement
    foreach($userswithpointslist as $user => $points){
        $userswithpointslist[($alluserswithid[$user])] = $points;
        unset($userswithpointslist[$user]);
        }
    
    arsort($userswithpointslist);
    
    //puis on associe la position de l'utilisateur en fonction d'ou il se trouve dans la liste, et si il n'y est pas alors il a 0 points donc dernier
    if(array_key_exists(strtolower($_SESSION['pseudo']), $userswithpointslist)){
        $userpositioninladder = array_search(strtolower($_SESSION['pseudo']),    array_keys($userswithpointslist))+1;
        $classementstatus = "Vous êtes ". $userpositioninladder. "ème sur un total de ". $totalnumberofusers. ", ajoutez des personnalités pour continuer de monter!";
        if($userpositioninladder == 1){
            $classementstatus = "Vous êtes 1er, bravo! Vous avez plus de points que les ". ($totalnumberofusers - 1) . " autres utilisateurs !" ;
        }
    }
    else{
        $userpositioninladder = $totalnumberofusers;
        $classementstatus = "Vous n'avez pas encore de points, ajoutez des personnalités pour commencer a en gagner.";
    }
    
    //on regarde si l'utilisateur est dans les 5 premiers du classement, si c'est le cas on n'affiche rien d'autre dans le classement
    if($userpositioninladder <= 5){
        $arounduserlist = false;
    }
    //si l'utilisateur se trouve ailleurs que dans les 5 premiers, alors on affiche une partie du classement spécialement pour lui contenant les 4 personnes avant et après lui
    else if($userpositioninladder > 5 and $userpositioninladder != $totalnumberofusers){
        $arounduserlist = array();
        for($i = -5; $i <= 5; $i++){
            $position = sizeof($userswithpointslist) + $i; if(isset(array_keys($userswithpointslist)[$position])){
                $arounduserlist[array_keys($userswithpointslist)[$position]]  = $userswithpointslist[array_keys($userswithpointslist)[$position]];;
            }
        }
    }
    else if($userpositioninladder == $totalnumberofusers){
        $arounduserlist = array();
        for($i = -4; $i < 0; $i++){
           $position = sizeof($userswithpointslist) + $i; if(isset(array_keys($userswithpointslist)[$position])){
                $arounduserlist[array_keys($userswithpointslist)[$position]]  = $userswithpointslist[array_keys($userswithpointslist)[$position]];;
            }
        }
        $arounduserlist[$_SESSION['pseudo']] = 0;
    }
    
    
    
    include('C:\wamp64\www\site\vue\vue_classement.php');
}

else{
    header('Location: index.php');
}

?>