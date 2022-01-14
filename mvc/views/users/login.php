<div class="auth">
    <h2 class="title">E-event.io! - Service d'authentification</h2>

    <?php echo $data['emailError']; ?>
    <?php echo $data['passwordError']; ?>
    <form method="POST">
        <div class="authlabel">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <label for="username" class="labelConnexion">Adresse mail:</label>

        </div>
        <input type="email" name="email" id="email"  class="idPass" value="<?php echo $data['email']; ?>">

        <div class="authlabel">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
            <label for="username" class="labelConnexion">Mot de passe:</label>

        </div>
        <input type="password" name="password" id="password" class="idPass" value="<?php echo $data['password']; ?>">
        <input type="submit" id='submit' value='LOGIN' class="buttonConnexion">

        <p>Pour des raison de sécurité, veuillez vous déconnecter et fermer votre navigateur lorsque vous avez fini d'accéder au services authentifiés.</p>
        <a href="?controller=user&action=register" class="buttonLogin">Créer un compte</a>
    </form>

</div>
</body>