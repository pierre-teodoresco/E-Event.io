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

    <label for="username" class="labelConnexion">Votre nom d'utilisateur</label>

    <div class="divIdPass">
        <input type="text" name="username" placeholder="Pseudo" id="username" class="idPass">
    </div>

    <label for="password" class="labelConnexion">Votre mot de passe</label>

    <div class="divIdPass">
        <input type="password" name="password" placeholder="password" id="password" class="idPass">
    </div>

    <label for="passwordconfirm" class="labelConnexion">Confirmation</label>

    <div class="divIdPass">
        <input type="password" name="passwordconfirm" placeholder="password" id="passwordconfirm" class="idPass">
    </div>

    <label for="email" class="labelConnexion">E-mail</label>

    <div class="divIdPass">
        <input type="email" name="email" placeholder="mon.email@mail.fr" id="email" class="idPass">
    </div>

    <input type="submit"  id='submit' name="action" value='REGISTER' class="buttonConnexion">
    <a href="login.php" class="buttonLogin">Déjà un compte</a>
</form>
</body>
</html>