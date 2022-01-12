<?php
session_start();

$action = $_POST['action'];
$options = [
    'cost' => 11,
];// Get the password from post

if($action == 'LOGIN') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // connexion à la base de données
        $db_username = 'phpproject';
        $db_password = 'qyfzuf-0vepna-zynkUj';
        $db_name = 'phpproject';
        $db_host = 'localhost';
        $db1 = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die('could not connect to database');

        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $username = ($_POST['username']);
        $password = ($_POST['password']);


        if ($username !== "" && $password !== "") {
            $stmt = $db1->prepare("SELECT password, verified FROM account WHERE username = ?");
            $stmt->bind_param("s", $_POST['username']);
            $stmt->execute();
            $stmt->bind_result($hash, $verified);
            if ($stmt->fetch() && password_verify($_POST['password'], $hash)) {
                if($verified != 0) {
                    $_SESSION['username'] = $username;
                    header('location: index.php');
                    exit;
                }else{
                    header('Location: login.php?erreur=3');
                }

            } else {
                header('Location: login.php?erreur=1');
            }
            $stmt->close();
        } else {
            header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
        }
    } else {
        header('Location: login.php');
    }
    mysqli_close($db1); // fermer la connexion
}
if($action == 'REGISTER') {
    if (isset($_POST['email']) && isset($_POST['role'])) {
        // connexion à la base de données
        $db_username = 'phpproject';
        $db_password = 'qyfzuf-0vepna-zynkUj';
        $db_name = 'phpproject';
        $db_host = 'localhost';
        $db1 = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die('could not connect to database');

        $username = mysqli_real_escape_string($db1, htmlspecialchars($_POST['username']));
        $password = mysqli_real_escape_string($db1, htmlspecialchars($_POST['password']));
        $passwordconfirm = mysqli_real_escape_string($db1, htmlspecialchars($_POST['passwordconfirm']));
        $email = mysqli_real_escape_string($db1, htmlspecialchars($_POST['email']));
        $role = mysqli_real_escape_string($db1, htmlspecialchars($_POST['role']));

        // $hash = password_hash($password, PASSWORD_BCRYPT, $options);

        if ($email != "" && $role != ""){
            $requete = "SELECT count(*) FROM account where email = '" . $email . "' ";
            $exec_requete = mysqli_query($db1, $requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if ($count == 0) {
                $password = uniqid();
                $requete2 = "INSERT INTO `account`(`email`, `role`, `password`) 
                    VALUES ('".$email."', '".$role."', '".$password."') ";
                $exec_requete2 = mysqli_query($db1, $requete2);

                /* /!IMPORTANT!\ MAILTO */

            }else{
                header('Location: register.php?erreur=4'); //Adresse mail déjà utiliser
            }
        }else{
            header('Location: register.php?erreur=1'); // Information manquante
        }
    } else {
        header('Location: register.php');
    }
    mysqli_close($db1); // fermer la connexion
}
?>