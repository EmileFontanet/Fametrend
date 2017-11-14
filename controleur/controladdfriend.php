<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
include_once("C:\wamp64\www\site\modele\profilemanips.php");




//on regarde si des infos non vides ont été envoyées
if(isset($_POST["friendtoadd"]) and $_POST["friendtoadd"] != ""){
    $friendtoadd = htmlspecialchars($_POST["friendtoadd"]);
    $friendtoaddid =  getidfrompseudo($friendtoadd);
    $friendshipstatus = checkfriendshipbetween($_SESSION["id"], $friendtoaddid[0]);
    
    //si l'amitié entre les deux n'existe pas
    if($friendshipstatus == "not friends"){
        if(checkifuserexists($friendtoadd)){
            askfriend($_SESSION['id'], $friendtoaddid[0]);
            $_SESSION["erraddfriend"] = "Demande envoyée";
            header("Refresh: 0; url=..\amis.php");
        }
        else{
            $_SESSION["erraddfriend"] = "L'utilisateur n'existe pas";
            header("Refresh: 0; url=..\amis.php");
        }
        
    }
    else{
        
        if($friendshipstatus == "pending"){
            $_SESSION['erraddfriend'] = "Vous avez déjà envoyé une demande à cette utilisateur.";
            header("Refresh: 0; url=..\amis.php");
        }
        else if($friendshipstatus == "friends"){
            $_SESSION["erraddfriend"] = "Vous êtes déjà ami avec cet utilisateur";
            header("Refresh: 0; url=..\amis.php");
        }
    }
    
}

else{
    header("Location: C:\wamp64\www\site\amis.php");
}





