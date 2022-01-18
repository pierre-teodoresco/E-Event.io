<div class="auth">
    <div class="left">
        <h3 class="title">E-Event.io !</h3>
        <p>Entité de soutien lors de l'organisation d'évenement, notament pour les étudiants d'Aix-Marseille Université</p>
    </div>
    <form method="post" id="login" class="right">
        <p style="color:red">(Problème avec le SMTP de mon serveur, envoie de mail uniquement sur des adresse mail, google)</p>
        <p style="color:red">(Un jeu de donnée est disponible dans le zip du projet)</p>
        <?php echo $data['emailError']; ?>
        <input type="text" name="email" id="email" placeholder="Adresse mail" value="<?php echo $data['email'];?>">

        <?php echo $data['rankError'];?>
        <div class="role-checkbox">
            <label id="donateurRole">
                <input type="radio" name="role" value="1" class="role">
                Donateur
            </label>
            <label id="organisateurRole">
                <input type="radio" name="role" value="2" class="role">
                &ensp;Organisateur
            </label> 
        </div>
        <a href="javascript:;" onclick="document.getElementById('login').submit();" class="button">S'enregistrer</a>
        <a href="?controller=user&action=login" class="button sucess">Déjà un compte ?</a>

    </form>
</div>
