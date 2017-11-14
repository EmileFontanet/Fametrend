<?php
include_once('connexionsql.php');
function checkdispopseudo($pseudo){
    global $bdd;
    $req = $bdd->prepare('SELECT id from membre where pseudo = :value');
    $req->execute(array(
    'value' => $pseudo  ));
    $result = $req->fetch();
    if(!$result){
        return true;
    }
    else{
        return false;
    }
}
function checkdispomail($mail){
    global $bdd;
    $req = $bdd->prepare('SELECT id from membre where email = :value');
    $req->execute(array(
    'value' => $mail  ));
    $result = $req->fetch();
    if(!$result){
        return true;
    }
    else{
        return false;
    }
}
function identification($pseudo,$password){
    global $bdd;
    $req = $bdd->prepare('SELECT id, password FROM membre where pseudo = :pseudo');
    $req->execute(array('pseudo' => $pseudo));
    $result = $req->fetch();
    if($password == $result['password']){
        return $result['id'];
    }
    else{
        return false;
    }
}
function inscription($pseudo, $mail, $password){
    global $bdd;
    if(checkdispopseudo($pseudo) and checkdispomail($mail)){
        $req = $bdd->prepare('INSERT INTO membre(pseudo,password,email,date_inscription) VALUES(:pseudo, :password, :email, CURDATE()) ');
        $hachpass = sha1($password);
        $req->execute(array(
        'pseudo' => $pseudo,
        'password' =>$hachpass,
        'email' => $mail));
        return true;
    }
    else{
        return false;
    }
}
function canvote($id){
    global $bdd;
    $req = $bdd->prepare('SELECT lastvote FROM membre where id = :id');
    $req->execute(array('id' => $id));
    $result = $req->fetch();
    $lastvote = intval($result['lastvote']);
    if((time() - $lastvote) >= 60){
        $now = time();
        $req2 = $bdd->prepare('UPDATE membre SET lastvote = :lastvote WHERE id = :id');
        $req2->execute(array(
        'lastvote' => $now,
            'id' =>$id
        ));
        return true;
        
    }
    else{
        return false;
    }
}
function timeleftuntilnextvote($id){
    global $bdd;
    $req = $bdd->prepare('SELECT lastvote FROM membre where id = :id');
    $req->execute(array('id' => $id));
    $result = $req->fetch();
    $lastvote = intval($result['lastvote']);
    $timeleft = 60-(time()-$lastvote);
    return $timeleft;
}
function checkMailValidity($mail){
    $mail = htmlspecialchars($mail);
    if(preg_match("#^[a-z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#" ,$mail)){
        return true;
    }
    else{
        return false;
    }
}