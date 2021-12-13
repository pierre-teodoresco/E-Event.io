<!doctype html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bodyLogin">
<form action="verif.php" method="POST" class="formLogin">
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

    <label for="username" class="labelLogin">Votre nom d'utilisateur</label>

    <div class="divIdPass">
        <input type="text" name="username" id="username" placeholder="Pseudo" class="idPass">
    </div>

    <label for="password" class="labelLogin" id="labelPass">Votre mot de passe :</label>

    <div class="divIdPass">
        <input type="password" name="password" id="password" placeholder="Mot de passe" class="idPass">
    </div>

    <input type="submit" id='submit' name="action" value='LOGIN' class="loginButton">
    <a href="register.php" class="registerButton">Créer un compte</a>
</form>
</body>
</html>