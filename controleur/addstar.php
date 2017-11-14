<?php
include_once('C:\wamp64\www\site\modele\starsmanip.php');
if(isset($_POST['starname']) and isset($_POST['staroccupation']) and isset($_POST['starpays'])){
    $starname = htmlspecialchars($_POST['starname']);
    $staroccupation = htmlspecialchars($_POST['staroccupation']);
    $starpays = htmlspecialchars($_POST['starpays']);
    if(checkdispostar($starname, $staroccupation, $starpays)){
        addstar($starname, $staroccupation, $starpays, $_SESSION['id']);
        $staradded = true;
    }

}

if(isset($staradded) and $staradded == "true"){
    echo "La célébrité a été ajoutée!";
        
    
}
else if(isset($status) and $status == 'connected'){
    include('C:\wamp64\www\site\vue\vue_addstar_connected.php');
    
}
else{
    include('C:\wamp64\www\site\vue\vue_addstar_disconnected.php');
}