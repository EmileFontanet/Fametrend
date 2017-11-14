<?php

include_once('C:\wamp64\www\site\modele\connexionsql.php');
include_once('C:\wamp64\www\site\modele\sqlcheck.php');

function cryptmessage($message, $key){
    return $message;
}
    
function decryptmessage($message, $key){
    return $message;
}
function sendmessage($senderid, $receiverid, $message){
    global $bdd;
    $key = 1;
    $cryptedmessage = cryptmessage($message, $key);
    $req = $bdd->prepare("INSERT INTO messages (sent_by, sent_to, date_sent, content, status) VALUES (:senderid, :receiverid, NOW(), :message, 0)");
    $req->bindParam(':senderid', $senderid);
    $req->bindParam(':receiverid', $receiverid);
    $req->bindParam(':message', $cryptedmessage);
    $req->execute();
    
    return $req;
}
function getnumberofunreadmessages($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT COUNT(*) FROM messages WHERE sent_to = :user AND status = 0 ');
    $req->bindParam(':user', $user);
    $req->execute();
    $numberofrequests = $req->fetchall();
    return $numberofrequests;
}
function getNumberOfUnreadConversations($user){
    global $bdd;
    $user = (int) $user;
    $req = $bdd->prepare('SELECT sent_by FROM messages WHERE sent_to = :user AND status = 0');
    $req->bindParam(':user', $user);
    $req->execute();
    $users = $req->fetchall();
    $unreadconversations = 0;
    $alreadycounted = array();
    for($i = 0; $i<sizeof($users); $i++){
        if(!in_array($users[$i][0], $alreadycounted)){
            array_push($alreadycounted, $users[$i][0]);
            $unreadconversations++;
             }
    }
    return $unreadconversations;
}
function getNumberOfUnreadMessagesBetweenUsers($receiver, $sender){
    global $bdd;
    $receiver = (int) $receiver;
    $sender = (int) $sender;
    $req = $bdd->prepare('SELECT COUNT(*) FROM messages WHERE sent_to = :receiver AND sent_by = :sender AND status = 0 ');
    $req->bindParam(':receiver', $receiver);
    $req->bindParam(':sender', $sender);
    $req->execute();
    $numberofmessages = $req->fetchall();
    $numberofmessages = $numberofmessages[0][0];
    return $numberofmessages;
}
function getlastmessagesbetween($user1, $user2, $offset, $numberofmessages){
    global $bdd;
    $offset =(int) $offset;
    $numberofmessages =(int) $numberofmessages;
    $user1 = (int) $user1;
    $user2 = (int) $user2;
    $numberofmessages = (int) $numberofmessages;
    $req = $bdd->prepare("SELECT content, date_sent, date_read, status, sent_by FROM messages WHERE sent_by = :user1 AND sent_to = :user2 OR sent_by = :user2 AND sent_to = :user1 ORDER BY date_sent DESC LIMIT :offset, :numberofmessages");
    $req->bindParam(':user1', $user1 );
    $req->bindParam(':user2', $user2 );
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':numberofmessages', $numberofmessages, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetchall();
    return $result;
}
function GetPseudosFromLastPeopleWhoMessaged($user, $offset, $limit){
    global $bdd;
    $offset =(int) $offset;
    $limit =(int) $limit;
    $user = (int) $user;
    $req = $bdd->prepare("SELECT sent_to, sent_by from messages WHERE sent_to = :user OR sent_by = :user ORDER BY date_sent DESC ");
    $req->bindParam(":user", $user);
    //$req->bindParam(':offset', $offset, PDO::PARAM_INT);
    //$req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $resultbrut = $req->fetchall();
    $idlist = array();
    for($i = 0; $i < sizeof($resultbrut); $i++){
        if(sizeof($idlist) < $limit){
            
            if($resultbrut[$i][0] == $user and !in_array($resultbrut[$i][1], $idlist)){
                array_push($idlist, $resultbrut[$i][1]);
            }
            else if(!in_array($resultbrut[$i][0], $idlist) and $resultbrut[$i][0] != $user){
                array_push($idlist, $resultbrut[$i][0]);
            }
            else if($resultbrut[$i][0] == $user and $resultbrut[$i][1] == $user){
                array_push($idlist, $resultbrut[$i][0]);
            }
        }
        else{
            $i = sizeof($resultbrut) - 1;
        }
    }
    
    $pseudolist = getpseudosfromidlist($idlist);
    return $pseudolist;
}
function readmessagesbetween($receiver, $sender){
    global $bdd;
    $receiver = (int) $receiver;
    $sender = (int) $sender;
    $req = $bdd->prepare('UPDATE messages SET status = 1 WHERE sent_to = :receiver AND sent_by = :sender');
    $req->bindParam(':receiver', $receiver);
    $req->bindParam(':sender', $sender);
    $req->execute();
    return $req;
}
