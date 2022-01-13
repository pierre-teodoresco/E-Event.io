<!doctype html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bodyConnexion">
<form action="verif.php" method="POST" class="formConnexion">
    <h1>E-EVENT.IO!
        <i class="bi bi-person-circle"></i>
    </h1>

    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1 )
            echo "<p style='color:red'>Des informations sont manquantes</p>";
        else if($err==2 )
            echo "<p style='color:red'>Les mots de passe sont differents</p>";
        else if($err==3 )
            echo "<p style='color:red'>Pseudo déjà utilisé</p>";
        else if($err==4 )
            echo "<p style='color:red'>Email déjà utilisé</p>";
    }
    ?>


    <label for="email" class="labelConnexion">E-mail</label>

    <div class="divIdPass">
        <input type="email" name="email" placeholder="mon.email@mail.fr" id="email" class="idPass">
    </div>

    <div class="buttonRole">
        <label id="donateurRole">
            <input type="radio" name="role" value="0" class="role">
            Donateur
        </label>
        <label id="organisateurRole">
            <input type="radio" name="role" value="1" class="role">
            Organisateur
        </label>
    </div>
    <br>

    <input type="submit"  id='submit' name="action" value='REGISTER' class="buttonConnexion">
    <a href="login.php" class="buttonLogin">Déjà un compte ?</a>
</form>
</body>
</html>