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
            echo "<p style='color:red'>Adresse mail incorrect</p>";

    }
    ?>

    <label for="email" class="labelConnexion">Votre email</label>

    <div class="divIdPass">
        <input type="email" name="email" id="email" placeholder="Email@eevent.io" class="idPass">
    </div>

    <input type="submit" id='submit' name="action" value='RESET' class="buttonConnexion">
    <a href="register.php" class="buttonLogin">Confirmation</a>
</form>
</body>
</html>