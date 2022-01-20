<div class="auth">

    <div class="left">
        <h3 class="title">E Event.io !</h3>
        <p>Entité de soutien lors de l'organisation d'évenements, notamment pour les étudiants d'Aix-Marseille Université</p>
    </div>
    <form method="post" id="forgot" class="right">
        <h2>Mot de passe oublié</h2>
        <?php echo $data['emailError']; ?>
        <input type="text" name="email" id="email" placeholder="Adresse mail" value="<?php echo $data['email'];?>">

        <a href="javascript:;" onclick="document.getElementById('forgot').submit();" class="button">Se connecter</a>

        <a href="?controller=user&action=register"class="button sucess">Créer un nouveau compte</a>

    </form>
</div>
</body>