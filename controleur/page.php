<?php 

include_once('C:\wamp64\www\site\modele\starsmanip.php');

//création de la variable url pour garder les paramètres transférés via l'url lorsquon change de page

$url = '?';//on assigne de valeurs par defaut a certaines variables
$lastpage = false;
//On crée le message de base
$infomessage = 'Classement global';
//On regarde si on a une limite donnée par l'url
if(isset($_GET['limit'])){
    $limit = htmlspecialchars($_GET['limit']);
    if($_GET['limit'] ==intval($_GET['limit'])){
        $limit_valid = intval($_GET['limit']);
        $url = $url . 'limit=' . $limit_valid . '&';
    }//et on en met une par defaut sinon
    else{
        $limit_valid = 5;
    }
}
else{//sinon valeur par défaut
    $limit_valid = 5;
}

//on regarde si on se trouve à une page spécifiée
if(isset($_GET['page'])){
    if(intval($_GET['page']) == $_GET['page']){//si la page est un chiffre on set la variable offset
        $offset = (intval($_GET['page'])-1)*$limit_valid ;
        $page = htmlspecialchars(intval($_GET['page']));
        $url = $url . 'page=' .  $page . '&';
    }
    else{
        $offset = 0;
        $page = 1;
    }
}
else{
    $offset = 0;
    $page = 1;
}
    
    
//On regarde si une recherche a été faite
if(isset($_POST['search'])){
    $search = htmlspecialchars($_POST['search']);
    $stars = getstarsbyname($search, $offset, $limit_valid);
    if($search == ''){
        $infomessage = 'Veuillez entrer un nom dans le champ de recherche.';
    }
    else{//on set le message d'accueil
        $infomessage = "Résultats pour \"".$search."\" ";
        $url = $url .'search='. $search . '&';
    }
}


//On regarde si les variables filter et leur values sont définies
elseif(isset($_GET['filter']) and isset($_GET['value'])){
    $filter = htmlspecialchars($_GET['filter']);
    $value = htmlspecialchars($_GET['value']);
    //puis on détermine si on classe par pays ou par occupation
    if($filter == 'country'){
        $stars = getstarsbypays($value, $offset, $limit_valid);
        $infomessage = 'Classement par pays : '.$value;
        $url = $url . 'filter='. $filter . '&value=' . $value . '&';
    }
    elseif($filter =='occupation'){
        $stars = getstarsbyoccupation($value, $offset, $limit_valid);
        $infomessage = 'Classement par occupation : '.$value;
        $url = $url . 'filter=' . $filter . '&value=' . $value . '&';
        
    }
    else{
    $stars = getstars($offset ,$limit_valid);
    }
}
else{//Sinon on prend les 5 premières célébrités globales
    $stars = getstars($offset ,$limit_valid);
}
//et on verifie si on est a la dernière page ou pas
if(count($stars) < $limit_valid){
        $lastpage = true;
    }
//on assigne les éléments et effectue les specialchars
foreach($stars as $cle => $star){//puis on récup les infos
    $stars[$cle]['nom'] = htmlspecialchars($star['nom']);
    $stars[$cle]['occupation'] = htmlspecialchars($star['occupation']);
    $stars[$cle]['pays'] = htmlspecialchars($star['pays']);
    $stars[$cle]['nb_points'] = htmlspecialchars($star['nb_points']);
    
}

//on regarde si cantvote est set et bien assigné et si oui on affiche le message d'erreur
if(isset($_SESSION['cantvote']) and $_SESSION['cantvote'] ==true){
    $timeleft = timeleftuntilnextvote(htmlspecialchars($_SESSION['id']));
    $errvote = 'Vous devez attendre ' .$timeleft. ' secondes avant le prochain vote';
    $_SESSION['cantvote'] = false;

}//si pas d'erreur on affiche pas d'erreur
else{
    $errvote = '';
}
$coeff = getcanvaswidth($stars);
include('vue/vue_page.php');

