<?php
class User{

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
        foreach($data as $var){
            $varName = array_search($var, $data);
            $this->$varName = $var;
        }
    }

    public function updateAll(){
        $data = [
            'id' => $this->id,
            'role' => $this->role,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'image_profile' => $this->image_profile,
            'point' => $this->point,
            'event' => $this->event,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'sexe' => $this->sexe,
            'naissance' => $this->naissance
        ];
        $model = new EventModel();
        $model->updateAll($data);
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
        $this->updateAll();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        $this->updateAll();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->updateAll();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->updateAll();
    }

    public function getImageProfile()
    {
        return $this->image_profile;
    }

    public function setImageProfile($image_profile)
    {
        $this->image_profile = $image_profile;
        $this->updateAll();
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        $this->updateAll();
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateAll();
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        $this->updateAll();
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        $this->updateAll();
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
        $this->updateAll();
    }

    public function getNaissance()
    {
        return $this->naissance;
    }

    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;
        $this->updateAll();
    }
}