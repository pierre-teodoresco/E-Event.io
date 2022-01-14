<?php

class UserModel extends Model{
    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'account';
        $this->className = 'user';
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function checkLogin($email, $password){
        $stmt = $this->_connexion->prepare("SELECT password,id,role FROM ".$this->table." WHERE email = '".$email."'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            $_SESSION['username'] = $email;
            $_SESSION['id'] = $result->id;
            $_SESSION['role'] = $result->role;
            //Redirigier l'user a la page index
            header('Location: index.php');
            return true;
        }
        return false;
    }

    public function checkRegister($email){
        $options = ['cost' => 11,];
        $password = $this->randomPassword();
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt = $this->_connexion->prepare("INSERT INTO `account`(`email`, `role`, `password`) VALUES ('".$email."', '0', '".$hash."') ");
        $stmt->execute();
        $this->sendEmailPassword($email, $password);
    }


    public function emailExists($email){
        $sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email = '".$email."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )return false;
        else return true;
    }

    public function findByName($name){
        $sql = "SELECT * FROM ".$this->table." WHERE `name`='".$name."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }



    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-@&?!';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function sendEmailPassword($to, $pass){
        $subject = 'E-Event - Confirmation de création de compte';
        $message = '
     <html>
      <head>
       <title>Confirmation de création de compte</title>
      </head>
      <body>
      <h2>Confirmation de votre inscription</h2>
      <p>Bienvenue sur E-event.io!</p>
      <p>Voici votre mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
    public function resetPwd($to, $pass){
        $subject = 'E-Event - Changement mot de passe';
        $message = '
     <html>
      <head>
       <title>Changement de mot de passe</title>
      </head>
      <body>
      <h2>Changement de votre mot de passe</h2>
      <p>Vous venez de réaliser la réinstialisation de votre mot de passe</p>
      <p>Voici votre nouveau mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <p>Durée du mot de passe 2h</p>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));
    }

    public function headerEventAdmin(){
        $date = date('Y-m-d');
        $stmt = $this->_connexion->prepare("SELECT * FROM `campagne` WHERE ('" . $date . "' >= datedeb AND '" . $date . "' <= datefin)");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count == 0) {
            return "<p>Aucun evenement n'est en cours</p><p>Vous pouvez créer un evenement en cliquant sur lien</p>";
        } else {
            return "<p>Un evenement est en cours</p>";
        }
    }

    public function tableCampagne(){
        $stmt = "SELECT * FROM campagne";
        $result = $this->_connexion->query($stmt);
        $value= "";
        foreach ($result as $row){
            $value .= "<tr><td>$row[id]</td><td>$row[name]</td><td>$row[datedeb]</td><td>$row[datefin]</td><td>$row[points]</td></tr>";
        }
        return $value;
    }

    public function userCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM account");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function eventCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM evenement");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function tableUsers(){
        $stmt = "SELECT * FROM account";
        $result = $this->_connexion->query($stmt);
        $value= "";
        foreach ($result as $row){
            $rank = "";
            switch($row[role]){
                case 1:
                    $rank= "Organisateur";
                    break;
                case 2:
                    $rank= "Jury";
                    break;
                case 4:
                    $rank="Administrateur";
                    break;
                default:
                    $rank ="Donateurs";
                    break;
            }
            $value .= "<tr><td>$row[id]</td>
                        <td><div class=\"select-rank\"><select name=\"rank\" id=\"rank-select\">
    <option value=\"0\">Donateurs</option>
    <option value=\"1\">Organisateur</option>
    <option value=\"2\">Jury</option>
    <option value=\"4\" >Administrateur</option>
</select></div>

</td><td>$row[username]</td><td>$row[email]</td>
                       <td>$row[point]</td></tr>";
        }

        return $value;
    }
}