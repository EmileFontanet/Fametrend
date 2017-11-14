<?php
if(isset($status) and $status == 'connected'){
    if(!isset($_SESSION["errchangemail"])){
        $_SESSION["errchangemail"] = "";
    }
    
    if(!isset($_SESSION["errchangepseudo"])){
        $_SESSION["errchangepseudo"] = "";
    }
    
    if(!isset($_SESSION["errchangepassword"])){
        $_SESSION["errchangepassword"] = "";
    }
    if(isset($_GET['modify'])){
        $modify = htmlspecialchars($_GET['modify']);
    }
    else{
        $modify = 'false';
    }
    
    
    //on regarde si la valeur de l'id dans l'url est valide
    if(isset($_GET['id']) and $_GET['id'] != "" and intval($_GET['id']) != 0 and strlen(intval($_GET['id'])) == strlen($_GET['id']) ) {
        $id = htmlspecialchars($_GET['id']);

        if($id == $_SESSION['id']){
            $infosuser = getAllInfosFromId($id);
            include('C:\wamp64\www\site\vue\vue_profileself.php');
        }
      
        else if(checkifuserexistsbyid($id)){
            $infosuser = getAllInfosFromId($id);
            include('C:\wamp64\www\site\vue\vue_profileother.php');
    }
    else{
        $infosuser = getAllInfosFromId($id);
        include('C:\wamp64\www\site\vue\vue_profileself.php');
    }
}
    else{
        $id = $_SESSION['id'];
        $infosuser = getAllInfosFromId($id);
        include('C:\wamp64\www\site\vue\vue_profileself.php');
    }
    
    $_SESSION['errchangemail'] = "";
    $_SESSION['errchangepseudo'] = "";
    $_SESSION['errchangepassword'] = "";
}
else{
    header('Location: index.php');
}

?>