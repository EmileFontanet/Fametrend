<?php
 if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$inscriptionreussie = false;
$errinscription = array(
'errpseudo' => '',
'erremail' => '',
'errmdp' => '');

//cas ou on a submit le formulaire d'inscription au moins une fois
if(isset($_POST['notfirsttime'])){
    //cas où tous les champs sont remplis et non nuls
    if(isset($_POST['pseudo']) and $_POST['pseudo'] != ''
       and isset($_POST['email']) and $_POST['email'] != ''
       and isset($_POST['password']) and $_POST['password'] != ''
       and isset($_POST['passwordverif']) and $_POST['passwordverif'] != ''){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordverif = htmlspecialchars($_POST['passwordverif']);
        //on effectue les tests de dispo/validités et crée les messages d'erreur
        
        if(!preg_match("#^[a-z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" ,$email)){
            $errinscription['erremail'] = 'Entrez une adresse email valide';
        }
        if(!checkdispomail($email)){
            $errinscription['erremail'] = 'Adresse email déjà utilisée';
        }
        if(!checkdispopseudo($pseudo)){
            $errinscription['errpseudo'] = 'Pseudo déjà utilisé';
        }
        if($password != $passwordverif){
            $errinscription['errmdp'] = 'Les mots de passe ne correspondent pas';
        }
        elseif(inscription($pseudo, $email, $password)){

            $_SESSION['password'] = $password;
            $_SESSION['pseudo'] = $pseudo;
            $inscriptionreussie = true;
        }
    }
    //cas ou au moins un champ n'est pas rempli
    else{
        if(!isset($_POST['pseudo']) or $_POST['pseudo'] == ''){
            $errinscription['errpseudo'] = 'Choisissez un pseudo';
        }
        if(!isset($_POST['email']) or $_POST['email'] == ''){
            $errinscription['erremail'] = 'Choisissez une adresse email';
        }
        if(!isset($_POST['password']) or $_POST['password'] == ''){
            $errinscription['errmdp'] = 'Les mots de passe ne correspondent pas' ;
        }
        if(!isset($_POST['passwordverif']) or $_POST['passwordverif'] == ''){
            $errinscription['errmdp'] = 'Les mots de passe ne correspondent pas' ;
        }
    }

}
include('C:\wamp64\www\site\vue\vue_inscription.php');
?>
