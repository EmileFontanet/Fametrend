<?php
include_once('C:\wamp64\www\site\modele\connexionsql.php');
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
function checkifuserexists($pseudo){
    global $bdd;
    $req = $bdd->prepare('SELECT id FROM membre WHERE pseudo = :pseudo');
    $req->execute(array('pseudo' => $pseudo));
    $id = $req->fetch();
    if(!$id){
        return false;
    }
    else{
        return true;
    }
}
function checkifuserexistsbyid($id){
    global $bdd;
    $req = $bdd->prepare('SELECT pseudo FROM membre WHERE id = :id');
    $req->execute(array('id' => $id));
    $pseudo = $req->fetch();
    if(!$pseudo){
        return false;
    }
    else{
        return true;
    }
}
function getnumberoffriends($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT COUNT(*) FROM friendships WHERE user1_id = :user AND status = 1 OR user2_id = :user AND status = 1');
    $req->bindParam(':user', $user);
    $req->execute();
    $numberoffriends = $req->fetchall();
    $numberoffriends = (int) $numberoffriends;
    return $numberoffriends;
}

function checkfriendshipbetween($user1, $user2){
    global $bdd;
    $user1 = (int) $user1;
    $user2 = (int) $user2;
    $req = $bdd->prepare('SELECT status FROM friendships WHERE (user1_id = :user1 AND user2_id = :user2) OR (user1_id = :user2 AND user2_id = :user1) ');
    $req->execute(array(
    'user1' => $user1,
    'user2' => $user2));
    $result = $req->fetch();
    if(!$result){
        return "not friends";
    }
    else if($result[0] == "0"){
        return "pending";
    }
    else if($result[0] == "1"){
        return "friends";
    }
}
function getfriends($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT user1_id, user2_id FROM friendships WHERE user1_id = :id AND status = 1 OR user2_id = :id AND status = 1');
    $req->bindParam(':id', $user);
    $req->execute() ;
    $friendsbrut = $req->fetchall();
    $friends = array();
    for($i = 0; $i < sizeof($friendsbrut); $i++){
        if($friendsbrut[$i][0] == $user){
            array_push($friends, $friendsbrut[$i][1]);
        }
        else if($friendsbrut[$i][1] == $user){
            array_push($friends, $friendsbrut[$i][0]);
        }
    }
    
    return $friends;
}
function getpseudosfromidlist($idlist){
    global $bdd;
    $req = $bdd->prepare('SELECT pseudo FROM membre WHERE id = :id');
    $pseudolist =array();
    for($i = 0; $i < sizeof($idlist) ; $i++){
        $req->execute(array('id' => $idlist[$i]));
        $pseudo = $req->fetch();
        array_push($pseudolist, $pseudo[0]);
    }
    
    return $pseudolist;
}
function AskFriend($seekerid, $receiverid){
    global $bdd;
    $seekerid = (int) $seekerid;
    $receiverid = (int) $receiverid;
    $req = $bdd->prepare("INSERT INTO friendships (user1_id, user2_id, status, daterequest) VALUES (:seekerid, :receiverid, 0, NOW() )");
    $req->bindParam(':seekerid', $seekerid);
    $req->bindParam(':receiverid', $receiverid);
    $req->execute();
    return $req;
}
function getidfrompseudo($pseudo){
    global $bdd;
    $req = $bdd->prepare('SELECT id FROM membre WHERE pseudo = :pseudo');
    $req->execute(array('pseudo' => $pseudo));
    $id = $req->fetch();
    $id = $id[0];
    return $id;
}
function getpseudofromid($id){
    global $bdd;
    $req = $bdd->prepare('SELECT pseudo FROM membre WHERE id = :id');
    $req->execute(array('id' => $id));
    $pseudo = $req->fetch();
    $pseudo = $pseudo[0];
    return $pseudo;
}
function acceptfriend($seekerid, $receiverid){
    global $bdd;
    $seekerid = (int) $seekerid;
    $receiverid = (int) $receiverid;
    $req = $bdd->prepare("UPDATE friendships SET status = 1, dateaccept = NOW() WHERE user1_id = :seekerid AND user2_id = :receiverid AND status = 0 ");
    $req->bindParam(':seekerid', $seekerid);
    $req->bindParam(':receiverid', $receiverid);
    $req->execute();
    return $req;
}
function deletefriendship($user1, $user2){
    global $bdd;
    $user1 = (int) $user1;
    $user2 = (int) $user2;
    $req = $bdd->prepare("DELETE from friendships WHERE (user1_id = :user1 AND user2_id = :user2) OR (user1_id = :user2 AND user2_id = :user1) ");
    $req->execute(array(
    'user1' => $user1,
    'user2' => $user2));
    return $req;
}
function getnumberofrequests($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT COUNT(*) FROM friendships WHERE user2_id = :user AND status = 0 ');
    $req->bindParam(':user', $user);
    $req->execute();
    $numberofrequests = $req->fetchall();
    return $numberofrequests;
}
function getrequestslist($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT user1_id FROM friendships WHERE user2_id = :user AND status = 0 ');
    $req->bindParam(':user', $user);
    $req->execute();
    $requestslistbrut = $req->fetchall();
    $requestslist = array();
    for($i = 0; $i < sizeof($requestslistbrut); $i++){
        array_push($requestslist, $requestslistbrut[$i][0]);
    }
    return $requestslist;
}
function getalluserswithpoints(){
    global $bdd;
    $req = $bdd->prepare("SELECT nb_points, added_by from stars WHERE nb_points > 0");
    $req->execute();
    $pointsandusersbrut = $req->fetchall();
    $userswithpoints = array();
    for($i = 0; $i < sizeof($pointsandusersbrut) ; $i++){
        if(!isset($userswithpoints[$pointsandusersbrut[$i][1]])){
            $userswithpoints[$pointsandusersbrut[$i][1]] = intval($pointsandusersbrut[$i][0]);
        }
        else if (isset($userswithpoints[$pointsandusersbrut[$i][1]])){
            $userswithpoints[$pointsandusersbrut[$i][1]] += intval($pointsandusersbrut[$i][0]);
        }
    }
    return $userswithpoints;
    
}
function getalluserswithid(){
    global $bdd;
    $req = $bdd->prepare("SELECT  id, pseudo from membre ");
    $req->execute();
    $userswithidbrut = $req->fetchall();
    $userswithid = array();
    for($i = 0; $i< sizeof($userswithidbrut); $i++){
        $userswithid[$userswithidbrut[$i][0]] = $userswithidbrut[$i][1];
    }
    return $userswithid;
}
function getnumberofusers(){
    global $bdd;
    $req = $bdd->prepare("SELECT COUNT(*) from membre");
    $req->execute();
    $result = $req->fetch();
    return $result;
}
function getAllInfosFromId($id){
    $id = (int) $id;
    global $bdd;
    $req = $bdd->prepare("SELECT pseudo, email, date_inscription, password FROM membre WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $result = $req->fetch();
    return $result;
}
function checkIfUserAlreadyChangedPseudo($id){
    global $bdd;
    $id = (int) $id;
    $req = $bdd->prepare("SELECT changepseudo FROM membre WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $result = $req->fetch();
    if($result['changepseudo'] == 1){
        return 'alreadychanged';
    }
    else{
        return 'canchange';
    }
}
function changePseudo($id, $newpseudo){
    global $bdd;
    $id = (int) $id;
    $newpseudo = htmlspecialchars($newpseudo);
    $req = $bdd->prepare('UPDATE membre SET pseudo = :newpseudo, changepseudo = 1 WHERE id = :id');
    $req->bindParam(":newpseudo", $newpseudo);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changeMail($id, $newmail){
    global $bdd;
    $id = (int) $id;
    $newmail = htmlspecialchars($newmail);
    $req = $bdd->prepare('UPDATE membre SET email = :newmail WHERE id = :id');
    $req->bindParam(":newmail", $newmail);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function checkChangePassword($id, $oldpassword, $newpassword1, $newpassword2){
    global $bdd;
    $id = (int) $id;
    $oldpassword = htmlspecialchars($oldpassword);
    $newpassword1 = htmlspecialchars($newpassword1);
    $newpassword2 = htmlspecialchars($newpassword2);
    $req = $bdd->prepare('SELECT password FROM membre  WHERE id = :id');
    $req->bindParam(":id", $id);
    $req->execute();
    $result = $req->fetch();
    if($result['password'] == sha1($oldpassword)){
        if($newpassword1 == $newpassword2){
            return "canchange";
        }
        else{
            return "Les mots de passe ne correspondent pas" ;
        }
    }
    else{
        return "L'ancien mot de passe ne correspond pas";
    }
}
function changePassword($id, $newpassword){
    global $bdd;
    $id = (int) $id;
    $newpassword = htmlspecialchars($newpassword);
    $newpassword = sha1($newpassword);
    $req = $bdd->prepare('UPDATE membre SET password = :newpassword WHERE id = :id');
    $req->bindParam(":newpassword", $newpassword);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changeSexe($id, $sexe){
    global $bdd;
    $id = (int) $id;
    $sexe = htmlspecialchars($sexe);
    $req = $bdd->prepare('UPDATE membre SET sexe = :sexe WHERE id = :id');
    $req->bindParam(":sexe", $sexe);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changePrenom($id, $prenom){
    global $bdd;
    $id = (int) $id;
    $prenom = htmlspecialchars($prenom);
    $req = $bdd->prepare('UPDATE membre SET prenom = :prenom WHERE id = :id');
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changeNom($id, $nom){
    global $bdd;
    $id = (int) $id;
    $nom = htmlspecialchars($nom);
    $req = $bdd->prepare('UPDATE membre SET nom = :nom WHERE id = :id');
    $req->bindParam(":nom", $nom);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changeDateNaissance($id, $date_naissance){
    global $bdd;
    $id = (int) $id;
    $date_naissance = htmlspecialchars($date_naissance);
    $req = $bdd->prepare('UPDATE membre SET date_naissance = :date_naissance WHERE id = :id');
    $req->bindParam(":date_naissance", $date_naissance);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function changeDescription($id, $description){
    global $bdd;
    $id = (int) $id;
    $description = htmlspecialchars($description);
    $req = $bdd->prepare('UPDATE membre SET description = :description WHERE id = :id');
    $req->bindParam(":description", $description);
    $req->bindParam(":id", $id);
    $req->execute();
    return;
}
function getInfosToCreateUser($id){
    global $bdd;
    $id = (int) $id;
    $req = $bdd->prepare('SELECT pseudo, id, email, status, description, date_naissance, date_inscription, sexe ,prenom, nom FROM membre WHERE id = :id');
    $req->bindParam(":id", $id);
    $req->execute();
    $result = $req->fetchall();
    return $result;
}
