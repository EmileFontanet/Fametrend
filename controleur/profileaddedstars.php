<?php
if(isset($status) and $status == 'connected'){
    $iduser = htmlspecialchars($_SESSION['id']);
    $stars = getstarsbyuser($iduser, 0, 5);
    
    
    
    //on assigne les éléments et effectue les specialchars
    foreach($stars as $cle => $star){//puis on récup les infos
    $stars[$cle]['nom'] = htmlspecialchars($star['nom']);
    $stars[$cle]['occupation'] = htmlspecialchars($star['occupation']);
    $stars[$cle]['pays'] = htmlspecialchars($star['pays']);
    $stars[$cle]['nb_points'] = htmlspecialchars($star['nb_points']);
    $stars[$cle]['id'] = htmlspecialchars($star["id"]);
}
    include('C:\wamp64\www\site\vue\vue_profileaddedstars.php');
}
else{
    header('Location: index.php');
}

?>