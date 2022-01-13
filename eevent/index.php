<?php
session_start();
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link id="pagestyle" rel="stylesheet" type="text/css" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Event.io!</title>
</head>

<body class="bodyIndex">
<div class="flexContainer">
    <div class="wrapper">
        <div class="sidebar-container">
            <ul class="sidebar-navigation">
                <li id="premier">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        <i class="fa fa-home" aria-hidden="true"></i>Accueil
                    </a>
                </li>
                <li id="quatrieme">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        <i class="fa fa-cog" aria-hidden="true"></i> Dernier event
                    </a>
                </li>
                <?php if($username != "" ){?><li id="sixième">
                    <a id="createBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        <i class="fa fa-info-circle" aria-hidden="true"></i> Orga / Créer
                    </a>
                </li>
                <li id="deuxieme">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        </svg>
                        <i class="fa fa-tachometer" aria-hidden="true"></i> Dâte de fin
                    </a>
                </li>
                <?php }?>
                <li id="LoginPage">
                    <div class="loginProfil">
                        <a href="<?php echo $username ? 'edit.php': 'login.php'?>" class="login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>

                            <i class="fa fa-info-circle" aria-hidden="true"></i>  <?php echo $username ? 'Modifier mon profil': 'Se connecter'?>
                        </a>
                    </div>
                </li>
                <?php if($username != "") {?>
                <li id="LoginPage">
                    <div class="loginProfil">
                        <a href="" class="login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>

                            <i class="fa fa-info-circle" aria-hidden="true"></i> Se deconnecter
                        </a>
                    </div>
                </li>
                    <?php if($role == 4){?>
                    <li id="deuxieme">
                        <a href="admin.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                            </svg>
                            <i class="fa fa-tachometer" aria-hidden="true"></i> Pannel Administrateur
                        </a>
                    </li>
                        <?php }?>
                <?php }?>
            </ul>

            <!-- The Modal -->
        </div>
    </div>
    <div class="feed">
        <div class="head">
            <button onclick='window.scrollTo({top: 0, behavior: "smooth"});'>E-Event.io!</button>
        </div>
            <?php
            $db_username = 'phpproject';
            $db_password = 'qyfzuf-0vepna-zynkUj';
            $db_name = 'phpproject';
            $db_host = 'localhost';
            $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
            or die('could not connect to database');

            $stmt = $db->prepare("SELECT evenement.id,title,description,votes,username,image_profile FROM evenement INNER JOIN account ON owner = account.id ORDER BY evenement.id DESC");
            $stmt->execute();

            foreach ($stmt->get_result() as $row)
            {
                echo "<div class=\"article\">";
                echo "<h2> $row[title]</h2>";
                echo "<h3> <img src='img/$row[image_profile]' width='100px' alt=''> Autheur : <span> $row[username]</span></h3>";
                echo "<p> $row[description]</p>";
                echo "<a href=\"article.php?id=$row[id]\">Voir l'evenement</a>";
                echo "<div class=\"article-footer\">";
                $myArray = explode(',', $row[votes]);
                $vote = count($myArray)-1;
                echo  ($vote) <= 1 ? "$vote Vote" : "$vote Votes";
                echo "</div>";
                echo"</div>";
            }
            ?>

    </div>

    <div class="user">
        <div class="asideDiv">
            <div class="texte">
                <div class="titreTop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                        <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                    </svg>
                    <p> Top 5 </p>
                </div>
                <ul class="sidebarTop">
                    <li>
                        <a href="#">
                            Premier
                        </a>

                    </li>
                    <li>
                        <a href="#">
                            Deuxieme
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Troisieme
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Quatrieme
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Cinquieme
                        </a>
                    </li>
            </div>
        </div>
        <div class="co">
            <a href="#">Conditions d’utilisation</a>
            <a href="#">Politique de Confidentialité</a>
            <a href="#">Politique relative aux cookies</a>
            <a href="#">Accessibilité</a>
            <a href="#">Informations sur les publicités</a>
            <p>© 2022 E-Event.io!</p>
        </div>
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

<script src="js/eevent.js" type="text/javascript"></script>
</body>

</html>
