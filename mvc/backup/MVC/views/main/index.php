<?php
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$role = $_SESSION['role'];
?>
<div class="eventcontainer">
    <nav>

        <?php if($username != ""){ ?>
        <div class="navbar-extern">
            <a  >
                <div class="statement">
                    <img src="img/<?php echo $data['avatar'];?>" alt="" width="32", height="32" class="icon">
                    <h3 class="navbar-title">Bonjour, <?php echo $username; ?></h3>
                </div> 
            </a>   
        </div>
        <?php }?>
        <div class="navbar">
            <a href="?controller=event&action=index">
                <div class="statement">        
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>                   
                    </svg>
                    <h3 class="navbar-title">Acceuil</h3>
                </div>
            </a>
            <?php if($role == 2 || $role == 4) {?>
            <a id="myBtn">
                <div class="statement">        
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    <h3 class="navbar-title">Créer un article</h3>
                </div>
            </a>
            <?php }?>
            <?php if($role == 4){ ?>
            <a href="?controller=user&action=admin">
                <div class="statement">        
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                        <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <h3 class="navbar-title">Pannel Admin</h3>
                </div>
            </a>

            <?php }?>
            <?php if($role == 3){ ?>
                <a href="?controller=user&action=jury">
                    <div class="statement">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                            <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <h3 class="navbar-title">Pannel Jury</h3>
                    </div>
                </a>

            <?php }?>
        </div>
        <div class="navbar">
            <?php if($username != ""){?>

                <a href="?controller=user&action=edit">
                    <div class="statement">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <h3 class="navbar-title">Modifier mon profil</h3>
                    </div>
                </a>
            <?php }?>
            <a href="<?php echo($username != "") ?"views/users/logout.php" : "?controller=user&action=login" ?>">
                <div class="statement">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                    <h3 class="navbar-title"><?php echo($username != "") ?"Se deconnecter" : "Se connecter" ?></h3>
                </div> 
            </a>   
        </div>
    </nav>

    <div class="feed">
        <?php echo $data['allEvent'];
        ?>
    </div>
    <aside>
        <div class="top3">
            <h2>TOP 3</h2>
            <div>        
                <h3>Premier</h3>
            </div>
            <div>        
                <h3>Deuxieme</h3>
            </div>
            <div>        
                <h3>Troisieme</h3>
            </div>
        </div>
        <div class="point">
            <h2>Points : <?php echo $data['point']; ?></h2>
        </div>
    </aside>
</div>
<?php if($username == "" && $role != "") {?>
<div id="changepassword" class="modal">

    <form method="post" id="force">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Première connexion</div>
            </div>
            <div class="modal-body">
                <?php echo $data['usernameError'];?>
                <label for="username">Votre pseudo</label>
                <input name="username" type="text" id="username" value="<?php echo $data['username']?>">

                <?php echo $data['passwordError'];?>
                <label for="password">Votre nouveau mot de passes</label>
                <input name="password" type="password" id="password" >

                <?php echo $data['passwordcError'];?>
                <label for="passwordc">Confirmation</label>
                <input name="passwordc" type="password" id="passwordc" >
            </div>
            <div class="modal-footer">
                <div class="right">
                <a href="javascript:;" onclick="document.getElementById('force').submit();" class="button">Valider mes informations</a>
                </div>
            </div>
        </div>
    </form>
</div>
    <?php }?>
<?php if($role == 2 || $role == 4){ ?>
<div id="myModal" class="modal">

    <form method="post" >
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
    <?php }?>
<script src="js/eevent.js"></script>

<?php echo $data['modal'];