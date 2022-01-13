<?php
session_start();
include_once 'sendmail.func.php';

$action = $_POST['action'];
$options = [
    'cost' => 11,
];// Get the password from post

if($action == 'LOGIN') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // connexion à la base de données
        $db_username = 'phpproject';
        $db_password = 'qyfzuf-0vepna-zynkUj';
        $db_name = 'phpproject';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die('could not connect to database');

        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));


        if ($email !== "" && $password !== "") {
            $stmt = $db->prepare("SELECT password,id,role FROM account WHERE email = ?");
            $stmt->bind_param("s", $_POST['email']);
            $stmt->execute();
            $stmt->bind_result($hash,$id, $role);
            if ($stmt->fetch() && password_verify($_POST['password'], $hash)) {
                    $_SESSION['username'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['role'] = $role;
                    header('location: index.php');
                    exit;

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
    mysqli_close($db); // fermer la connexion
}
if($action == 'REGISTER') {
    if (isset($_POST['email']) && isset($_POST['role'])) {
        // connexion à la base de données
        $db_username = 'phpproject';
        $db_password = 'qyfzuf-0vepna-zynkUj';
        $db_name = 'phpproject';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die('could not connect to database');

        $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
        $role = mysqli_real_escape_string($db, htmlspecialchars($_POST['role']));

        // $hash = password_hash($password, PASSWORD_BCRYPT, $options);

        if ($email != "" && $role != ""){
            $requete = "SELECT count(*) FROM account where email = '" . $email . "' ";
            $exec_requete = mysqli_query($db, $requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if ($count == 0) {
                $password = randomPassword();
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                $requete2 = "INSERT INTO `account`(`email`, `role`, `password`) 
                    VALUES ('".$email."', '".$role."', '".$hash."') ";
                $exec_requete2 = mysqli_query($db, $requete2);
                echo "INSERT INTO `account`(`email`, `role`, `password`) 
                    VALUES ('".$email."', '".$role."', '".$hash."') ";
                sendEmailPassword($email, $password);
                //header('Location: login.php');
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
    mysqli_close($db); // fermer la connexion
}
if($action == 'newArticle'){
    $title = $_POST['article-title'];
    $description = $_POST['article-desc'];
    $content = $_POST['article-content'];

    echo $title;
    echo $_SESSION['id'];
    echo $description;
    echo $content;

    $db_username = 'phpproject';
    $db_password = 'qyfzuf-0vepna-zynkUj';
    $db_name = 'phpproject';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die('could not connect to database');

    $requete2 = "INSERT INTO `evenement`(`title`, `owner`, `description`, `content`) 
                    VALUES ('".$title."', '".$_SESSION['id']."', '".$description."', '".$content."') ";
    $exec_requete2 = mysqli_query($db, $requete2);

    header('Location: index.php');
}
if($action == 'RESET') {
    if (isset($_POST['email'])) {
        // connexion à la base de données
        $db_username = 'phpproject';
        $db_password = 'qyfzuf-0vepna-zynkUj';
        $db_name = 'phpproject';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die('could not connect to database');

        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));

        if ($email !== "") {
            $stmt = "SELECT count(*) FROM account WHERE email = '".$email."'";
            $exec_requete = mysqli_query($db, $stmt);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if ($count == 1) {
                $password = randomPassword();
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                $requete = "UPDATE account SET password = '".$hash."' WHERE email = '".$email."'";
                echo $requete;
                $exec_query = mysqli_query($db,$requete);
                resetPwd($email, $password);
                header('Location: login.php?erreur=4');

            }else{
                header('Location: resetpwd.php?erreur=2');
            }
        } else {
            header('Location: resetpwd.php?erreur=1'); // utilisateur ou mot de passe vide
        }
    } else {
        header('Location: resetpwd.php');
    }
    mysqli_close($db); // fermer la connexion
}
?>