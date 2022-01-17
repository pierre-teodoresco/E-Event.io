<?php
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$role = $_SESSION['role'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL)
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
            <?php if ($role == 2 || $role == 4) {?>
            <li>
                <a id="myBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>Créer un article
                </a>
            </li>
            <?php }?>
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
            <?php } if($username != ""){?>
            <li>
                <p>Points : <?php  ?></p>
            </li>
                <li>
                    <a href="views/users/logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        Se déconnecter
                    </a>
                </li>
            <?php }?>
        </ul>
    </navbar>
    <div class="feed">
        <form method="post" id="editplayer" enctype="multipart/form-data">
            <div class="container" >
                <h3 class="title">Modification du profil</h3>
                <p>Email :</p>
                <input type="text" name="email" id="email" placeholder="Adresse mail" disabled="disabled" value="<?php echo $data['email'];?>">
                <hr>
                <p>Photo de profil</p>
                <img src="img/<?php  echo $data['img']?>" name="profile" id="profile" alt="Avatar" class="avatar">
                <input type="file" id="avatar" name="avatar" accept="image/*">
                <p>Mot de passe</p>
                <?php echo $data['errorOldpassword']; ?>
                <input type="password" name="oldpassword" id="oldpassword" placeholder="Ancien mot de passe"  >
                <?php echo $data['errorPassword']; ?>
                <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" >
                <?php echo $data['errorPasswordc']; ?>
                <input type="password" name="passwordc" id="passwordc" placeholder="Confirmation" >
                <hr>
                <p>Informations personnelles</p>
                <input type="text" name="prenom" id="prenom" placeholder="Prenom"  value="<?php echo $data['prenom'];?>">
                <input type="text" name="nom" id="nom" placeholder="Nom"  value="<?php echo $data['nom'];?>">
                <div class="right">
                    <a href="javascript:;" onclick="document.getElementById('editplayer').submit();" class="button">Valider mes informations</a>
                </div>
            </div>
        </form>
    </div>

</div>

<script src="js/eevent.js"></script>