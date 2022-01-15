<?php
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$role = $_SESSION['role'];
?>
<div class="eventcontainer">
    <navbar>
        <ul>
            <li>
                <a href="?controller=event&action=index">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>Accueil
                </a>
            </li>
            <li>
                <a href="<?php echo($username != "") ?"?controller=user&action=edit" : "?controller=user&action=login" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    <?php echo($username != "") ?"Modifier mon profile" : "Se connecter" ?>
                </a>
            </li>
            <?php if ($role == 4){?>
            <li>
                <a href="?controller=user&action=admin">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    Pannel Admin
                </a>
            </li>
            <?php }?>
        </ul>
    </navbar>
    <div class="feed">
        <?php echo $data['allEvent'];
        ?>

    </div>

</div>
<div id="myModal" class="modal">

    <form action="verif.php" method="post">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Création d'article</div>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <label for="article-title">Nom de l'article</label>
                <input name="article-title" type="text" id="article-title">

                <label for="article-desc">Descrition (200 caractères)</label>
                <textarea name="article-desc" id="article-desc" rows="10"></textarea>

                <label for="article-content">Contenu </label>
                <textarea name="article-content" id="article-content" rows="25"></textarea>
            </div>
            <div class="modal-footer">
                <input type="submit" name="action" value="newArticle">
            </div>
        </div>
    </form>
</div>

<script src="js/eevent.js"></script>

