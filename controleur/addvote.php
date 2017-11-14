<?php
 if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$userid = $_SESSION['id'];
include_once('C:\wamp64\www\site\modele\sqlcheck.php');
include_once('C:\wamp64\www\site\modele\starsmanip.php');
$starid = htmlspecialchars($_POST['votebutton']);
if(canvote($userid)){
    addpoint($starid);
}
else{
    $_SESSION['cantvote'] = true;
}
header('Refresh: 0; url= ..\index' . $_POST['url']);