<!doctype html>
<html lang="fr">
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login">
    <form>
        <h1>E-EVENT.IO!
            <i class="bi bi-person-circle"></i>
        </h1>

        <label for="username">Votre nom d'utilisateur</label>
        <div class="username">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <input type="text" placeholder="Pseudo" id="username">
        </div>

        <label for="password">Votre mot de passe :</label>
        <input type="password" placeholder="password" id="password">

<<<<<<< HEAD
        <button>Connexion</button>
        <button>Créer un compte</button>
    </form>
</div>
=======
<form action="verif.php" method="POST">
    <h1>E-EVENT.IO!
        <i class="bi bi-person-circle"></i>
    </h1>

    <?php
    require_once 'email.func.php';
    sendVerifEmail("salut");
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1 || $err==2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
        if($err==3)
            echo "<p style='color:red'>Ce compte n est pas verifié</p>";
    }
    ?>
    <label for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Pseudo" id="username">

    <label for="password">Votre mot de passe :</label>
    <input type="password" name="password" placeholder="password" id="password">
    <input type="submit" id='submit' name="action" value='LOGIN' >
    <a href="register.php" class="button">Créer un compte</a>
</form>
>>>>>>> df75d85 (Login & Register page)
</body>
</html>