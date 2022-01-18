<div class="auth">

    <div class="left">
        <h3 class="title">E Event.io !</h3>
        <p>Entité de soutien lors de l'organisation d'évenements, notamment pour les étudiants d'Aix-Marseille Université</p>
    </div>
    <form method="post" id="login" class="right">
        <?php echo $data['emailError']; ?>
        <input type="text" name="email" id="email" placeholder="Adresse mail" value="<?php echo $data['email'];?>">

        <?php echo $data['passwordError']; ?>
        <input type="password" name="password" id="password" placeholder="Mot de passe" value="<?php echo $data['password'];?>">
        <a href="javascript:;" onclick="document.getElementById('login').submit();" class="button">Se connecter</a>
        <a href="#" class="center">Mot de passe oublié ?</a>
        <a href="?controller=user&action=register"class="button sucess">Créer un nouveau compte</a>

    </form>
</div>
</body>