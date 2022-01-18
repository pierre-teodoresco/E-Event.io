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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->updateOrCreate();
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->updateAttribute('role', $role);

    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        $this->updateAttribute('username', $username);

    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->updateAttribute('password', $password);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->updateAttribute('email', $email);
    }

    public function getImageProfile()
    {
        return $this->image_profile;
    }

    public function setImageProfile($image_profile)
    {
        $this->image_profile = $image_profile;
        $this->updateAttribute('image_profile', $image_profile);
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        $this->updateAttribute('point', $point);
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateAttribute('event', $event);
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        $this->updateAttribute('nom', $nom);
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        $this->updateAttribute('prenom', $prenom);
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
        $this->updateAttribute('sexe', $sexe);
    }

    public function getNaissance()
    {
        return $this->naissance;
    }

    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;
        $this->updateAttribute('naissance', $naissance);
    }
}