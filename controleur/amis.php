<?php



if(isset($status) and $status == 'connected'){
    $iduser = htmlspecialchars($_SESSION['id']);
    $friends = getfriends($iduser);
    $pseudolist = getpseudosfromidlist($friends);
    $requestslistids = getrequestslist($iduser);
    $requestslistpseudos = getpseudosfromidlist($requestslistids);
    if(!isset($_SESSION['erraddfriend'])){
        $_SESSION['erraddfriend'] = "";
    }
    //on assigne les éléments et effectue les specialchars    

    //On regarde si on a appuyé sur un bouton pour accepter ou refuser quelqu'un
    if(isset($_POST["acceptordeny"])){
        if($_POST["acceptordeny"] =="accept"){
            acceptfriend($_POST["seekerid"], $_SESSION['id']);
            header("Refresh: 0; url=amis.php");
        }
        else if($_POST["acceptordeny"] =="deny"){
            deletefriendship($_POST["seekerid"], $_SESSION['id']);
            header("Refresh: 0; url=amis.php");
        }
        else{
            header("Location: amis.php");
        }
    }

    if(isset($_POST['deletefriend']) and $_POST['deletefriend'] == "true"){

        deletefriendship($_POST['friendid'], $_SESSION['id']);
        header("Refresh: 0; url=amis.php");
    }
    
    
    include('C:\wamp64\www\site\vue\vue_amis.php');
}

else{
    header('Location: index.php');
}

?>