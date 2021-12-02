<!doctype html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



<form action="verif.php" method="POST">
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

    <label for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Pseudo" id="username">

    <label for="password">Votre mot de passe :</label>
    <input type="password" name="password" placeholder="password" id="password">


    <label for="passwordconfirm">Confirmation:</label>
    <input type="password" name="passwordconfirm" placeholder="password" id="passwordconfirm">

    <label for="email">E-mail :</label>
    <input type="email" name="email" placeholder="mon.email@mail.fr" id="email">


    <input type="submit"  id='submit' name="action" value='REGISTER' >
    <a href="login.php" class="button">Déjà un compte</a>
</form>
</body>
</html>