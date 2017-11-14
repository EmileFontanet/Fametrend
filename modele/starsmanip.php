<?php
include_once('C:\wamp64\www\site\modele\connexionsql.php');
function getstars($offset, $limit){
    global $bdd;
    $offset =(int) $offset;
    $limit = (int) $limit;
    $req = $bdd->prepare('SELECT id, nom, occupation, pays, nb_points from stars ORDER BY nb_points DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute() ;
    $stars = $req->fetchall() ;
    return $stars;
}
function getstarsbypays($pays, $offset, $limit){
    global $bdd;
    $pays = htmlspecialchars($pays);
    $offset =(int) $offset;
    $limit = (int) $limit;
    $req = $bdd->prepare('SELECT id, nom, occupation, pays, nb_points from stars WHERE pays = :pays ORDER BY nb_points DESC LIMIT :offset, :limit');    
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':pays', $pays );
    $req->execute() ;
    $stars = $req->fetchall() ;
    return $stars;
}
function getstarsbyoccupation($occupation, $offset, $limit){
    global $bdd;
    $occupation = htmlspecialchars($occupation);
    $offset =(int) $offset;
    $limit = (int) $limit;
    $req = $bdd->prepare('SELECT id, nom, occupation, pays, nb_points from stars WHERE occupation =:occupation ORDER BY nb_points DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':occupation', $occupation);
    $req->execute() ;
    $stars = $req->fetchall() ;
    return $stars;
}
function getstarsbyname($name, $offset, $limit){
    global $bdd;
    $name = htmlspecialchars($name);
    $offset =(int) $offset;
    $limit = (int) $limit;
    $req = $bdd->prepare("SELECT id, nom, occupation, pays, nb_points from stars WHERE nom REGEXP '".$name."' ORDER BY nb_points DESC LIMIT :offset, :limit");
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute() ;
    $stars = $req->fetchall() ;
    return $stars;
}
function getcanvaswidth($stars){
    $coeff = array();
    $totalvotes = 0;
    foreach($stars as $star){
        $totalvotes = $totalvotes + intval($star['nb_points']);
    }
    foreach($stars as $star){
        $coeff_i = intval($star['nb_points'])/$totalvotes;
        array_push($coeff, $coeff_i);
    }
    
    return $coeff;
}
function addpoint($idstar){
    global $bdd;
    $req =$bdd->prepare('UPDATE stars SET nb_points = (nb_points + 1) WHERE id = :id');
    $req->execute(array('id' => $idstar));
    return $req;
}
function addstar($nom, $occupation, $pays, $userid){
    global $bdd;
    $nom = htmlspecialchars($nom);
    $occupation = htmlspecialchars($occupation);
    $pays = htmlspecialchars($pays);
    $req = $bdd->prepare('INSERT INTO stars (nom, occupation, pays, date_creation, nb_points, added_by) VALUES (:nom, :occupation, :pays, NOW(), 0, :userid) ');
    $req->execute(array(
    'nom' => $nom,
    'occupation' => $occupation,
    'pays' =>$pays,
    'userid' =>$userid));
    return true;  
}
function checkdispostar($nom, $occupation, $pays){
    global $bdd;
    $nom = htmlspecialchars($nom);
    $occupation = htmlspecialchars($occupation);
    $pays = htmlspecialchars($pays);
    $req = $bdd->prepare('SELECT id from stars WHERE nom = :nom AND occupation = :occupation AND pays = :pays');
    $req->execute(array(
    'nom' => $nom,
    'occupation' => $occupation,
    'pays' =>$pays));
    $result = $req->fetch();
    if(!$result){
        return true;
    }
    else{
        return false;
    }
      
}
function getstarsbyuser($iduser, $offset, $limit){
    global $bdd;
    $iduser = htmlspecialchars($iduser);
    $offset = (int)$offset;
    $limit = (int) $limit;
    $req = $bdd->prepare('SELECT s.id, s.nom, s.occupation, s.pays, s.nb_points FROM stars s 
    INNER JOIN membre
    ON s.added_by = membre.id
    WHERE membre.id = :iduser
    ORDER BY nb_points DESC
    LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':iduser', $iduser );
    $req->execute() ;
    $stars = $req->fetchall() ;
    return $stars;
}