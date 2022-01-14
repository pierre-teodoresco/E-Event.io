//Le fichier n'est plus utilisé il sert uniquement à la converstion du code déjà existant
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