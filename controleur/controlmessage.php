<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
include_once("C:\wamp64\www\site\modele\profilemanips.php");
include_once("C:\wamp64\www\site\modele\messagesmanip.php");

//on regarde si une personne envoie un nouveau message a une personne, c'est a dire pas dans un chat direct mais via l'outil pour envoyer un message a un de ses amis
if(isset($_POST['message']) and $_POST['message'] != "" and $_POST['receiverpseudo'] != ""){
    
    $receiverpseudo = htmlspecialchars($_POST['receiverpseudo']);
    $receiverid = getidfrompseudo($receiverpseudo);
    if(checkifuserexists($receiverpseudo) and checkFriendshipBetween($_POST['senderid'], $receiverid) == 'friends'){
        
        $senderid = $_POST['senderid'];
        $message = htmlspecialchars($_POST['message']);
        sendmessage($senderid, $receiverid, $message);
        header("Refresh: 0; url=..\messages.php");
    }
    else{
        header("Refresh: 0; url=..\messages.php");
    }
}

//puis on regarde si l'utilisateur envoie un message dans un chat perso avec une personne
if(isset($_POST['chatmessage']) and $_POST['chatmessage'] != ""){
    $message = htmlspecialchars($_POST['chatmessage']);
    sendmessage($_POST['senderidchat'], $_POST['receiveridchat'], $message);
      header("Refresh: 0; url=..\messages.php?id=". $_POST['receiveridchat']);
}

else{
    header('Location: C:\wamp64\www\site\message.php');
}