<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('connexionsql.php');
include_once('sqlcheck.php');
include_once('modele\profilemanips.php');
include_once('modele\createuser.php');
//si on vient d'appuyer sur deconnexion, on clean tout
if(isset($_POST['deconnexion'])){
    if($_POST['deconnexion'] == 'Déconnexion'){
        $_SESSION['id'] = '';
        $_SESSION['password'] = '';
        $_SESSION["numberofrequests"] = '';
        $status = '';
        $_COOKIE['pseudo'] = '';
        $_COOKIE['password'] = '';
        setcookie('password', '', time()-3600);
        setcookie('pseudo', '', time()-3600);        
    }
}
//si on se connecte par session, on associe les valeurs importantes comme le nombre de messages non lus ou le nombre de demandes en ami
if(isset($_SESSION['pseudo']) and isset($_SESSION['password'])){
    $pseudo = htmlspecialchars($_SESSION['pseudo']);
    $password = htmlspecialchars($_SESSION['password']);
    if(identification($pseudo, $password) != false){
        $_SESSION['id'] = identification($pseudo, $password);
        $_SESSION['numberofmessages'] = getNumberOfUnreadConversations($_SESSION['id']);
        $_SESSION["numberofrequests"] = getnumberofrequests($_SESSION['id']);
        $user_obj = new User(identification($pseudo, $password));
        $status = 'connected';
    }
}
//si on se connecte par cookie, on associe toutes les valeurs importantes pour la session
else if (isset($_COOKIE['pseudo']) and isset($_COOKIE['password'])){
    $pseudo = htmlspecialchars($_COOKIE['pseudo']);
    $password = htmlspecialchars($_COOKIE['password']);
    if(identification($pseudo, $password) != false){
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = identification($pseudo, $password);
        $_SESSION["numberofrequests"] = getnumberofrequests($_SESSION['id']);
        $_SESSION['numberofmessages'] = getNumberOfUnreadConversations($_SESSION['id']);
        $user_obj = new User(identification($pseudo, $password));
        $status = 'connected';
    }
}
