<?php

class UserModel extends Model
{

    //Constructeur
    /**
     *
     */
    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'account';
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    //Vérifie les informations fournies lors de la connection
    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function checkLogin($email, $password)
    {
        $stmt = $this->_connexion->prepare("SELECT username,password,id,role FROM " . $this->table . " WHERE email = '" . $email . "'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['username'] = $result->username;
            $_SESSION['id'] = $result->id;
            $_SESSION['role'] = $result->role;
            //Redirigier l'user a la page index
            header('Location: ?controller=event&action=index');
            return true;
        }
        return false;
    }

    //Vérifie le mot de passe d'un utilisateur
    /**
     * @param $id
     * @param $password
     * @return bool
     */
    public function checkPassword($id, $password)
    {
        $stmt = $this->_connexion->prepare("SELECT password FROM " . $this->table . " WHERE id = '" . $id . "'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            return true;
        }
        return false;
    }

    //Vérifie les informations d'enregistrement d'utilisateur
    /**
     * @param $email
     * @param $password
     * @param $options
     * @param $rank
     * @return void
     */
    public function checkRegister($email, $password, $options, $rank)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $this->_connexion->prepare("INSERT INTO `account`(`email`, `role`, `password`) VALUES ('" . $email . "', '" . $rank . "', '" . $hash . "') ");
        $stmt->execute();

    }

    //Vérifie l'existence d'un mail dans la base
    /**
     * @param $email
     * @return bool
     */
    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = '" . $email . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if ($count == 0) return false;
        else return true;
    }

    //Retourne le nombre de points d'un utilisateur
    /**
     * @param $id
     * @return mixed
     */
    public function getPoint($id)
    {
        $stmt = "SELECT point FROM account WHERE id = $id";
        $stmt = $this->_connexion->query($stmt);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[point];
    }

    //Modifie le mot de passe d'un utilisateur
    /**
     * @param $email
     * @param $password
     * @param $options
     * @return void
     */
    public function resetpwd($email, $password, $options)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $sql = "UPDATE account SET password = '" . $hash . "' WHERE email = '" . $email . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    //Vérifie si un utilisateur existe par son nom d'utilisateur
    /**
     * @param $username
     * @return bool
     */
    public function userExist($username)
    {
        $sql = "SELECT COUNT(*) FROM account WHERE username = '" . $username . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if ($count == 0) return false;
        else return true;
    }

    //Met à jour le mot de passe et le nom d'utilisateur d'un utilisateur
    /**
     * @param $user
     * @param $password
     * @param $options
     * @param $id
     * @return void
     */
    public function checkUsername($user, $password, $options, $id)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $this->_connexion->prepare("UPDATE account SET username = '" . $user . "', password = '" . $hash . "' WHERE id = '" . $id . "'");
        $stmt->execute();
    }

    //Modifie l'image d'un utilisateur
    /**
     * @param $id
     * @param $img
     * @return void
     */
    public function changeImage($id, $img)
    {
        $stmt = $this->_connexion->prepare("UPDATE account SET image_profile = '" . $img . "' WHERE id = '" . $id . "'");
        $stmt->execute();
    }

    //Met à jour une variable de la table
    /**
     * @param $id
     * @param $var
     * @param $img
     * @return void
     */
    public function updateVar($id, $var, $img)
    {
        $stmt = $this->_connexion->prepare("UPDATE account SET $var = '" . $img . "' WHERE id = '" . $id . "'");
        $stmt->execute();
    }


}