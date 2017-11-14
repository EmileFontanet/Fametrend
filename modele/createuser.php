<?php
class User{
    //on crée toutes les propriétés de l'user
    private $pseudo;
    private $id;
    private $email;
    private $status;
    private $description;
    private $date_naissance;
    private $sexe;
    private $prenom;
    private $nom;
    private $date_inscription;
    // on crée tous les getters pour obtenir les infos
    public function pseudo(){
        return  $this->pseudo;
    }
    public function id(){
        return  $this->id;
    }
    public function email(){
        return  $this->email;
    }
    public function status(){
        return  $this->status;
    }
    public function description(){
        return  $this->description;
    }
    public function date_naissance(){
        return  $this->date_naissance;
    }
    public function sexe(){
        return  $this->sexe;
    }
    public function prenom(){
        return  $this->prenom;
    }
    public function nom(){
        return  $this->nom;
    }
    public function date_inscription(){
        return  $this->date_inscription;
    }
    //création du constructeur a partir de l'id
    public function __construct($id){
        $infoslist = getInfosToCreateUser($id);
        $this->pseudo = $infoslist[0]['pseudo'];
        $this->id = $id;
        $this->email = $infoslist[0]['email'];
        $this->status = $infoslist[0]['status'];
        $this->description = $infoslist[0]['description'];
        $this->date_naissance = $infoslist[0]['date_naissance'];
        $this->date_inscription = $infoslist[0]['date_inscription'];
        $this->sexe = $infoslist[0]['sexe'];
        $this->prenom = $infoslist[0]['prenom'];
        $this->nom = $infoslist[0]['nom'];
        
        return;
    }
}


