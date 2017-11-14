<?php
 if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['errinscription'] = array(
    'errpseudo' => '',
    'erremail' => '',
    'errmdp' => '');
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
/*if(!isset($_['pseudo'])){
    $_SESSION['errinscription']['errpseudo'] = 'Choisissez un pseudo';
}
*/
//cas ou tous les champs ont été remplis
if(isset($_POST['pseudo']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['passwordverif'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordverif = htmlspecialchars($_POST['passwordverif']);
    if($password != $passwordverif){
        echo 'les mots de passe ne correspondent pas';
    }
    elseif(!preg_match("#^[a-z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" ,$email)){
        echo 'Entrez une adresse email valide';
    }
    elseif(inscription($pseudo, $email, $password)){
       
        $_SESSION['password'] = $password;
        $_SESSION['pseudo'] = $pseudo;
        header('Location: C:\wamp64\www\site\index.php');
    }
}
else{
    header('Location: inscription.php');
}