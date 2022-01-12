<!doctype html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="bodyConnexion">
<form action="#" method="POST" class="formConnexion">
    <h1>E-EVENT.IO!
        <i class="bi bi-person-circle"></i>
    </h1>

    <label for="username" class="labelConnexion">Votre nom d'utilisateur</label>

    <div class="divIdPass">
        <?php echo $data['usernameError']; ?>
        <input type="text" name="username" id="username" placeholder="Pseudo" class="idPass" value="<?php echo $data['username']; ?>">
    </div>

    <label for="password" class="labelConnexion" id="labelPass">Votre mot de passe :</label>

    <div class="divIdPass">
        <?php echo $data['passwordError']; ?>
        <input type="password" name="password" id="password" placeholder="Mot de passe" class="idPass" value="<?php echo $data['password']; ?>">
    </div>

    <input type="submit" id='submit' value='LOGIN' class="buttonConnexion">
    <a href="register.php" class="buttonLogin">Créer un compte</a>
</form>
</body>
</html>