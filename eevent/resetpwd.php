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
        if($err==1 || $err==2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
        if($err==3)
            echo "<p style='color:red'>Ce compte n est pas verifié</p>";
    }
    ?>

    <label for="email" class="labelConnexion">Votre email</label>

    <div class="divIdPass">
        <input type="email" name="email" id="email" placeholder="Email@eevent.io" class="idPass">
    </div>

    <label for="password" class="labelConnexion" id="labelPass">Votre mot de passe :</label>

    <div class="divIdPass">
        <input type="password" name="password" id="password" placeholder="Mot de passe" class="idPass">
    </div>

    <a href="resetpwd.php" >Mot de passes oublier</a>
    <input type="submit" id='submit' name="action" value='LOGIN' class="buttonConnexion">
    <a href="register.php" class="buttonLogin">Créer un compte</a>
</form>
</body>
</html>