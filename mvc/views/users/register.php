<form action="#" method="POST" class="formConnexion">
    <h1>E-EVENT.IO!
        <i class="bi bi-person-circle"></i>
    </h1>

    <label for="email" class="labelConnexion">E-mail</label>

    <div class="divIdPass">
        <?php echo $data['emailError']; ?>
        <input type="email" name="email" placeholder="mon.email@mail.fr" id="email" class="idPass">
    </div>
    <br>
    <input type="submit"  id='submit' name="action" value='REGISTER' class="buttonConnexion">
    <a href="?controller=user&action=login" class="buttonLogin">Déjà un compte ?</a>
</form>
</body>