<?php
//on regarde si l'utilisateur est connecté
if(isset($status) and $status == 'connected'){
    //on recupere les pseudos des dernieres personnes avec lesquelles on a chatté
    $lastpseudos = GetPseudosFromLastPeopleWhoMessaged($_SESSION['id'], 0, 10);
    //on regarde si l'utilisateur a selectionné une conversation avec quelqu'un et on vérifie que c'est bien un chiffre et que les deux utilsateurs sont bien amis
    if(isset($_GET['id']) and $_GET['id'] !="" and intval($_GET['id']) != 0 and intval($_GET['id']) == $_GET['id']){
        
        $friendsid = htmlspecialchars($_GET['id']);
        if(checkFriendShipBetween($_SESSION['id'], $friendsid) == 'friends'){
            readmessagesbetween($_SESSION['id'], $friendsid);
            $offsetmessages = 0;
            $friendshipvalidity = true;
            $lastmessages = getLastMessagesBetween($_SESSION['id'], $friendsid, $offsetmessages, 20);
        }
    }
    
    include('C:\wamp64\www\site\vue\vue_messages.php');
}

else{
    header('Location: index.php');
}

?>