<div class="auth">

    <div class="left">
        <h3 class="title">E Event.io !</h3>
        <p>Entité de soutien lors de l'organisation d'évenement, notament pour les étudiants d'Aix-Marseille Université</p>
    </div>
    <form method="post" id="login" class="right">
        <?php echo $data['emailError']; ?>
        <input type="text" name="email" id="email" placeholder="Adresse mail" value="<?php echo $data['email'];?>">

        <?php echo $data['rankError'];?>
        <label id="donateurRole">
            <input type="radio" name="role" value="1" class="role">
            Donateur
        </label>
        <label id="organisateurRole">
            <input type="radio" name="role" value="2" class="role">Organisateur
        </label>

        <a href="javascript:;" onclick="document.getElementById('login').submit();" class="button">S'enregistrer</a>
        <a href="?controller=user&action=login" class="button sucess">Déjà un compte ?</a>

    </form>
</div>
</body>