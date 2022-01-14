<form action="#" method="POST" class="formConnexion">
    <h1>E-EVENT.IO!
        <i class="bi bi-person-circle"></i>
    </h1>

    <label for="username" class="labelConnexion">Votre adresse mail</label>

    <div class="divIdPass">
        <?php echo $data['emailError']; ?>
        <input type="email" name="email" id="email" placeholder="Email@eevent.io" class="idPass" value="<?php echo $data['email']; ?>">
    </div>

    <label for="password" class="labelConnexion" id="labelPass">Votre mot de passe :</label>

    <div class="divIdPass">
        <?php echo $data['passwordError']; ?>
        <input type="password" name="password" id="password" placeholder="Mot de passe" class="idPass" value="<?php echo $data['password']; ?>">
    </div>

    <input type="submit" id='submit' value='LOGIN' class="buttonConnexion">
    <a href="?controller=user&action=register" class="buttonLogin">Créer un compte</a>
</form>
</body>