<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
$pseudo = htmlspecialchars($_POST['pseudo']);
$password = htmlspecialchars($_POST['password']);
$hashpassword = sha1($password);
if(!identification($pseudo, $hashpassword)){
    header('Location: C:\wamp64\www\site\index.php');
}
else{
    $_SESSION['id'] = identification($pseudo, $hashpassword);
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['password'] = sha1($password);
    $status = 'connected';
    if($_POST['maintenirconnexion'] =='on'){
        setcookie('pseudo', $pseudo, time()+60*60*24*30, '/');
        setcookie('password', sha1($password), time()+60*60*24*30, '/');
    }
    header('Refresh: 0; url=..\index.php');
}