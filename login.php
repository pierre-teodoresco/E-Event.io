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
    <input type="text" name="username" placeholder="Pseudo" id="username">

    <label for="password" class="labelLogin">Votre mot de passe :</label>
    <input type="password" name="password" placeholder="password" id="password">

    <input type="submit" id='submit' name="action" value='LOGIN' >
    <a href="register.php" class="buttonLogin">Créer un compte</a>
</form>

</body>
</html>