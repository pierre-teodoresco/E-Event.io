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

    <label for="username" class="labelLogin">Votre nom d'utilisateur</label>

    <div class="divIdPass">
        <input type="text" name="username" placeholder="Pseudo" id="username" class="idPass">
    </div>

    <label for="password" class="labelLogin">Votre mot de passe</label>

    <div class="divIdPass">
        <input type="password" name="password" placeholder="password" id="password" class="idPass">
    </div>

    <label for="passwordconfirm" class="labelLogin">Confirmation</label>

    <div class="divIdPass">
        <input type="password" name="passwordconfirm" placeholder="password" id="passwordconfirm" class="idPass">
    </div>

    <label for="email" class="labelLogin">E-mail</label>

    <div class="divIdPass">
        <input type="email" name="email" placeholder="mon.email@mail.fr" id="email" class="idPass">
    </div>

    <input type="submit"  id='submit' name="action" value='REGISTER' class="loginButton">
    <a href="login.php" class="registerButton">Déjà un compte</a>
</form>
</body>
</html>