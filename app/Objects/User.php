<?php
class User extends ObjectBase{

    private $id;
    private $role;
    private $username;
    private $password;
    private $email;
    private $image_profile;
    private $point;
    private $event;
    private $nom;
    private $prenom;
    private $sexe;
    private $naissance;

    public function __construct($data)
    {
        foreach($data as $key=>$value){
            $varName = $key;
            $this->$varName = $value;
        }
        $this->updateOrCreate();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->updateOrCreate();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        $this->updateOrCreate();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->updateOrCreate();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->updateOrCreate();
    }

    public function getImageProfile()
    {
        return $this->image_profile;
    }

    public function setImageProfile($image_profile)
    {
        $this->image_profile = $image_profile;
        $this->updateOrCreate();
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        $this->updateOrCreate();
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateOrCreate();
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        $this->updateOrCreate();
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        $this->updateOrCreate();
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
        $this->updateOrCreate();
    }

    public function getNaissance()
    {
        return $this->naissance;
    }

    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;
        $this->updateOrCreate();
    }
}