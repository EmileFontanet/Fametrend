<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('C:\wamp64\www\site\modele\sqlcheck.php');
include_once("C:\wamp64\www\site\modele\profilemanips.php");
include_once("C:\wamp64\www\site\modele\messagesmanip.php");

// si on veut changer de pseudo
if(isset($_POST['newpseudo']) and $_POST['newpseudo'] != ""){
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    
    //on regarde si l'utilisateur a déjà changé de pseudo une fois
    if(checkIfUserAlreadyChangedPseudo($_POST['id']) == 'canchange' ){
        if(checkDispoPseudo($newpseudo)){
            changePseudo($_POST['id'], $newpseudo);
            $_SESSION['pseudo'] = $newpseudo;
        }
        else{
        $_SESSION['$errchangepseudo'] = "Le pseudo est déjà utilisé";
        }
    }
    else{
        $_SESSION['errchangepseudo'] = "Vous avez déjà changé de pseudo une fois";
    }
}
    
// cas ou l'on veut changer d'email
if(isset($_POST['newmail']) and $_POST['newmail'] != ""){
    $newmail = htmlspecialchars($_POST['newmail']);
    
    if(checkDispoMail($newmail)){
        changeMail($_POST['id'], $newmail);
        $_SESSION["errchangemail"] = "Votre adresse email a été modifiée";
        
    }
    else{
        $_SESSION["errchangemail"] = "L'adresse email est déjà utilisée";
    }
}
    
//si on veut changer de mot de passe    
if(isset($_POST['oldpassword']) and $_POST['oldpassword'] != "" and isset($_POST['newpassword1']) and $_POST['newpassword1'] != "" and isset($_POST['newpassword2']) and $_POST['newpassword2'] != ""){
    $newpassword1 = htmlspecialchars($_POST['newpassword1']);
    $newpassword2 = htmlspecialchars($_POST['newpassword2']);
    $oldpassword = htmlspecialchars($_POST['oldpassword']);
    if(checkChangePassword($_POST['id'], $oldpassword, $newpassword1, $newpassword2) == 'canchange'){
        changePassword($_POST['id'], $newpassword1);
        $_SESSION['password'] = sha1($newpassword1);
    }
    else{
        $_SESSION['errchangepassword'] = checkChangePassword($_POST['id'], $oldpassword, $newpassword1, $newpassord2);
    }
}
if(isset($_POST['prenom']) and $_POST['prenom'] != ""){
    changePrenom($_POST['id'], $_POST['prenom']);
}
if(isset($_POST['nom']) and $_POST['nom'] != ""){
    changeNom($_POST['id'], $_POST['nom']);
}
if(isset($_POST['date_naissance']) and $_POST['date_naissance'] != ""){
    changeDateNaissance($_POST['id'], $_POST['date_naissance']);
}
if(isset($_POST['sexe']) and $_POST['sexe'] != ""){
    changeSexe($_POST['id'], $_POST['sexe']);
}
if(isset($_POST['newdescription']) and $_POST['newdescription']!=""){
    changeDescription($_POST['id'], $_POST['newdescription']);
    
}
if(isset($_POST['newstatus'])){
    
}
header("Refresh: 0; url=..\profile.php");