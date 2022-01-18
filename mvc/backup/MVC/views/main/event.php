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
        <?php echo $data['event'];?>

        <div class="container">
            <h3 class="title">Commentaire</h3>
            <?php if($role['role'] == 1){?>
            <div class="right">
                <a id="myBtn" class="button">Donner des points</a>
            </div>
            <?php } ?>
            <?php echo $data['comment'];?>
        </div>
    </div>

</div>

<div id="myModal" class="modal">

    <form method="post" name="comment">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Donner des points à l'évenement</div>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <label for="article-title">Nombre de points </label>
                <input type="number" name="givepoint" required="required" min="1" value="1" max="<?php echo $data['point'];?>">
                <label for="article-desc">Laisser un commentaire (facultatif)</label>
                <textarea name="commentairesec" maxlength="240" id="commentairesec" rows="10" oninput="countText(this)"></textarea>
                <div class="right">
                    <span id="characters"></span>/240
                </div>
            </div>
            <div class="modal-footer ">
                <div class="right">
                    <input type="submit" name="action" value="ValiderCom">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="js/eevent.js"></script>